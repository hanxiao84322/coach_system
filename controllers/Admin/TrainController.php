<?php

namespace app\controllers\Admin;

use app\models\Attendance;
use app\models\TrainUsers;
use Yii;
use app\models\Train;
use app\models\TrainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * TrainController implements the CRUD actions for Train model.
 */
class TrainController extends Controller
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
     * Lists all Train models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Train model.
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
     * Creates a new Train model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Train();
        if (Yii::$app->request->isPost) {
            $postInfo = Yii::$app->request->post();
            if (strtotime($postInfo['Train']['end_time']) <= strtotime($postInfo['Train']['begin_time'])) {
                throw new ServerErrorHttpException('更新状态失败，原因：开始时间不能大于结束时间！');
            }
            if (strtotime($postInfo['Train']['sign_up_end_time']) <= strtotime($postInfo['Train']['sign_up_begin_time'])) {
                throw new ServerErrorHttpException('更新状态失败，原因：注册开始时间不能大于注册结束时间！');
            }
            if (strtotime($postInfo['Train']['begin_time']) <= strtotime($postInfo['Train']['sign_up_end_time'])) {
                throw new ServerErrorHttpException('更新状态失败，原因：注册结束时间不能大于开始时间！');
            }
            $postInfo['Train']['code'] = date('Ymd', time());
            if ($model->load($postInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('更新状态失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Train model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $transaction = Yii::$app->db->beginTransaction();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //课程开始
                if ($model->status == Train::DOING) {
                    //获取该课程下已录取的学员
                    $trainUsers = TrainUsers::getApprovedTrainUsersByTrainId($model->id);
                    if (!empty($trainUsers)) {
                        if ($model->sign_up_status != Train::END_SIGN_UP) {
                            throw new ServerErrorHttpException('更新状态失败，原因：该培训课程的报名状态不为' . Train::$signUpStatusList[Train::END_SIGN_UP] . '！');
                        }
                        //根据课程id，用户id更新用户状态为正在进行
                        TrainUsers::updateTrainUsersStatusByTrainId(TrainUsers::DOING, $model->id);
                        foreach ($trainUsers as $key => $val) {

                            //创建考勤信息
                            for ($i = strtotime($model->begin_time); $i < strtotime($model->end_time); $i += 86400) {
                                $day = date('Y-m-d H:i:s', $i);
                                $isExist = Attendance::findOne(['train_id' => $model->id, 'user_id' => $val['user_id'], 'day' => $day]);
                                if (empty($isExist)) {
                                    $attendance = [
                                        'train_id' => $model->id,
                                        'user_id' => $val['user_id'],
                                        'day' => $day,
                                    ];
                                    Attendance::add($attendance);
                                }
                            }
                        }
                    } else {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('更新状态失败，原因：该培训课程下没有学员！');
                    }
                }
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Train model.
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
     * Finds the Train model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Train the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Train::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
