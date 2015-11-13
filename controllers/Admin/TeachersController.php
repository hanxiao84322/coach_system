<?php

namespace app\controllers\Admin;

use Yii;
use app\models\Teachers;
use app\models\TeachersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;



/**
 * TeachersController implements the CRUD actions for Teachers model.
 */
class TeachersController extends Controller
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
     * Lists all Teachers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teachers model.
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
     * Creates a new Teachers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teachers();
        if (Yii::$app->request->isPost) {
            $teachersInfo = Yii::$app->request->post();
            if ($model->findOne(['name' => $teachersInfo['Teachers']['name']])) {
                throw new ServerErrorHttpException('已经存在的讲师姓名！');
            }
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if (!empty($model->photo)) {
                $fileName = time() . '.' . $model->photo->extension;
                $model->photo->saveAs('upload/images/teachers/photo/' . $fileName, true);

                if ($model->hasErrors('file')) {
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $teachersInfo['Teachers']['photo'] = $fileName;
                }
            } else {
                throw new ServerErrorHttpException('请上传头像！');
            }

            if ($model->load($teachersInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teachers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {

            $teacherInfo = Yii::$app->request->post();

            $model->photo = UploadedFile::getInstance($model, 'photo');
            if (!empty($model->photo)) {
                $fileName = time().  '.' .$model->photo->extension;
                $model->photo->saveAs('upload/images/teachers/photo/' . $fileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $teacherInfo['Teachers']['photo'] = $fileName;
                }
            } else {
                $teacher = Teachers::findOne($id);
                $teacherInfo['Teachers']['photo'] = $teacher->photo;
            }
            if ($model->load($teacherInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('添加讲师失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teachers model.
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
     * Finds the Teachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teachers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStop()
    {
        $searchModel = new TeachersSearch();
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
}
