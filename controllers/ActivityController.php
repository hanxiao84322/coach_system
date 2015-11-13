<?php

namespace app\controllers;

use app\models\Level;
use app\models\ActivityUsers;
use app\models\UsersInfo;
use Yii;
use app\models\Activity;
use yii\web\ServerErrorHttpException;
use yii\data\Pagination;

class ActivityController extends \yii\web\Controller
{
    public $layout = 'user';

    public function actionIndex()
    {
        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;

        $query = Activity::find()->where(['level_id' => $levelId]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $val->begin_time = date('Y-m-d', strtotime($val->begin_time));
                //录取人数
                $countResult = \app\models\ActivityUsers::find()->where(['activity_id' => $val->id, 'status' => [ActivityUsers::APPROVED,ActivityUsers::DOING,ActivityUsers::END]]);
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

        $activityId = Yii::$app->request->get('id');
        $activityInfo = Activity::findOne(['id' => $activityId]);
        if ($activityInfo['status'] != Activity::BEGIN_SIGN_UP) {
            throw new ServerErrorHttpException('该活动的状态不是开始报名，谢谢。');
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/register','activity_id'=>$activityId]);
        } else {
            $userId = Yii::$app->user->id;
            $CredentialsNumber = UsersInfo::getCredentialsNumberByUserId($userId);
            if (Yii::$app->user->identity->status != '1') {
                throw new ServerErrorHttpException('系统错误,原因：您目前的状态是未审核，不能报名课程，谢谢。');

            }
            $activityLevelInfo = Level::findOne(['id' => $activityInfo['level_id']]);
            if ($activityLevelInfo['order'] != (Yii::$app->user->identity->level_order+1)) {
                throw new ServerErrorHttpException('系统错误,原因：您目前没有权限报名该级别下的课程，谢谢。');
            }

            //检查用户参与的课程，状态不是取消的都算是已经参与了报名
            $isExist = ActivityUsers::getUserIsExistActivityStatus($userId,$activityInfo['level_id']);
            if (!empty($isExist)) {
                throw new ServerErrorHttpException('系统错误,原因：您已经参与了该级别下的培训课程，请耐心等待培训结果，谢谢。');
            }
            //报名成功，给出用户的序号
            $activityUsersOrder = ActivityUsers::getActivityUsersOrder($userId, $activityId);
            if (empty($activityUsersOrder)) {
                $activityUsersOrder = 1;
            }
            $transaction = Yii::$app->db->beginTransaction();

            $data = [
                'activity_id' => $activityId,
                'user_id' => $userId,
                'status' => ActivityUsers::APPROVED,
                'practice_score' => 0,
                'theory_score' => 0,
                'rule_score' => 0,
                'level_id' => $activityInfo['level_id'],
                'orders' => $activityUsersOrder
            ];

            $model = new ActivityUsers();
            $model->setAttributes($data);
            if ($model->save()) {
                $activityUserId = $model->id;
                $activityUser = ActivityUsers::findOne(['id' => $activityUserId]);
                $activityName = Activity::getOneActivityNameById($activityUser['activity_id']);
                $data = [
                    'orders' => $activityUser['orders'],
                    'activityName' => $activityName
                ];

                //新增一条用户和级别对应的信息
                $userLevelModel = new UsersLevel();
                $userLevelModel->user_id = $userId;
                $userLevelModel->activity_id = $activityId;
                $userLevelModel->level_id = $activityInfo['level_id'];
                $userLevelModel->credentials_number = $CredentialsNumber;
                if (!$userLevelModel->save()) {
                    $transaction->rollBack();
                    throw new ServerErrorHttpException('更新状态错误，原因：' . json_encode($userLevelModel->errors, JSON_UNESCAPED_UNICODE) . '！');
                } else {
                    $transaction->commit();
                }

                return $this->render('/activity/apply-success', ['data' => $data]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        }
    }

    public function actionApplySuccess()
    {
        $activityUserId = Yii::$app->request->get('id');
        $activityUser = ActivityUsers::findOne(['id' => $activityUserId]);
        $maxCount = ActivityUsers::getMaxSignUpOrder($activityUser['activity_id']);
        $activityName = Activity::getOneActivityNameById($activityUser['activity_id']);
        $data = [
            'maxCount' => $maxCount,
            'activityName' => $activityName
        ];
        return $this->redirect(['/activity/apply-success', 'data' => $data]);
    }

    public function actionView()
    {
        $activityId = Yii::$app->request->get('id');
        $activityModel = Activity::findOne(['id' => $activityId]);
        $activityTeachersModel = ActivityTeachers::getAllTeachersByActivityId($activityModel['id']);
        $activityUsers = [];
        if ($activityModel['recruit_count'] > 0) {
            for ($i = 1; $i <= $activityModel['recruit_count']; $i++) {

                $activityUsersInfo = ActivityUsers::findOne(['activity_id' => $activityModel['id'], 'orders' => $i]);
                if (empty($activityUsersInfo)) {
                    $activityUsers[$i]['status'] = '未报名';
                    $activityUsers[$i]['class'] = 'red';
                    $activityUsers[$i]['userId'] = '';
                } else {
                    $activityUsers[$i]['status'] = ActivityUsers::$statusList[$activityUsersInfo['status']];
                    $activityUsers[$i]['userId'] = $activityUsersInfo['user_id'];
                    if ($activityUsersInfo['status'] == ActivityUsers::NO_APPROVED) {
                        $activityUsers[$i]['class'] = 'blue';
                    } else {
                        $activityUsers[$i]['class'] = '';
                    }
                }
            }
        }
        $data = [
            'activityModel' => $activityModel,
            'activityTeachersModel' => $activityTeachersModel,
            'activityUsers' => $activityUsers
        ];
        return $this->render('/activity/view', ['data' => $data]);

    }

}
