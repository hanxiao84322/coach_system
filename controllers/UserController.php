<?php

namespace app\controllers;

use app\models\Level;
use app\models\Messages;
use app\models\MessagesUsers;
use app\models\News;
use app\models\Pages;
use app\models\Sms;
use app\models\Train;
use app\models\TrainUsers;
use app\models\UsersEducation;
use app\models\UsersInfo;
use app\models\UsersLevel;
use app\models\UsersPlayers;
use app\models\UsersTrain;
use app\models\UsersVocational;
use Yii;
use app\models\Users;
use yii\web\ServerErrorHttpException;
use app\models\LoginForm;
use yii\web\UploadedFile;


class UserController extends \yii\web\Controller
{
    public $layout = 'user';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['registerInfo', 'registerEducation', 'logout', 'registerCoach', 'registerPlayers' , 'registerVocational' , 'registerCoach', 'registerCoachSuccess'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['registerInfo', 'registerEducation', 'logout', 'registerCoach', 'registerPlayers' , 'registerVocational' , 'registerCoach', 'registerCoachSuccess'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $levelList = Level::getAll();
        $districtList = [
            '' => '请选择区域',
            '朝阳区' => '朝阳区',
            '东城区' => '东城区',
            '海淀区' => '海淀区',
            '西城区' => '西城区',
            '昌平区' => '昌平区',
        ];
        $userCount = Users::getAllCount();
        $coachA = Users::getCountUserByLevelId(2,9);
        $coachB = Users::getCountUserByLevelId(3,9);
        $coachC = Users::getCountUserByLevelId(4,9);
        $coachD = Users::getCountUserByLevelId(5,9);
        $coachE = Users::getCountUserByLevelId(6,9);
        $coachF = Users::getCountUserByLevelId(7,9);

        $newsList = News::getNewsByCategory(5, 12);

        $data = [
            'levelList' => $levelList,
            'districtList' => $districtList,
            'userCount' => $userCount,
            'coachA' => $coachA,
            'coachB' => $coachB,
            'coachC' => $coachC,
            'coachD' => $coachD,
            'coachE' => $coachE,
            'coachF' => $coachF,
            'newsList' => $newsList
        ];
        return $this->render('index',['data' => $data]);
//        return $this->render('build',['data' => $data]);
    }

    public function actionRegister()
    {
        $type = Yii::$app->request->get('type');
        $trainId = Yii::$app->request->get('train_id');
        $session = Yii::$app->session;
        if (Yii::$app->request->isPost) {
            $trainId = Yii::$app->request->post('train_id');
            if(empty($trainId)) {
                throw new ServerErrorHttpException('请重新选择课程！');
            }
            $registerParams = Yii::$app->request->post();
            if (empty($registerParams['email']) && empty($registerParams['phone'])) {
                throw new ServerErrorHttpException('请输入手机号或者邮箱！');
            }
            if(empty($registerParams['password'])) {
                throw new ServerErrorHttpException('请填写密码！');
            }
            if ($registerParams['password'] != $registerParams['password_repeat']) {
                throw new ServerErrorHttpException('两次输入的密码不相同，请重新输入！');
            }
                $usersModel = new Users();
            if (!empty($registerParams['email'])) {
                //验证
                $isExist = Users::findOne(['email' => $registerParams['email']]);
                if (!empty($isExist)) {
                    throw new ServerErrorHttpException('已经存在的邮箱地址！');
                }
                $registerInfo = [
                    '_csrf' => $registerParams['_csrf'],
                    'Users' => [
                        'email' => $registerParams['email'],
                        'password' => $registerParams['password'],
                        'score' => 0,
                        'username' => '注册学员' . time(),
                        'level_id' => 1,
                        'level_order' => 1,
                    ]
                ];
            } else {
                $isExist = Users::findOne(['mobile_phone' => $registerParams['phone']]);
                if (!empty($isExist)) {
                    throw new ServerErrorHttpException('已经存在的手机号码！');
                }
                if ($registerParams['check_num'] != $session['checkNum']) {
                    throw new ServerErrorHttpException('短信验证码输入错误，请重新输入！');
                }
                //验证手机
                $registerInfo = [
                    '_csrf' => $registerParams['_csrf'],
                    'Users' => [
                        'mobile_phone' => $registerParams['phone'],
                        'password' => $registerParams['password'],
                        'username' => '注册学员' . time(),
                        'score' => 0,
                        'level_id' => 1,
                        'level_order' => 1,
                    ]
                ];
            }
            $transaction = Yii::$app->db->beginTransaction();
            if ($usersModel->load($registerInfo) && $usersModel->save()) {
                //新增一条用users_level
                $userLevelModel = new UsersLevel();
                $userLevelModel->user_id = $usersModel->id;
                $userLevelModel->level_id = 1;
                $userLevelModel->train_id = $trainId;
                if (!$userLevelModel->save()) {
                    $transaction->rollBack();
                    throw new ServerErrorHttpException('更新状态错误，原因：' . json_encode($userLevelModel->errors, JSON_UNESCAPED_UNICODE) . '！');
                } else {
                    $trainUsersOrder = TrainUsers::getTrainUsersOrder($trainId);
                    if (empty($trainUsersOrder)) {
                        $trainUsersOrder = 1;
                    } else {
                        $trainUsersOrder=$trainUsersOrder+1;
                    }
                    //新增一条用train_users
                    $trainUsers = new TrainUsers();
                    $trainUsers->train_id = $trainId;
                    $trainUsers->level_id = 2;
                    $trainUsers->user_id = $usersModel->id;
                    $trainUsers->status = TrainUsers::SIGN;
                    $trainUsers->practice_score = 0;
                    $trainUsers->theory_score = 0;
                    $trainUsers->rule_score = 0;
                    $trainUsers->orders = $trainUsersOrder;
                    if (!$trainUsers->save()) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException(json_encode($trainUsers->errors, JSON_UNESCAPED_UNICODE));
                    } else {
                        $transaction->commit();
                    }
                }

                $model = new LoginForm();
                $loginInfo['_csrf'] = $registerInfo['_csrf'];
                $loginInfo['LoginForm'] = $registerInfo['Users'];
                unset($loginInfo['LoginForm']['level_id']);
                unset($loginInfo['LoginForm']['level_order']);
                unset($loginInfo['LoginForm']['score']);
                $loginInfo['LoginForm']['rememberMe'] = 0;
                if ($model->load($loginInfo) && $model->login()) {
                    return $this->redirect(['/user/register-info','train_id'=>$trainId]);
                } else {
                    throw new ServerErrorHttpException('自动登录失败,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                }
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($usersModel->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            $maxCount = TrainUsers::getMaxSignUpOrder($trainId);
            if ($maxCount<1) {
                $maxCount = 1;
            } else {
                $maxCount = $maxCount+1;
            }
            $trainName = Train::getOneTrainNameById($trainId);
            $data = [
                'maxCount' => $maxCount,
                'trainName' => $trainName,
                'train_id' => $trainId
            ];
            return $this->render('register', ['type' => $type, 'data' => $data]);
        }
    }

    public function actionRegisterInfo()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();
            $trainId = Yii::$app->request->post('train_id');
            $year = Yii::$app->request->post('year');
            $month = Yii::$app->request->post('month');
            $day = Yii::$app->request->post('day');
            $userId = Yii::$app->user->id;

            if (!empty($infoParams['Users']['mobile_phone'])) {
                $isExist = Users::findOne(['mobile_phone' => $infoParams['Users']['mobile_phone']]);
                if ($isExist) {
                    throw new ServerErrorHttpException('已经存在的手机！');
                }
            }
            if (!empty($infoParams['Users']['email'])) {
                $isExist = Users::findOne(['email' => $infoParams['Users']['email']]);
                if ($isExist) {
                    throw new ServerErrorHttpException('已经存在的email！');
                }
            }

            if (!empty($infoParams['UsersInfo']['name'])) {
                $isExist = UsersInfo::findOne(['credentials_number' => $infoParams['UsersInfo']['credentials_number']]);
                if ($isExist) {
                    throw new ServerErrorHttpException('已经存在的身份证号码！');
                }
            }
            if (!empty($infoParams['UsersInfo']['telephone']) && !empty($infoParams['UsersInfo']['mobile_phone'])) {
                if ($infoParams['UsersInfo']['mobile_phone'] == $infoParams['UsersInfo']['telephone']) {
                    throw new ServerErrorHttpException('联系电话不能和手机相同！');
                }
            }

            $modelInfo = new UsersInfo();

            $modelInfo->photo = UploadedFile::getInstance($modelInfo, 'photo');
            if (!empty($modelInfo->photo)) {
                if (!in_array($modelInfo->photo->extension, ['jpg', 'gif'])) {
                    throw new ServerErrorHttpException('不允许的格式');
                }
                $photoFileName = time().  '.' .$modelInfo->photo->extension;
                $modelInfo->photo->saveAs('upload/images/users_info/photo/' . $photoFileName, true);

                if ($modelInfo->hasErrors('file')){
                    throw new ServerErrorHttpException($modelInfo->getErrors('file'));
                } else {
                    $infoParams['UsersInfo']['photo'] = $photoFileName;

                }
            } else {
                $infoParams['UsersInfo']['photo'] = '';
            }

            $modelInfo->credentials_photo = UploadedFile::getInstance($modelInfo, 'credentials_photo');
            if (!empty($modelInfo->credentials_photo)) {
                if (!in_array($modelInfo->credentials_photo->extension, ['jpg', 'gif'])) {
                    throw new ServerErrorHttpException('不允许的格式');
                }
                $credentialsPhotoFileName = time().  '.' .$modelInfo->credentials_photo->extension;
                $modelInfo->credentials_photo->saveAs('upload/images/users_info/credentials_photo/' . $credentialsPhotoFileName, true);

                if ($modelInfo->hasErrors('file')){
                    throw new ServerErrorHttpException($modelInfo->getErrors('file'));
                } else {
                    $infoParams['UsersInfo']['credentials_photo'] = $credentialsPhotoFileName;
                }
            } else {
                $infoParams['UsersInfo']['credentials_photo'] = '';
            }

            $infoParams['UsersInfo']['user_id'] = $userId;
            $infoParams['UsersInfo']['birthday'] = $year . '-' . $month . '-' . $day . ' 00:00:00';

            $transaction = Yii::$app->db->beginTransaction();
            $infoInfo = $infoParams;
            if ($modelInfo->load($infoInfo) && $modelInfo->save()) {
                if (!empty($infoInfo['Users']['mobile_phone'])) {
                    $result = Users::updateAll(['username'=>$infoInfo['UsersInfo']['name'], 'status' => 1, 'mobile_phone' => $infoInfo['Users']['mobile_phone']],['id' => $userId]);
                    if (!$result) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('更新信息错误！');
                    }
                } else {
                    $result = Users::updateAll(['username'=>$infoInfo['UsersInfo']['name'], 'status' => 1, 'email' => $infoInfo['Users']['email'], 'phone_auth' => 1],['id' => $userId]);
                    if (!$result) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('更新信息错误！');
                    }
                }
                //更新级别信息的信息
                $result = UsersLevel::updateAll(['credentials_number' => $infoParams['UsersInfo']['credentials_number'],'district' => $infoParams['UsersInfo']['account_location'],'receive_address' => $infoParams['UsersInfo']['contact_address'],'postcode' => $infoParams['UsersInfo']['contact_postcode']], ['user_id' => $userId]);
                if (!$result) {
                    $transaction->rollBack();
                    throw new ServerErrorHttpException('更新信息错误！');
                } else {
                    $content = "尊敬的学员，您已经申请报名，请耐心等待，谢谢！【教练系统】";
                    $this->sendMessage($content,Messages::SIGN,$userId,Yii::$app->user->identity->mobile_phone);
                    $transaction->commit();
                    return $this->redirect(['/user/register-education','train_id' => $trainId]);

                }
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($modelInfo->errors, JSON_UNESCAPED_UNICODE));
            }
        }else {
            $model = UsersInfo::findOne(['user_id'=>Yii::$app->user->id]);
            $trainId = Yii::$app->request->get('train_id');
            $trainName = Train::getOneTrainNameById($trainId);

            $userModel = Users::findOne(Yii::$app->user->id);
            return $this->render('register-info',[
                'model' => $model,
                'userModel' => $userModel,
                'train_id' => $trainId,
                'trainName' => $trainName
            ]);
        }
    }

    public function actionRegisterEducation()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();
            $userId = Yii::$app->user->id;
            $trainId = Yii::$app->request->post('train_id');
            $modelInfo = new UsersEducation();

            $infoParams['UsersEducation']['user_id'] = $userId;
            if (empty($infoParams['UsersEducation']['end_time'])) {
                $infoParams['UsersEducation']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            if ($modelInfo->load($infoInfo) && $modelInfo->save()) {
                return $this->redirect(['/user/register-education', 'train_id' => $trainId]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($modelInfo->errors, JSON_UNESCAPED_UNICODE));
            }
        }elseif (Yii::$app->request->get('id')) {
            if (UsersEducation::deleteAll(['id' => Yii::$app->request->get('id')])) {
                return $this->redirect(['/user/register-education', 'train_id' => Yii::$app->request->get('train_id')]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：删除失败！');
            }
        } else {
            $userId = Yii::$app->user->id;
            $trainId = Yii::$app->request->get('train_id');
            $trainName = Train::getOneTrainNameById($trainId);

            $model = UsersEducation::findAll(['user_id' => $userId]);
            return $this->render('register-education',[
                'model' => $model,
                'train_id' => $trainId,
                'trainName' => $trainName
            ]);
        }
    }

    public function actionRegisterTrain()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();
            $userId = Yii::$app->user->id;
            $trainId = Yii::$app->request->post('train_id');
            $modelInfo = new UsersTrain();

            $infoParams['UsersTrain']['user_id'] = $userId;
            if (empty($infoParams['UsersTrain']['end_time'])) {
                $infoParams['UsersTrain']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            if ($modelInfo->load($infoInfo) && $modelInfo->save()) {
                return $this->redirect(['/user/register-train', 'train_id' => $trainId]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($modelInfo->errors, JSON_UNESCAPED_UNICODE));
            }
        }elseif (Yii::$app->request->get('id')) {
            if (UsersTrain::deleteAll(['id' => Yii::$app->request->get('id')])) {
                return $this->redirect(['/user/register-train', 'train_id' => Yii::$app->request->get('train_id')]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：删除失败！');
            }
        } else {
            $userId = Yii::$app->user->id;

            $model = UsersTrain::findAll(['user_id' => $userId]);
            $trainId = Yii::$app->request->get('train_id');
            $trainName = Train::getOneTrainNameById($trainId);

            return $this->render('register-train',[
                'model' => $model,
                'train_id' => $trainId,
                'trainName' => $trainName
            ]);
        }
    }

    public function actionRegisterVocational()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();
            $userId = Yii::$app->user->id;
            $trainId = Yii::$app->request->post('train_id');
            $modelInfo = new UsersVocational();

            $infoParams['UsersVocational']['user_id'] = $userId;
            if (empty($infoParams['UsersVocational']['end_time'])) {
                $infoParams['UsersVocational']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            if ($modelInfo->load($infoInfo) && $modelInfo->save()) {
                return $this->redirect(['/user/register-vocational', 'train_id' => $trainId]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($modelInfo->errors, JSON_UNESCAPED_UNICODE));
            }
        }elseif (Yii::$app->request->get('id')) {
            if (UsersVocational::deleteAll(['id' => Yii::$app->request->get('id')])) {
                return $this->redirect(['/user/register-vocational', 'train_id' => Yii::$app->request->get('train_id')]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：删除失败！');
            }
        }else {
            $userId = Yii::$app->user->id;

            $model = UsersVocational::findAll(['user_id' => $userId]);
            $trainId = Yii::$app->request->get('train_id');
            $trainName = Train::getOneTrainNameById($trainId);

            return $this->render('register-vocational',[
                'model' => $model,
                'train_id' => $trainId,
                'trainName' => $trainName
            ]);
        }
    }

    public function actionRegisterPlayers()
    {
        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();
            $userId = Yii::$app->user->id;
            $trainId = Yii::$app->request->post('train_id');
            $modelInfo = new UsersPlayers();

            $infoParams['UsersPlayers']['user_id'] = $userId;
            if (empty($infoParams['UsersPlayers']['end_time'])) {
                $infoParams['UsersPlayers']['end_time'] = date('Y-m-d H:i:s', time());
            }
            $infoInfo = $infoParams;
            if ($modelInfo->load($infoInfo) && $modelInfo->save()) {
                return $this->redirect(['/user/register-players', 'train_id' => $trainId]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($modelInfo->errors, JSON_UNESCAPED_UNICODE));
            }
        }elseif (Yii::$app->request->get('id')) {
            if (UsersPlayers::deleteAll(['id' => Yii::$app->request->get('id')])) {
                return $this->redirect(['/user/register-players', 'train_id' => Yii::$app->request->get('train_id')]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：删除失败！');
            }
        }else {
            $userId = Yii::$app->user->id;

            $model = UsersPlayers::findAll(['user_id' => $userId]);
            $trainId = Yii::$app->request->get('train_id');
            $trainName = Train::getOneTrainNameById($trainId);

            return $this->render('register-players',[
                'model' => $model,
                'train_id' => $trainId,
                'trainName' => $trainName
            ]);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/user-center/index']);
        }
        $postInfo = Yii::$app->request->post();
        if (!empty($postInfo)) {
            if (is_numeric($postInfo['username'])) {
                $loginInfo = [
                    '_csrf' => $postInfo['_csrf'],
                    'LoginForm' => [
                        'mobile_phone' => $postInfo['username'],
                        'password' => $postInfo['password'],
                        'rememberMe' => $postInfo['rememberMe'],
                    ]
                ];
            } else {
                $loginInfo = [
                    '_csrf' => $postInfo['_csrf'],
                    'LoginForm' => [
                        'email' => $postInfo['username'],
                        'password' => $postInfo['password'],
                        'rememberMe' => $postInfo['rememberMe'],
                    ]
                ];
            }
            $model = new LoginForm();
            if ($model->load($loginInfo) && $model->login()) {
                $usersInfo = UsersInfo::findOne(['user_id' => Yii::$app->user->id]);
                if (empty($usersInfo)) {
                    $usersLevelInfo = UsersLevel::findOne(['user_id' => Yii::$app->user->id]);
                    return $this->redirect(['/user/register-info', 'train_id' => $usersLevelInfo['train_id']]);
                }
                $usersEducation = UsersEducation::findAll(['user_id' => Yii::$app->user->id]);
                if (empty($usersEducation)) {
                    $usersLevelInfo = UsersLevel::findOne(['user_id' => Yii::$app->user->id]);
                    return $this->redirect(['/user/register-education', 'train_id' => $usersLevelInfo['train_id']]);
                }

                return $this->redirect(['/user-center/index']);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));

            }
        }else {
            return $this->render('login');
        }

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/home/index');
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRegisterCoach()
    {

        if (Yii::$app->request->isPost) {
            $userId =  Yii::$app->user->id;

            $credentialsNumber = Yii::$app->request->post('credentials_number');
            $certificateNumber = Yii::$app->request->post('certificate_number');
            $result = UsersLevel::findOne(['user_id' => $userId, 'certificate_number' => $certificateNumber, 'credentials_number' => $credentialsNumber]);
            if (empty($result)) {
                throw new ServerErrorHttpException('系统错误,原因：没有您的注册信息，谢谢');
            } else {
                $levelOrder = Level::getOrderById($result['level_id']);
                if ($levelOrder != Yii::$app->user->identity->level_order) {
                    throw new ServerErrorHttpException('您没有当前级别的注册信息，谢谢');
                } else {
                    if ($result['status'] == 0) {
                        throw new ServerErrorHttpException('您还没有参加培训，谢谢');
                    } else {
                        UsersLevel::updateAll(['status' => 2, 'update_time' => date('Y-m-d H:i:s', time()), 'update_user' => Yii::$app->user->identity->username], ['user_id' => $userId, 'level_id' => $result['level_id']]);
                        return $this->redirect(['/user/register-coach-success']);

                    }
                }

            }

        } else {
            $userLevelInfo = [];
            $isRegister = Yii::$app->request->get('register');
            if ($isRegister) {
                $userLevelInfo = UsersLevel::findOne(['level_id' => Yii::$app->user->identity->level_id, 'user_id' => Yii::$app->user->id]);
            }
            $newReg = UsersLevel::getAllByCount(5);
            if (!empty($newReg)) {
                foreach($newReg as $key => $val) {
                    $newRegNews[$key]['title'] = Users::getOneUserNameById($val['user_id']) . "注册" . Level::getOneLevelNameById($val['level_id']+1) . "教练员";
                    $newRegNews[$key]['create_time'] = $val['create_time'];
                    $newRegNews[$key]['user_id'] = $val['user_id'];
                }
            }
            $regComment = Pages::getContentById(4);
            $data = [
                'newRegNews' => $newRegNews,
                'regComment' => $regComment,
                'userLevelInfo' => $userLevelInfo
            ];
            return $this->render('register-coach',[
                'data' => $data,
            ]);
        }
    }

    public function actionRegisterCoachSuccess()
    {
        $userName = Yii::$app->user->identity->username;
        $levelName = Level::getOneLevelNameById(Yii::$app->user->identity->level_id);
        $userLevelInfo = UsersLevel::findOne(['user_id' => Yii::$app->user->id, 'level_id' => Yii::$app->user->identity->level_id]);
        $newRegNews = News::getNewsByCategory(8, 5);
        $regComment = Pages::getContentById(4);
        $data = [
            'newRegNews' => $newRegNews,
            'regComment' => $regComment,
            'userName' => $userName,
            'levelName' => $levelName,
            'userLevelInfo' => $userLevelInfo
        ];
        return $this->render('register-coach-success',[
            'data' => $data,
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = Users::findOne($id);
        $modelInfo = UsersInfo::findOne(['user_id' => $id]);
        $modelUserLevel = UsersLevel::findOne(['user_id' => $model['id'],'level_id' => $model['level_id']]);
        $trainWind = News::getImgRecommendNewsByCategory(11, 12);
        return $this->render('view', [
            'data' => $modelInfo,
            'userModel' => $model,
            'trainWind' => $trainWind,
            'modelUserLevel' => $modelUserLevel
        ]);
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
            if (Users::isExist($phone)) {
                $msg = "已存在的电话号码！";
            } else {
                if ((strtotime($session['time']) + 60) < time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过期
                    session_destroy();
                    $session->remove('time');
                    $msg =  '验证码已过期，请重新获取！';
                } else {
                    $content = "尊敬的学员，您的注册验证码是".$checkNum.",此验证码于一分钟后过期，请尽快完成注册，谢谢！【教练系统】";
                    $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);

                    $result = $smsModel->pushMt($phone, time(), $content, 0);
                    if ($result == '0') {
                        $msg = '验证码已经发送到手机'.$phone . '，请注意查收。';
                    } else {
                        $msg = "系统错误请联系网站管理员，谢谢";
                    }
                }
            }
        } else {
            $msg =  '请输入手机号码！';
        }
        return $msg;
    }


    public function actionApply()
    {

        $trainId = Yii::$app->request->get('train_id');
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

            //检查用户参与的课程，状态不是取消，注册未完成，审核未通过，未通过的都算是已经参与了报名
            $isExist = TrainUsers::getUserIsExistTrainStatus($userId,$trainInfo['level_id']);
            if (!empty($isExist)) {
                throw new ServerErrorHttpException('您已经参与了该级别下的培训课程，请耐心等待培训结果，谢谢。');
            }
            //报名成功，给出用户的序号
            $trainUsersOrder = TrainUsers::getTrainUsersOrder($trainId);
            if (empty($trainUsersOrder)) {
                $trainUsersOrder = 1;
            } else {
                $trainUsersOrder=$trainUsersOrder+1;
            }
            $transaction = Yii::$app->db->beginTransaction();
            //如果用户未完成报名流程，更新状态为审核中
            $isSignExist = TrainUsers::getUserIsExistTrainStatusSign($userId,$trainInfo['level_id']);
            if (!empty($isSignExist)) {
                TrainUsers::updateAll(['status' => TrainUsers::APPROVED], ['id' => $isSignExist['id']]);
                $trainName = Train::getOneTrainNameById($isSignExist['train_id']);
                $data = [
                    'orders' => $isSignExist['orders'],
                    'trainName' => $trainName
                ];
                $transaction->commit();
                return $this->render('/user/apply-success', ['data' => $data]);
            } else { //如果没有记录，新增一条
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
                    $trainName = Train::getOneTrainNameById($model->train_id);
                    $data = [
                        'orders' => $model->orders,
                        'trainName' => $trainName
                    ];
                    $transaction->commit();
                    return $this->render('/user/apply-success', ['data' => $data]);

                } else {
                    throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                }
            }
        }
    }

    public function sendMessage($content,$type,$userId,$phone,$sendPhone = '')
    {
        $messagesUsersInfo['messages_id'] = 1;
        $messagesUsersInfo['type'] = $type;
        $messagesUsersInfo['title'] = Messages::$typeList[$type];
        $messagesUsersInfo['users_id'] = $userId;
        $messagesUsersInfo['content'] = $content;
        $messagesUsersInfo['create_time'] = date('Y-m-d H:i:s', time());
        $messagesUsersInfo['create_user'] = 'admin';
        $messagesUsersInfo['update_time'] = date('Y-m-d H:i:s', time());
        $messagesUsersInfo['update_user'] = 'admin';
        $result = MessagesUsers::addInfo($messagesUsersInfo);
        if ($sendPhone == 1) {
            $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);
            $result = $smsModel->pushMt($phone, time(), $content, 0);
        }

        return $result;
    }

}
