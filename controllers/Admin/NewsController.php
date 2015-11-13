<?php

namespace app\controllers\Admin;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\ServerErrorHttpException;


/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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

    public function actions()
    {
        return [
            'Kupload' => [
                'class' => 'pjkui\kindeditor\KindEditorAction',
            ]
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        if (Yii::$app->request->isPost) {
            $model->thumb = UploadedFile::getInstance($model, 'thumb');
            if (!empty($model->thumb)) {
                $fileName = time().  '.' .$model->thumb->extension;
                $model->thumb->saveAs('upload/images/news/thumb/' . $fileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                }
            } else {
                $fileName = '';
            }
            $newsInfo = Yii::$app->request->post();
            $newsInfo['News']['status'] = 1;
            $newsInfo['News']['thumb'] = $fileName;
            if (!empty($fileName)) {
                $newsInfo['News']['is_pic'] = 1;
            }
            if ($model->load($newsInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('添加新闻失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {

            $newsInfo = Yii::$app->request->post();

            $model->thumb = UploadedFile::getInstance($model, 'thumb');

            if (!empty($model->thumb)) {
                $fileName = time().  '.' .$model->thumb->extension;
                $model->thumb->saveAs('upload/images/news/thumb/' . $fileName, true);

                if ($model->hasErrors('file')){
                    throw new ServerErrorHttpException($model->getErrors('file'));
                } else {
                    $newsInfo['News']['thumb'] = $fileName;
                }
            } else {
                $newsInfo['News']['thumb'] = Yii::$app->request->post('old_thumb');

            }
            if (!empty($newsInfo['News']['thumb'])) {
                $newsInfo['News']['is_pic'] = 1;
            }
            if ($model->load($newsInfo) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new ServerErrorHttpException('添加新闻失败，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
