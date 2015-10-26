<?php

namespace app\controllers\Admin;

use Yii;
use app\models\UsersLevel;
use app\models\UsersLevelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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

            $model->credentials_photo = UploadedFile::getInstance($model, 'credentials_photo');
            if (!empty($model->credentials_photo)) {
                if (!in_array($model->credentials_photo->extension, ['jpg', 'gif'])) {
                    throw new ServerErrorHttpException('不允许的格式');
                }
                $photoFileName = time().  '.' .$model->credentials_photo->extension;
                $model->credentials_photo->saveAs('upload/images/users_level/credentials_photo/' . $photoFileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $infoParams['UsersLevel']['credentials_photo'] = $photoFileName;

                }
            }
            $userLevelInfo = $infoParams;

            if ($model->load($userLevelInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
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
}
