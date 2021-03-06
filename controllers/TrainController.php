<?php

namespace app\controllers;

use app\models\Level;
use app\models\TrainUsers;
use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersLevel;
use Yii;
use app\models\Train;
use yii\web\ServerErrorHttpException;
use yii\data\Pagination;
use app\models\TrainTeachers;

class TrainController extends \yii\web\Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;
        $orderBy = \Yii::$app->request->get('order_by') ? \Yii::$app->request->get('order_by') : '`begin_time` desc';
        $query = Train::find()->where(['level_id' => $levelId]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => '10']);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($orderBy)
            ->all();
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $val->begin_time = date('Y-m-d', strtotime($val->begin_time));
                //录取人数
                $countResult = \app\models\TrainUsers::find()->where(['train_id' => $val->id, 'status' => [TrainUsers::ENROLL,TrainUsers::DOING,TrainUsers::END,TrainUsers::PASS,TrainUsers::NO_PASS]]);
                $val->already_recruit_count  = $countResult->count();
            }
        }
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'levelId' => $levelId,
            'orderBy' => $orderBy
        ]);
    }

    public function actionApply()
    {

        $trainId = Yii::$app->request->get('id');
        $trainInfo = Train::findOne(['id' => $trainId]);
        if ($trainInfo['status'] != Train::BEGIN_SIGN_UP) {
            throw new ServerErrorHttpException('该课程的状态不是开始报名，谢谢。');
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/register','train_id'=>$trainId]);
        } else {
            $userId = Yii::$app->user->id;
            if (Yii::$app->user->identity->status != '1') {
                throw new ServerErrorHttpException('您目前的状态是未审核，不能报名课程，谢谢。');

            }
            $trainLevelInfo = Level::findOne($trainInfo['level_id']);
            if ($trainLevelInfo['order'] != (Yii::$app->user->identity->level_order+1)) {
                throw new ServerErrorHttpException('您目前没有权限报名该级别下的课程，谢谢。');
            }

            //检查用户参与的课程，状态不是取消的都算是已经参与了报名
            $isExist = TrainUsers::getUserIsExistTrainStatus($userId,$trainInfo['level_id']);
            if (!empty($isExist)) {
                throw new ServerErrorHttpException('您已经参与了该级别下的培训课程，请耐心等待培训结果，谢谢。');
            }

//            if (strtotime($trainInfo['sign_up_begin_time']) < time()) {
//                throw new ServerErrorHttpException('此课程已过期。');
//            }

            $noPassInfo = TrainUsers::findOne(['user_id' => Yii::$app->user->id, 'level_id' => Yii::$app->user->identity->level_id+1, 'status' => TrainUsers::NO_PASS]);
            if (!empty($noPassInfo)) {
                $noPassTrainInfo = Train::findOne($noPassInfo['train_id']);
                if (!empty($noPassTrainInfo)) {
                    if ($noPassTrainInfo['end_time'] > $trainInfo['begin_time']) {
                        throw new ServerErrorHttpException('训课课程的开课时间一定要大于未通过考试培训课程结束时间。');
                    }
                }
            }


            //报名成功，给出用户的序号
            $trainUsersOrder = TrainUsers::getMaxSignUpOrder($trainId);
            if (empty($trainUsersOrder)) {
                $trainUsersOrder = 1;
            } else {
                $trainUsersOrder=$trainUsersOrder+1;
            }
            $data = [
                'train_id' => $trainId,
                'user_id' => $userId,
                'status' => TrainUsers::APPROVED,
                'practice_score' => 0,
                'theory_score' => 0,
                'rule_score' => 0,
                'level_id' => $trainInfo['level_id'],
                'orders' => $trainUsersOrder
            ];

            $model = new TrainUsers();
            $model->setAttributes($data);
            if ($model->save()) {
                $trainUserId = $model->id;
                $trainUser = TrainUsers::findOne(['id' => $trainUserId]);
                $trainName = Train::getOneTrainNameById($trainUser['train_id']);
                $data = [
                    'orders' => $trainUser['orders'],
                    'trainName' => $trainName
                ];
                //更新级别信息的信息
                UsersLevel::updateAll(['train_id' => $trainId], ['user_id' => $userId, 'level_id' =>Yii::$app->user->identity->level_id]);
                return $this->render('/train/apply-success', ['data' => $data]);
            } else {
                throw new ServerErrorHttpException('' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        }
    }

    public function actionApplySuccess()
    {
        $trainUserId = Yii::$app->request->get('id');
        $trainUser = TrainUsers::findOne(['id' => $trainUserId]);
        $maxCount = TrainUsers::getMaxSignUpOrder($trainUser['train_id']);
        $trainName = Train::getOneTrainNameById($trainUser['train_id']);
        $data = [
            'maxCount' => $maxCount,
            'trainName' => $trainName
        ];
        return $this->redirect(['/train/apply-success', 'data' => $data]);
    }

    public function actionView()
    {
        $trainId = Yii::$app->request->get('id');
        $trainModel = Train::findOne(['id' => $trainId]);
        $trainTeachersModel = TrainTeachers::getAllTeachersByTrainId($trainModel['id']);
        $trainUsers = [];
        if ($trainModel['recruit_count'] > 0) {
            for ($i = 1; $i <= $trainModel['recruit_count']; $i++) {

                $trainUsersInfo = TrainUsers::findOne(['train_id' => $trainModel['id'], 'orders' => $i]);
                if (empty($trainUsersInfo)) {
                    $trainUsers[$i]['status'] = '未报名';
                    $trainUsers[$i]['class'] = 'red';
                    $trainUsers[$i]['userId'] = '';
                } else {
                    $trainUsers[$i]['status'] = TrainUsers::$statusList[$trainUsersInfo['status']];
                    $trainUsers[$i]['userId'] = $trainUsersInfo['user_id'];
                    if ($trainUsersInfo['status'] == TrainUsers::NO_APPROVED) {
                        $trainUsers[$i]['class'] = 'blue';
                    } else {
                        $trainUsers[$i]['class'] = '';
                    }
                }
            }
        }
        $data = [
            'trainModel' => $trainModel,
            'trainTeachersModel' => $trainTeachersModel,
            'trainUsers' => $trainUsers
        ];
        return $this->render('/train/view', ['data' => $data]);

    }

}
