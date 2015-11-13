<?php

namespace app\controllers\Admin;

use app\models\Level;
use app\models\Messages;
use app\models\MessagesUsers;
use app\models\Sms;
use app\models\Teachers;
use app\models\Train;
use app\models\TrainLand;
use app\models\TrainTeachers;
use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersTrain;
use Yii;
use app\models\UsersLevel;
use app\models\UsersLevelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * UsersLevelController implements the CRUD actions for UsersLevel model.
 */
class UsersLevelController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'admin',
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all UsersLevel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersLevel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UsersLevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersLevel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UsersLevel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $infoParams = Yii::$app->request->post();
            if ($infoParams['UsersLevel']['status'] == UsersLevel::SEND_CARD) {
                $infoParams['UsersLevel']['end_date'] = date('Y-m-d',time() + (3600 * 24 * 365));
            }
            $userLevelInfo = $infoParams;

            if ($model->load($userLevelInfo) && $model->save()) {

                //如果状态更新为已经注册
                if ($model->status == UsersLevel::SEND_CARD) {
                    if ($model->level_id == 1) { //如果是注册学员升级市级教练
                        UsersLevel::updateAll(['status' => UsersLevel::LEVEL_UP], ['user_id' => $model->user_id, 'level_id' => $model->level_id]);
                        $userInfo = UsersInfo::findOne(['user_id' => $model->user_id]);
                        //新增一条用户和级别对应的信息
                        $userLevelModel = new UsersLevel();
                        $userLevelModel->user_id = $model->user_id;
                        $userLevelModel->level_id = $model->level_id + 1;
                        $userLevelModel->credentials_number = $userInfo['credentials_number'];
                        $userLevelModel->district = $userInfo['account_location'];
                        $userLevelModel->receive_address = $userInfo['contact_address'];
                        $userLevelModel->postcode = $userInfo['contact_postcode'];
                        $userLevelModel->status = UsersLevel::NO_TRAIN;
                        if (!$userLevelModel->save()) {
                            throw new ServerErrorHttpException(json_encode($userLevelModel->errors, JSON_UNESCAPED_UNICODE) . '！');
                        } else {
                            Users::updateAll(['level_id' => $model->level_id + 1, 'level_order' => $model->level_id + 1], ['id' => $model->user_id]);
                        }
                    }

                    $usersTrainInfo = UsersLevel::getUserTrainInfo($model->id);
                    $teacherInfo = Teachers::findOne($usersTrainInfo['teachers_id']);
                    $usersTrainModel = new UsersTrain();
                    $usersTrain['UsersTrain']['user_id'] = $usersTrainInfo['user_id'];
                    $usersTrain['UsersTrain']['credentials_number'] = $usersTrainInfo['certificate_number'];
                    $usersTrain['UsersTrain']['begin_time'] = $usersTrainInfo['begin_time'];
                    $usersTrain['UsersTrain']['end_time'] = $usersTrainInfo['end_time'];
                    $usersTrain['UsersTrain']['level'] = Level::getOneLevelNameById($usersTrainInfo['level_id']);
                    $usersTrain['UsersTrain']['address'] = $usersTrainInfo['address'];
                    $usersTrain['UsersTrain']['witness'] = $teacherInfo['name'];
                    $usersTrain['UsersTrain']['witness_phone'] = $teacherInfo['phone'];
                    $usersTrain['UsersTrain']['description'] = '通过培训课程'.$usersTrainInfo['content'];
                    if ($usersTrainModel->load($usersTrain) && $usersTrainModel->save()) {
                        $content = "很高兴的通知您，您已完成" . Level::getOneLevelNameById($model->level_id) . "级教练员的注册，注册时效为1年，您现在可以正式开展教练员工作。【教练系统】";
                        $userInfo = Users::findOne($model->user_id);
                        $result = $this->sendMessage($content,Messages::REGISTER_SUCCESS,$model->user_id,$userInfo['mobile_phone'],'1');
                        if ($result != '0') {
                            throw new ServerErrorHttpException($result);
                        } else {
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } else {
                        throw new ServerErrorHttpException(json_encode($usersTrainModel->errors, JSON_UNESCAPED_UNICODE));
                    }
                }
            }
        } else {
            $photo = UsersInfo::getPhotoByUserId($model->user_id);
            return $this->render('update', [
                'model' => $model,
                'photo' => $photo
            ]);
        }
    }

    /**
     * Deletes an existing UsersLevel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsersLevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersLevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersLevel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCertificateNumber()
    {
        $searchModel = new UsersLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('certificate-number', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function sendMessage($content,$type,$userId,$phone)
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
        MessagesUsers::addInfo($messagesUsersInfo);
        $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);
        $result = $smsModel->pushMt($phone, time(), $content, 0);

        return $result;
    }

}
