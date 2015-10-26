<?php

namespace app\controllers;

use app\models\Activity;
use app\models\ActivityUsers;
use app\models\Attendance;
use app\models\Level;
use app\models\Messages;
use app\models\MessagesUsers;
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
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\Sms;

class UserCenterController extends \yii\web\Controller
{
    public $layout = 'userCenter';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'user',
                'only' => ['index','train-index', 'update-train-user-status','user-info', 'user-education', 'user-train', 'user-vocational', 'user-level-up','user-level-info','change-password'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','train-index', 'update-train-user-status','user-info', 'user-education', 'user-train', 'user-vocational','user-level-up','user-level-info','change-password'],
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'maxLength' => 5,
                'minLength' => 5
            ],
        ];
    }

    public function actionIndex()
    {
        $isPage = \Yii::$app->request->get('is_page');
        $levelName = Level::getOneLevelNameById(\Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $trainModel = TrainUsers::getAllTrainByUserId(\Yii::$app->user->id, $isPage);
        $currentTrain = TrainUsers::getTrainByUserId(\Yii::$app->user->id);

        $data = [
            'levelName' => $levelName,
            'trainModel' => $trainModel,
            'currentTrain' => $currentTrain,
            'photo' => $photo,
            'messageCount' => $messageCount
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
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
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
            'photo' => $photo,
            'messageCount' => $messageCount

        ];

        return $this->render('train-view', ['data' => $data]);

    }

    public function actionTrainIndex()
    {
        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;
        $userId = \Yii::$app->user->id;
        $levelName = Level::getOneLevelNameById(\Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
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
            'photo' => $photo,
            'messageCount' => $messageCount
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
                return $this->redirect('/user-center/user-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        }else {

            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $userModel = Users::findOne(['id'=>Yii::$app->user->id]);
            $userEducation = UsersEducation::findAll(['user_id' => Yii::$app->user->id]);
            $userTrain = UsersTrain::findAll(['user_id' => Yii::$app->user->id]);
            $userVocational = UsersVocational::findAll(['user_id' => Yii::$app->user->id]);
            $userPlayers = UsersPlayers::findAll(['user_id' => Yii::$app->user->id]);

            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount,
            ];
            return $this->render('user-info',[
                'userModel' => $userModel,
                'data' => $data,
                'model' => $model,
                'userEducation' => $userEducation,
                'userTrain' => $userTrain,
                'userVocational' => $userVocational,
                'userPlayers' => $userPlayers,
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
                return $this->redirect('/user-center/user-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersEducation::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-info');
        } else {
            $model = UsersEducation::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
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
                return $this->redirect('/user-center/user-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersTrain::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-info');
        } else {
            $model = UsersTrain::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
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
                return $this->redirect('/user-center/user-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersVocational::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-info');
        } else {
            $model = UsersVocational::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
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
                return $this->redirect('/user-center/user-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }

        } else if (Yii::$app->request->get('id')) {
            UsersPlayers::findOne(Yii::$app->request->get('id'))->delete();
            return $this->redirect('/user-center/user-info');
        } else {
            $model = UsersPlayers::findAll(['user_id' => Yii::$app->user->id]);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
            ];
            return $this->render('user-players',[
                'data' => $data,
                'model' => $model
            ]);
        }
    }

    public function actionUserLevelUp()
    {
        if (Yii::$app->request->isPost) {

        } else {
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);


            $levelInfo = Level::findOne(['id' => Yii::$app->user->identity->level_id + 1]);

            $loginDuration = Users::getLoginDuration(Yii::$app->user->id);
            $scoreDiff = $levelInfo['score'] - Yii::$app->user->identity->score;
            $creditDiff = $levelInfo['credit'] - Yii::$app->user->identity->credit;
            $loginDurationDiff = $levelInfo['login_duration'] - $loginDuration;
            $levelNameNext = $levelInfo['name'];

            if ($scoreDiff <= 0 && $creditDiff <= 0 && $loginDurationDiff <= 0) {
                $buttonStyle = 'true';
            }

                $levelUpInfo = [
                    'scoreCurrent' => Yii::$app->user->identity->score - 60,
                    'creditCurrent' => Yii::$app->user->identity->credit,
                    'loginDurationCurrent' => $loginDuration,
                    'levelCurrent' => $levelName,
                    'scoreDiff' => $scoreDiff,
                    'creditDiff' => $creditDiff,
                    'loginDurationDiff' => $loginDurationDiff,
                    'levelNameNext' => $levelNameNext,
                    'buttonStyle' => $buttonStyle
                ];

            $data = [
                'levelUpInfo' => $levelUpInfo,
                'loginDuration' => $loginDuration,
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
            ];
            return $this->render('user-level-up',['data' => $data]);

        }
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
                $model->photo->saveAs('upload/images/users_level/photo/' . $photoFileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $infoParams['UsersLevel']['photo'] = $photoFileName;

                }
            }

            $userLevelInfo = $infoParams;

            if ($model->load($userLevelInfo) && $model->save()) {
                return $this->redirect('/user-center/user-level-info');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
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
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount,
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

    public function actionActivity()
    {

        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;
        $userId = \Yii::$app->user->id;

        $activityListA = $this->getActivityListByLevelId(2);
        $activityListB = $this->getActivityListByLevelId(3);
        $activityListC = $this->getActivityListByLevelId(4);
        $activityListD = $this->getActivityListByLevelId(5);
        $activityListE = $this->getActivityListByLevelId(6);
        $activityListF = $this->getActivityListByLevelId(7);


        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
        $data = [
            'levelName' => $levelName,
            'currentTrain' => $currentTrain,
            'photo' => $photo,
            'messageCount' => $messageCount,
            'activityListA' => $activityListA,
            'activityListB' => $activityListB,
            'activityListC' => $activityListC,
            'activityListD' => $activityListD,
            'activityListE' => $activityListE,
            'activityListF' => $activityListF,
        ];
        return $this->render('activity-index', [
            'data' => $data
        ]);
    }

    public function actionPay()
    {
        $id = Yii::$app->request->get("id");

        //执行支付
        $result = UsersLevel::updateAll(['status' => '3'], ['id'=> $id]);
        if ($result) {
            return $this->redirect('/user-center/user-level-info');
        }
    }

    public function actionMessagesComment()
    {
        if (Yii::$app->request->isPost) {
            $idList = Yii::$app->request->post('id_list');
            if (!empty($idList)) {
                $result = MessagesUsers::deleteAll(['id' => $idList]);
                if (!$result) {
                    throw new ServerErrorHttpException('删除错误');
                } else {
                    return $this->redirect('/user-center/messages-comment');
                }
            }
        } else {
            $modelAndPages = MessagesUsers::getMessagesByTypeUserId(\Yii::$app->user->id,1);

            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
            $data = [
                'model' => $modelAndPages,
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
            ];
            return $this->render('messages-comment',['data' => $data]);
        }
    }

    public function actionMessagesView()
    {
        $id = Yii::$app->request->get('id');
        $messagesInfo = Messages::findOne($id);
        MessagesUsers::updateAll(['status'=>1], ['messages_id'=>$id]);
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);
        $data = [
            'messagesInfo' => $messagesInfo,
            'levelName' => $levelName,
            'currentTrain' => $currentTrain,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('messages-view', ['data' => $data]);
    }

    public function actionSystemComment()
    {
        if (Yii::$app->request->isPost) {
            $idList = Yii::$app->request->post('id_list');
            if (!empty($idList)) {
                $result = MessagesUsers::deleteAll(['id' => $idList]);
                if (!$result) {
                    throw new ServerErrorHttpException('删除错误');
                } else {
                    return $this->redirect('/user-center/system-comment');
                }
            }
        } else {

            $modelAndPages = MessagesUsers::getMessagesByTypeUserId(\Yii::$app->user->id,2);
            $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
            $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
            $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
            $currentTrain = TrainUsers::getTrainByUserId(Yii::$app->user->id);

            $data = [
                'model' => $modelAndPages,
                'levelName' => $levelName,
                'currentTrain' => $currentTrain,
                'photo' => $photo,
                'messageCount' => $messageCount
            ];
            return $this->render('system-comment',['data' => $data]);
        }
    }

    public function actionCommentDelete()
    {
        $id = Yii::$app->request->get("id");
        $type = Yii::$app->request->get("type");
        MessagesUsers::deleteAll(['messages_id' => $id, 'users_id' => \Yii::$app->user->id]);
        if ($type == 1) {
            return $this->redirect('/user-center/messages-comment');
        } else {
            return $this->redirect('/user-center/system-comment');
        }
    }

    public function actionLoginInfo()
    {
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $phone = Yii::$app->user->identity->mobile_phone;
        $phoneHidden = substr_replace($phone, '****', 4, 4);
        $email = Yii::$app->user->identity->email;
        $emailHidden = substr_replace($email, '****', 4, 4);
        $data = [
            'phoneHidden' => $phoneHidden,
            'emailHidden' => $emailHidden,
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('login-info',['data' => $data]);

    }

    public function actionChangePassword()
    {
        $model = Users::findOne(Yii::$app->user->id);
        $step = Yii::$app->request->get('step');

        if (Yii::$app->request->isPost) {
            if ($step == 1) {
                $verifyCode = Yii::$app->request->post('verifyCode');
                $checkNum = Yii::$app->request->post('check_num');
                $session = Yii::$app->session;

                if ($checkNum != $session['checkNum']) {
                    throw new ServerErrorHttpException('短信验证码输入错误，请重新输入！');
                }
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                }

                return $this->redirect(['/user-center/change-password', 'step' => 2]);
            } elseif($step == 2) {
                $password = Yii::$app->request->post('password');
                $password_confirm = Yii::$app->request->post('password_confirm');
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    $verifyCode = Yii::$app->request->post('verifyCode');
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                }
                if ($password != $password_confirm) {
                    throw new ServerErrorHttpException('两次输入密码不一致，请重新输入！');
                }
                $password = md5($password);
                Users::updateAll(['password' => $password], ['id' => Yii::$app->user->id]);
                return $this->redirect(['/user-center/change-password', 'step' => 3]);
            }
        }
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $phone = Yii::$app->user->identity->mobile_phone;
        $phoneHidden = substr_replace($phone, '****', 4, 4);
        $data = [
            'step' => $step,
            'phoneHidden' => $phoneHidden,
            'phone' => $phone,
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('change-password',['data' => $data,'model' => $model]);
    }

    public function actionChangeEmail()
    {
        $model = Users::findOne(Yii::$app->user->id);
        $step = Yii::$app->request->get('step');

        if (Yii::$app->request->isPost) {
            if ($step == 1) {
                $verifyCode = Yii::$app->request->post('verifyCode');
                $checkNum = Yii::$app->request->post('check_num');
                $session = Yii::$app->session;

                if ($checkNum != $session['checkNum']) {
                    throw new ServerErrorHttpException('短信验证码输入错误，请重新输入！');
                }
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                }

                return $this->redirect(['/user-center/change-email', 'step' => 2]);
            } elseif($step == 2) {
                $email = Yii::$app->request->post('email');
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    $verifyCode = Yii::$app->request->post('verifyCode');
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                }

                Users::updateAll(['email' => $email], ['id' => Yii::$app->user->id]);
                return $this->redirect(['/user-center/change-email', 'step' => 3]);
            }
        }
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $phone = Yii::$app->user->identity->mobile_phone;
        $phoneHidden = substr_replace($phone, '****', 4, 4);
        $data = [
            'step' => $step,
            'phoneHidden' => $phoneHidden,
            'phone' => $phone,
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('change-email',['data' => $data,'model' => $model]);
    }
    public function actionChangePhone()
    {
        $model = Users::findOne(Yii::$app->user->id);
        $step = Yii::$app->request->get('step');

        if (Yii::$app->request->isPost) {
            if ($step == 1) {
                $verifyCode = Yii::$app->request->post('verifyCode');
                $checkNum = Yii::$app->request->post('check_num');
                $session = Yii::$app->session;

                if ($checkNum != $session['checkNum']) {
                    throw new ServerErrorHttpException('短信验证码输入错误，请重新输入！');
                }
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                }

                return $this->redirect(['/user-center/change-phone', 'step' => 2]);
            } elseif($step == 2) {
                $phone = Yii::$app->request->post('phone');
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    $verifyCode = Yii::$app->request->post('verifyCode');
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                }

                Users::updateAll(['mobile_phone' => $phone], ['id' => Yii::$app->user->id]);
                return $this->redirect(['/user-center/change-phone', 'step' => 3]);
            }
        }
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);
        $phone = Yii::$app->user->identity->mobile_phone;
        $phoneHidden = substr_replace($phone, '****', 4, 4);
        $data = [
            'step' => $step,
            'phoneHidden' => $phoneHidden,
            'phone' => $phone,
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('change-phone',['data' => $data,'model' => $model]);
    }


    public function actionCheckEmail()
    {
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);

        $data = [
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('check-email',['data' => $data]);

    }

    public function actionCheckPhone()
    {
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);

        $data = [
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('check-phone',['data' => $data]);

    }

    public function actionOrders()
    {
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $photo = UsersInfo::getPhotoByUserId(\Yii::$app->user->id);
        $messageCount = MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id);

        $data = [
            'levelName' => $levelName,
            'photo' => $photo,
            'messageCount' => $messageCount
        ];
        return $this->render('orders',['data' => $data]);

    }


    public function actionGetCheckNum()
    {
        $phone = Yii::$app->request->get('phone');
        $checkNum = rand(100000,999999);
        $session = Yii::$app->session;

        if (!isset($session['time']))//判断缓存时间
        {
            $session['time'] = date("Y-m-d H:i:s");
        }
        $session['checkNum'] = $checkNum;//将content的值保存在session中
        if (!empty($phone)) {
            if ((strtotime($session['time']) + 60) < time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过期
                session_destroy();
                $session->remove('time');
                $msg =  '验证码已过期，请重新获取！';
            } else {
                return $checkNum;
                $content = "尊敬的学员，您的注册验证码是".$checkNum.",次验证码于一分钟后过期，请尽快完成注册，谢谢！【教练系统】";
                $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);

                $result = $smsModel->pushMt($phone, time(), $content, 0);
                if ($result == '0') {
                    $msg = '验证码已经发送到手机'.$phone . '，请注意查收。';
                } else {
                    $msg = $result;
                }
            }
        } else {
            $msg =  '发送失败，请再次尝试！';
        }
        return $msg;
    }

    public function getActivityListByLevelId($levelId)
    {
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
                $countResult = ActivityUsers::find()->where(['activity_id' => $val->id, 'status' => [ActivityUsers::APPROVED,ActivityUsers::DOING,ActivityUsers::END]]);
                $val->already_recruit_count  = $countResult->count();
            }
        }
        return $models;
    }
}
