<?php

namespace app\controllers;

use app\models\Level;
use app\models\News;
use app\models\Pages;
use app\models\Sms;
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
    public $layout = 'main';

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
        return $this->render('index',[
            'data' => $data
        ]);
    }

    public function actionRegister()
    {
        $type = Yii::$app->request->get('type');
        $trainId = Yii::$app->request->get('train_id');
        $session = Yii::$app->session;
        if (Yii::$app->request->isPost) {
            $registerParams = Yii::$app->request->post();
            $trainId = Yii::$app->request->post('train_id');
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
                        'score' => 60,
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
                        'score' => 60,
                        'level_id' => 1,
                        'level_order' => 1,
                    ]
                ];
            }
            $transaction = Yii::$app->db->beginTransaction();

            if ($usersModel->load($registerInfo) && $usersModel->save()) {
                //新增一条用户和级别对应的信息
                $userLevelModel = new UsersLevel();
                $userLevelModel->user_id = $usersModel->id;
                $userLevelModel->train_id = $trainId;
                $userLevelModel->level_id = 2;
                $userLevelModel->credentials_number = '';
                if (!$userLevelModel->save()) {
                    $transaction->rollBack();
                    throw new ServerErrorHttpException('更新状态错误，原因：' . json_encode($userLevelModel->errors, JSON_UNESCAPED_UNICODE) . '！');
                } else {
                    $transaction->commit();
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
            return $this->render('register', ['type' => $type, 'train_id' => $trainId]);
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
                Users::updateAll(['username'=>$infoInfo['UsersInfo']['name'],'district' => $infoParams['UsersInfo']['district'], 'status' => 1, 'email' => $infoParams['UsersInfo']['email'], 'phone_auth' => 1],['id' => $userId]);
                //更新级别信息的信息
                $result = UsersLevel::updateAll(['credentials_number' => $modelInfo['credentials_number']], ['user_id' => $userId]);
                if (!$result) {
                    $transaction->rollBack();
                    throw new ServerErrorHttpException('更新信息错误！');
                } else {
                    $transaction->commit();
                }
                return $this->redirect(['/user/register-education','train_id' => $trainId]);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($modelInfo->errors, JSON_UNESCAPED_UNICODE));
            }
        }else {
            $model = UsersInfo::findOne(['user_id'=>Yii::$app->user->id]);
            $trainId = Yii::$app->request->get('train_id');
            $userModel = Users::findOne(Yii::$app->user->id);
            return $this->render('register-info',[
                'model' => $model,
                'userModel' => $userModel,
                'train_id' => $trainId
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
        }else {
            $userId = Yii::$app->user->id;
            $trainId = Yii::$app->request->get('train_id');
            $model = UsersEducation::findAll(['user_id' => $userId]);
            return $this->render('register-education',[
                'model' => $model,
                'train_id' => $trainId,
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
        }else {
            $userId = Yii::$app->user->id;

            $model = UsersTrain::findAll(['user_id' => $userId]);
            $trainId = Yii::$app->request->get('train_id');
            return $this->render('register-train',[
                'model' => $model,
                'train_id' => $trainId
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
        }else {
            $userId = Yii::$app->user->id;

            $model = UsersVocational::findAll(['user_id' => $userId]);
            $trainId = Yii::$app->request->get('train_id');
            return $this->render('register-vocational',[
                'model' => $model,
                'train_id' => $trainId
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
        }else {
            $userId = Yii::$app->user->id;

            $model = UsersPlayers::findAll(['user_id' => $userId]);
            $trainId = Yii::$app->request->get('train_id');
            return $this->render('register-players',[
                'model' => $model,
                'train_id' => $trainId
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
                $usersInfo = UsersInfo::findAll(['user_id' => Yii::$app->user->id]);
                if (empty($usersInfo)) {
                    return $this->redirect(['/user-center/user-info']);
                }
                $usersEducation = UsersEducation::findAll(['user_id' => Yii::$app->user->id]);
                if (empty($usersEducation)) {
                    return $this->redirect(['/user-center/user-education']);
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
            $newRegNews = News::getNewsByCategory(8, 5);
            $regComment = Pages::getContentById(4);
            $data = [
                'newRegNews' => $newRegNews,
                'regComment' => $regComment
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
        $modelUserLevel = UsersLevel::findOne(['user_id' => $model->id,'level_id' => $model->level_id]);
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
            if ((strtotime($session['time']) + 60) < time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过期
                session_destroy();
                $session->remove('time');
                $msg =  '验证码已过期，请重新获取！';
            } else {
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
}
