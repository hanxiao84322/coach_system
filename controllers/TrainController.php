<?php

namespace app\controllers;

use app\models\Level;
use app\models\TrainUsers;
use Yii;
use app\models\Train;
use yii\web\ServerErrorHttpException;
use yii\data\Pagination;

class TrainController extends \yii\web\Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;

        $query = Train::find()->where(['level_id' => $levelId]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $val->begin_time = date('Y-m-d', strtotime($val->begin_time));
                //录取人数
                $countResult = \app\models\TrainUsers::find()->where(['train_id' => $val->id, 'status' => [TrainUsers::APPROVED,TrainUsers::DOING,TrainUsers::END]]);
                $val->already_recruit_count  = $countResult->count();
            }
        }
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'levelId' => $levelId
        ]);
    }

    public function actionApply()
    {

        $trainId = Yii::$app->request->get('id');
        $trainInfo = Train::findOne(['id' => $trainId]);
        if ($trainInfo['sign_up_status'] != Train::BEGIN_SIGN_UP) {
            throw new ServerErrorHttpException('该课程的状态不是开始报名，谢谢。');
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect('/user/register');
        } else {
            $userId = Yii::$app->user->id;
            $trainLevelInfo = Level::findOne(['id' => $trainInfo['level_id']]);
            if ($trainLevelInfo['order'] != (Yii::$app->user->identity->level_order + 1)) {
                throw new ServerErrorHttpException('系统错误,原因：您目前没有权限报名该级别下的课程，谢谢。');
            }

            //检查用户参与的课程，状态不是取消的都算是已经参与了报名
            $isExist = TrainUsers::getUserIsExistTrainStatus($userId,$trainInfo['level_id']);
            if (!empty($isExist)) {
                throw new ServerErrorHttpException('系统错误,原因：您已经参与了该级别下的培训课程，请耐心等待培训结果，谢谢。');
            }
            $data = [
                'train_id' => $trainId,
                'user_id' => $userId,
                'status' => '1',
                'practice_score' => 0,
                'theory_score' => 0,
                'rule_score' => 0,
                'level_id' => $trainInfo['level_id']
            ];
            $model = new TrainUsers();
            $model->setAttributes($data);
            if ($model->save()) {
                $trainUserId = $model->id;
                $trainUser = TrainUsers::findOne(['id' => $trainUserId]);
                $maxCount = TrainUsers::getMaxSignUpOrder($trainUser['train_id']);
                $trainName = Train::getOneTrainNameById($trainUser['train_id']);
                $data = [
                    'maxCount' => $maxCount,
                    'trainName' => $trainName
                ];
                return $this->render('/train/apply-success', ['data' => $data]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));

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

}
