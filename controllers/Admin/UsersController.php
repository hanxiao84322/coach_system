<?php

namespace app\controllers\Admin;

use app\models\UsersEducation;
use app\models\UsersInfo;
use app\models\UsersPlayers;
use app\models\UsersTrain;
use app\models\UsersVocational;
use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelInfo = UsersInfo::findOne(['user_id' => $id]);
        $modelEducation = UsersEducation::findAll(['user_id' => $id]);
        $modelTrain = UsersTrain::findAll(['user_id' => $id]);
        $modelVocational = UsersVocational::findAll(['user_id' => $id]);
        $modelPlayers = UsersPlayers::findAll(['user_id' => $id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelInfo' => $modelInfo,
            'modelEducation' => $modelEducation,
            'modelTrain' => $modelTrain,
            'modelVocational' => $modelVocational,
            'modelPlayers' => $modelPlayers,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        if (Yii::$app->request->isPost) {

            $postInfo = Yii::$app->request->post();
            if (!empty($postInfo)) {
                $postInfo['Users']['password'] = md5('111111');
                if ($model->load($postInfo) && $model->save()) {
                    $userInfo = [
                        'name' => $model->username,
                        'name' => $model->name,
                        'name' => $model->name,

                    ];
                    UsersInfo::addInfo();
                    Yii::$app->getSession()->setFlash('success', '添加成功！');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new ServerErrorHttpException('添加用户失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                    return $this->redirect(['create']);
                }
            }
        }  else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $postInfo = Yii::$app->request->post();

            if ($model->load($postInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
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

    public function actionStop()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('stop', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDel()
    {
        $idList = Yii::$app->request->post('selection');
        if (!empty($idList)) {
            foreach($idList as $key => $val) {
                $this->findModel($val)->delete();
            }
        }
        return $this->redirect(['index']);
    }

    public function actionChangePassword()
    {
        $userId = Yii::$app->request->get('user_id');

        Users::updateAll(['password' => md5(111111)],['id' => $userId]);
        header("Content-type:text/html;charset=utf-8");
        echo "<script language='javascript'>alert('该用户密码已经成功修改为111111');location.href='/Admin/users/index';</script>";
    }
}
