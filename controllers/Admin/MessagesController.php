<?php

namespace app\controllers\Admin;

use app\models\MessagesUsers;
use app\models\Users;
use Yii;
use app\models\Messages;
use app\models\MessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class MessagesController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Messages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Messages model.
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
     * Creates a new Messages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Messages();
        if (Yii::$app->request->isPost) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($model->load(Yii::$app->request->post())) {
                $result = $model->save();
                if ($result) {
                    $users = Users::getAllId();
                    if (!empty($users)) {
                        foreach($users as $key => $val) {
                            $messagesUsersModel = new MessagesUsers();
                            $messagesUsersModel->messages_id = $model->primaryKey;
                            $messagesUsersModel->users_id = $val['id'];
                            $messagesUsersModel->status = 0;
                            if (!$messagesUsersModel->save()){
                                $transaction->rollBack();
                                throw new ServerErrorHttpException('添加站内消息失败，原因：' . json_encode($messagesUsersModel->errors, JSON_UNESCAPED_UNICODE));
                            }
                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                    throw new ServerErrorHttpException('添加站内消息失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                }
            } else {
                $transaction->rollBack();
                throw new ServerErrorHttpException('添加站内消息失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Messages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Messages model.
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
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
