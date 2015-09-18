<?php

namespace app\controllers;

use app\models\ActivityUsers;
use app\models\Attendance;
use app\models\Level;
use app\models\TrainTeachers;
use app\models\TrainUsers;
use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersEducation;
use app\models\UsersLevel;
use app\models\UsersTrain;
use app\models\UsersVocational;
use app\models\UsersPlayers;
use yii\web\ServerErrorHttpException;
use Yii;
use yii\web\UploadedFile;


class UserCenterController extends \yii\web\Controller
{
    public $layout = 'userCenter';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'user',
                'only' => ['index','train-index', 'update-train-user-status','user-info', 'user-education', 'user-train', 'user-vocational', 'user-level-up','user-level-info'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','train-index', 'update-train-user-status','user-info', 'user-education', 'user-train', 'user-vocational','user-level-up','user-level-info'],
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
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $trainModel = TrainUsers::getAllTrainByUserId(\Yii::$app->user->id, $isPage);
        $activityModel = ActivityUsers::getAllActivityByUserId(\Yii::$app->user->id, $isPage);
        $currentTrain = TrainUsers::getTrainByUserId(\Yii::$app->user->id);

        $data = [
            'levelName' => $levelName,
            'trainModel' => $trainModel,
            'currentTrain' => $currentTrain,
            'photo' => $photo
        ];
        return $this->render('index', ['data' => $data]);
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
        if (empty($trainUsersId)) {
            throw new ServerErrorHttpException('查看课程信息失败，原因：参数错误！');
        }

        $levelName = Level::getOneLevelNameById(\Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $currentTrain = TrainUsers::getTrainByUserId(\Yii::$app->user->id);
        //培训信息
        $trainModel = TrainUsers::getTrainInfoById($trainUsersId);
        if (empty($trainModel)) {
            throw new ServerErrorHttpException('查看课程信息失败，原因：不存在的培训课程！');
        }
        //考勤信息
        $attendanceModel = Attendance::getAllByTrainIdAndUserId($trainModel['train_id'], $trainModel['user_id']);
        //迟到数量
        $laterCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::LATER);
        $arlyCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::EARLY);
        $absencesCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::ABSENCES);
        $leaveCount = Attendance::getCount($trainModel['train_id'], $trainModel['user_id'], Attendance::LEAVE);
        $trainTeachersModel = TrainTeachers::getAllTeachersByTrainId($trainModel['id']);
        $usersModel = TrainUsers::getAllUsersByTrainId($trainModel['id']);
        if (!empty($usersModel)) {
            foreach ($usersModel as $key => $val) {
                $usersModel[$key]['img'] = '';
                for ($i = 1; $i <= ($val['score_appraise'] / 20); $i++) {
                    $usersModel[$key]['img'] .= '<img src="/images/user/xx1.jpg" />';
                }
                if ($val['score_appraise'] % 20 > 0) {
                    $usersModel[$key]['img'] .= '<img src="/images/user/xx2.jpg" />';
                }
            }
        }
        $data = [
            'levelName' => $levelName,
            'currentTrain' => $currentTrain,
            'trainModel' => $trainModel,
            'attendanceModel' => $attendanceModel,
            'laterCount' => $laterCount,
            'arlyCount' => $arlyCount,
            'absencesCount' => $absencesCount,
            'leaveCount' => $leaveCount,
            'attendanceAppraise' => $trainModel['attendance_appraise'],
            'trainTeachersModel' => $trainTeachersModel,
            'usersModel' => $usersModel,
            'photo' => $photo

        ];

        return $this->render('train-view', ['data' => $data]);

    }

    public function actionTrainIndex()
    {
        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;
        $userId = \Yii::$app->user->id;
        $levelName = Level::getOneLevelNameById(\Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $currentTrain = TrainUsers::getTrainByUserId(\Yii::$app->user->id);

        $trainListA = TrainUsers::getAllTrainByUserIdAndLevel($userId,2);
        $trainListB = TrainUsers::getAllTrainByUserIdAndLevel($userId,3);
        $trainListC = TrainUsers::getAllTrainByUserIdAndLevel($userId,4);
        $trainListD = TrainUsers::getAllTrainByUserIdAndLevel($userId,5);
        $trainListE = TrainUsers::getAllTrainByUserIdAndLevel($userId,6);
        $trainListF = TrainUsers::getAllTrainByUserIdAndLevel($userId,7);

        $data = [
            'levelName' => $levelName,
            'currentTrain' => $currentTrain,
            'levelId' => $levelId,
            'trainListA' => $trainListA,
            'trainListB' => $trainListB,
            'trainListC' => $trainListC,
            'trainListD' => $trainListD,
            'trainListE' => $trainListE,
            'trainListF' => $trainListF,
            'photo' => $photo

        ];
        return $this->render('train-index', ['data' => $data]);
    }

    public function actionUserInfo()
    {
        $model = UsersInfo::findOne(['user_id' => Yii::$app->user->id]);
        if (empty($model)) {
            $model = new UsersInfo();
        }
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();

            $model->photo = UploadedFile::getInstance($model, 'photo');
            if (!empty($model->photo)) {
                if (!in_array($model->photo->extension, ['jpg', 'gif'])) {
                    throw new ServerErrorHttpException('不允许的格式');
                }
                $photoFileName = time().  '.' .$model->photo->extension;
                $model->photo->saveAs('upload/images/users_info/photo/' . $photoFileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $infoParams['UsersInfo']['photo'] = $photoFileName;

                }
            } else {
                $infoParams['UsersInfo']['photo'] = '';
            }

            $model->credentials_photo = UploadedFile::getInstance($model, 'credentials_photo');
            if (!empty($model->credentials_photo)) {
                if (!in_array($model->credentials_photo->extension, ['jpg', 'gif'])) {
                    throw new ServerErrorHttpException('不允许的格式');
                }
                $credentialsPhotoFileName = time().  '.' .$model->credentials_photo->extension;
                $model->credentials_photo->saveAs('upload/images/users_info/credentials_photo/' . $credentialsPhotoFileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $infoParams['UsersInfo']['credentials_photo'] = $credentialsPhotoFileName;
                }
            } else {
                $infoParams['UsersInfo']['credentials_photo'] = '';
            }


            $infoParams['UsersInfo']['user_id'] = Yii::$app->user->id;

            $infoInfo = $infoParams;
            if ($model->load($infoInfo) && $model->save()) {
                $userModel = Users::findOne(['id'=>Yii::$app->user->id]);
                $userModel->username = $model->name;
                if (!empty($infoParams['Users']['mobile_phone'])) {
                    $userModel->mobile_phone = $infoParams['Users']['mobile_phone'];
                }
                if (!empty($infoParams['Users']['email'])) {
                    $userModel->email = $infoParams['Users']['email'];
                }
                if (!$userModel->save()) {
                    throw new ServerErrorHttpException('系统错误,原因：' . json_encode($userModel->errors, JSON_UNESCAPED_UNICODE));
                }
                return $this->redirect('/user-center/user-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        }else {

            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $userModel = Users::findOne(['id'=>Yii::$app->user->id]);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo
            ];
            return $this->render('user-info',[
                'userModel' => $userModel,
                'data' => $data,
                'model' => $model,
            ]);
        }
    }

    public function actionUserEducation()
    {

        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();

            $infoParams['UsersEducation']['user_id'] = Yii::$app->user->id;
            if (empty($infoParams['UsersEducation']['end_time'])) {
                $infoParams['UsersEducation']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            $model = new UsersEducation();
            if ($model->load($infoInfo) && $model->save()) {
                return $this->redirect('/user-center/user-education');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersEducation::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-education');
        } else {
            $model = UsersEducation::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo
            ];
            return $this->render('user-education',[
                'data' => $data,
                'model' => $model
            ]);
        }
    }

    public function actionUserTrain()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();

            $infoParams['UsersTrain']['user_id'] = Yii::$app->user->id;
            if (empty($infoParams['UsersTrain']['end_time'])) {
                $infoParams['UsersTrain']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            $model = new UsersTrain();
            if ($model->load($infoInfo) && $model->save()) {
                return $this->redirect('/user-center/user-train');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersTrain::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-train');
        } else {
            $model = UsersTrain::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo
            ];
            return $this->render('user-train',[
                'data' => $data,
                'model' => $model
            ]);
        }
    }


    public function actionUserVocational()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();

            $infoParams['UsersVocational']['user_id'] = Yii::$app->user->id;
            if (empty($infoParams['UsersVocational']['end_time'])) {
                $infoParams['UsersVocational']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            $model = new UsersVocational();
            if ($model->load($infoInfo) && $model->save()) {
                return $this->redirect('/user-center/user-vocational');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersVocational::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-vocational');
        } else {
            $model = UsersVocational::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo
            ];
            return $this->render('user-vocational',[
                'data' => $data,
                'model' => $model
            ]);
        }
    }

    public function actionUserPlayers()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();

            $infoParams['UsersPlayers']['user_id'] = Yii::$app->user->id;
            if (empty($infoParams['UsersPlayers']['end_time'])) {
                $infoParams['UsersPlayers']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            $model = new UsersPlayers();
            if ($model->load($infoInfo) && $model->save()) {
                return $this->redirect('/user-center/user-players');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersPlayers::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-players');
        } else {
            $model = UsersPlayers::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo
            ];
            return $this->render('user-players',[
                'data' => $data,
                'model' => $model
            ]);
        }
    }

    public function actionUserLevelUp()
    {

    }

    public function actionUserLevelInfo()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $model = UsersLevel::findOne($id);
            $infoParams = Yii::$app->request->post();

            $model->photo = UploadedFile::getInstance($model, 'photo');
            if (!empty($model->photo)) {
                if (!in_array($model->photo->extension, ['jpg', 'gif'])) {
                    throw new ServerErrorHttpException('不允许的格式');
                }
                $photoFileName = time().  '.' .$model->photo->extension;
                $model->photo->saveAs('upload/images/users_info/photo/' . $photoFileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $infoParams['UsersInfo']['photo'] = $photoFileName;

                }
            }

        } else {
            $modelA = UsersLevel::getUserLevelAndScoreByUserIdLevelId(Yii::$app->user->id, 2);
            $modelB = UsersLevel::getUserLevelAndScoreByUserIdLevelId(Yii::$app->user->id, 3);
            $modelC = UsersLevel::getUserLevelAndScoreByUserIdLevelId(Yii::$app->user->id, 4);
            $modelD = UsersLevel::getUserLevelAndScoreByUserIdLevelId(Yii::$app->user->id, 5);
            $modelE = UsersLevel::getUserLevelAndScoreByUserIdLevelId(Yii::$app->user->id, 6);
            $modelF = UsersLevel::getUserLevelAndScoreByUserIdLevelId(Yii::$app->user->id, 7);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'modelA' => $modelA,
                'modelB' => $modelB,
                'modelC' => $modelC,
                'modelD' => $modelD,
                'modelE' => $modelE,
                'modelF' => $modelF
            ];
            return $this->render('user-level-info',[
                'data' => $data
            ]);
        }

    }


}
