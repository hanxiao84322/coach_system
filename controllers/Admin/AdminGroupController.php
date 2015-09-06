<?php

namespace app\controllers\Admin;

use Yii;
use app\models\AdminGroup;
use app\models\AdminGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;


/**
 * AdminGroupController implements the CRUD actions for AdminGroup model.
 */
class AdmingroupController extends Controller
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
     * Lists all AdminGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminGroup model.
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
     * Creates a new AdminGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminGroup();
        $postInfo = Yii::$app->request->post();
        if (!empty($postInfo['AdminGroup']['model'])){
            $postInfo['AdminGroup']['model'] = implode(',',$postInfo['AdminGroup']['model']);
        }
        if (!empty($postInfo)) {
            if ($model->load($postInfo) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', '添加成功！');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('添加权限组失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->modelList = explode(',', $model->model);
        $postInfo = Yii::$app->request->post();
        if (!empty($postInfo['AdminGroup']['model'])){
            $postInfo['AdminGroup']['model'] = implode(',',$postInfo['AdminGroup']['model']);
        }
        if (!empty($postInfo)) {
            if ($model->load($postInfo) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', '添加成功！');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('更新权限组失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                return $this->redirect(['update']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminGroup model.
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
     * Finds the AdminGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
