<?php

namespace app\controllers;

use app\models\Attendance;
use app\models\Level;
use app\models\TrainTeachers;
use app\models\TrainUsers;
use yii\web\ServerErrorHttpException;

class UserCenterController extends \yii\web\Controller
{
    public $layout = 'userCenter';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'user',
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $isPage = \Yii::$app->request->get('is_page');
        $levelName = Level::getOneLevelNameById(\Yii::$app->user->identity->level_id);

        $trainModel = TrainUsers::getAllTrainByUserId(\Yii::$app->user->id, $isPage);
        $currentTrain = TrainUsers::getTrainByUserId(\Yii::$app->user->id);

        $result = [
            'levelName' => $levelName,
            'trainModel' => $trainModel,
            'currentTrain' => $currentTrain
        ];
        return $this->render('index', ['result' => $result]);
    }

    public function actionUpdateTrainUserStatus()
    {
        $trainId = \Yii::$app->request->get('trainId');
        $status = \Yii::$app->request->get('status');
        $model = TrainUsers::findOne(['id' => $trainId]);

        $model->setAttributes(['status' => $status]);

        if ($model->save()) {
            return $this->redirect('index');
        } else {
            throw new ServerErrorHttpException('更新状态失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
        }
    }

    public function actionDeleteTrainUsers()
    {
        $trainId = \Yii::$app->request->get('id');

        $model = TrainUsers::deleteAll(['id' => $trainId]);

        if ($model) {
            return $this->redirect('index');
        } else {
            throw new ServerErrorHttpException('删除失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
        }
    }

    public function actionTrainView()
    {
        $trainUsersId = \Yii::$app->request->get('trainUsersId');
        $levelName = Level::getOneLevelNameById(\Yii::$app->user->identity->level_id);
        //培训信息
        $trainModel = TrainUsers::getInfoById($trainUsersId);
        //考勤信息
        $attendanceModel = Attendance::getAllByTrainIdAndUserId($trainModel['train_id'], $trainModel['user_id']);
        $laterCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::LATER);
        $arlyCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::EARLY);
        $absencesCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::ABSENCES);
        $leaveCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::LEAVE);
        $trainTeachersModel = TrainTeachers::findAll(['train_id' => $trainModel['id']]);

        $result = [
            'levelName' => $levelName,
            'trainModel' => $trainModel,
            'attendanceModel' => $attendanceModel,
            'laterCount' => $laterCount,
            'arlyCount' => $arlyCount,
            'absencesCount' => $absencesCount,
            'leaveCount' => $leaveCount,
            'attendanceAppraise' => $trainModel['attendance_appraise'],
            'trainTeachersModel' => $trainTeachersModel
        ];

        return $this->render('trainView', ['result' => $result]);

    }

}
