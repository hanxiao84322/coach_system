<?php

namespace app\controllers\Admin;

use Yii;
use app\models\ActivityProcess;
use app\models\ActivityUsers;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
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
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
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
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();

        if (Yii::$app->request->isPost) {
            $postInfo = Yii::$app->request->post();
            if (strtotime($postInfo['Activity']['end_time']) <= strtotime($postInfo['Activity']['begin_time'])) {
                throw new ServerErrorHttpException('更新状态失败，原因：开始时间不能大于结束时间！');
            }
            if (strtotime($postInfo['Activity']['sign_up_end_time']) <= strtotime($postInfo['Activity']['sign_up_begin_time'])) {
                throw new ServerErrorHttpException('更新状态失败，原因：注册开始时间不能大于注册结束时间！');
            }
            if (strtotime($postInfo['Activity']['begin_time']) <= strtotime($postInfo['Activity']['sign_up_end_time'])) {
                throw new ServerErrorHttpException('更新状态失败，原因：注册结束时间不能大于开始时间！');
            }
            $postInfo['Activity']['code'] = date('Ymd', time());
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
     * Updates an existing Activity model.
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
                if ($model->status == Activity::DOING) {
                    //获取该课程下已录取的学员
                    $ActivityUsers = ActivityUsers::getApprovedActivityUsersByActivityId($model->id);
                    if (!empty($ActivityUsers)) {
                        //根据课程id，用户id更新用户状态为正在进行
                        ActivityUsers::updateActivityUsersStatusByActivityId(ActivityUsers::DOING, $model->id);
                        foreach ($ActivityUsers as $key => $val) {

                            //创建考勤信息
                            for ($i = strtotime($model->begin_time); $i < strtotime($model->end_time); $i += 86400) {
                                $day = date('Y-m-d H:i:s', $i);
                                $isExist = ActivityProcess::findOne(['activity_id' => $model->id, 'user_id' => $val['user_id'], 'day' => $day]);
                                if (empty($isExist)) {
                                    $attendance = [
                                        'activity_id' => $model->id,
                                        'user_id' => $val['user_id'],
                                        'day' => $day,
                                    ];
                                    ActivityProcess::add($attendance);
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
     * Deletes an existing Activity model.
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
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
