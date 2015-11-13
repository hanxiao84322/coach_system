<?php

namespace app\controllers\Admin;

use Yii;
use app\models\TrainLand;
use app\models\TrainLandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TrainLandController implements the CRUD actions for TrainLand model.
 */
class TrainLandController extends Controller
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
     * Lists all TrainLand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainLandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrainLand model.
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
     * Creates a new TrainLand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrainLand();
        if (Yii::$app->request->isPost) {
            $model->thumb = UploadedFile::getInstance($model, 'thumb');
            if (!empty($model->thumb)) {
                $fileName = time().  '.' .$model->thumb->extension;
                $model->thumb->saveAs('upload/images/train_land/thumb/' . $fileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                }
            } else {
                $fileName = '';
            }
            $trainLandInfo = Yii::$app->request->post();
            $trainLandInfo['TrainLand']['thumb'] = $fileName;
            if ($model->load($trainLandInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('添加培训地失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrainLand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $trainLandInfo = Yii::$app->request->post();

            $model->thumb = UploadedFile::getInstance($model, 'thumb');
            if (!empty($model->thumb)) {
                $fileName = time().  '.' .$model->thumb->extension;
                $model->thumb->saveAs('upload/images/train_land/thumb/' . $fileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $trainLandInfo['TrainLand']['thumb'] = $fileName;
                }
            } else {
                $trainLandInfo['TrainLand']['thumb'] = Yii::$app->request->post('old_thumb');

            }

            if ($model->load($trainLandInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TrainLand model.
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
     * Finds the TrainLand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainLand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainLand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
