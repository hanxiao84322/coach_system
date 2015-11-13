<?php

namespace app\controllers\Admin;

use app\models\Level;
use app\models\Users;
use Yii;
use app\models\MessagesUsers;
use app\models\MessagesUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;

/**
 * MessagesUsersController implements the CRUD actions for MessagesUsers model.
 */
class MessagesUsersController extends Controller
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
     * Lists all MessagesUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessagesUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $param = Yii::$app->request->queryParams;
        $searchType = empty($param['MessagesUsersSearch']['type']) ? '1' : $param['MessagesUsersSearch']['type'];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchType' => $searchType
        ]);
    }

    /**
     * Displays a single MessagesUsers model.
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
     * Creates a new MessagesUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MessagesUsers();
        $type = Yii::$app->request->get('type');

        if (Yii::$app->request->isPost) {
            $param = Yii::$app->request->post();

            if ($param['user_type'] == 'user_name') {
                $userId = Users::getIdByName($param['MessagesUsers']['users_id']);
                if (empty($userId)) {
                    throw new ServerErrorHttpException('不存在的用户姓名！');
                }
                $model->messages_id = $param['MessagesUsers']['messages_id'];
                $model->type = $param['MessagesUsers']['type'];
                $model->users_id = $userId;
                $model->content = $param['MessagesUsers']['content'];
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);

                }
            } elseif ($param['user_type'] == 'user_level') {
                $levelId = Level::getIdByName($param['MessagesUsers']['users_id']);
                if (empty($levelId)) {
                    throw new ServerErrorHttpException('不存在的级别名称！');
                }
                $usersList = Users::findAll(['level_id' => $levelId, 'status' => 1]);
                if (!empty($usersList)) {
                    foreach ($usersList as $key => $val) {
                        $messagesUsersInfo['messages_id'] = $param['MessagesUsers']['messages_id'];
                        $messagesUsersInfo['type'] = $param['MessagesUsers']['type'];
                        $messagesUsersInfo['users_id'] = $val['id'];
                        $messagesUsersInfo['content'] = $param['MessagesUsers']['content'];
                        $messagesUsersInfo['create_time'] = date('Y-m-d H:i:s', time());
                        $messagesUsersInfo['create_user'] = 'admin';
                        $messagesUsersInfo['update_time'] = date('Y-m-d H:i:s', time());
                        $messagesUsersInfo['update_user'] = 'admin';
                        MessagesUsers::addInfo($messagesUsersInfo);
                    }
                    return $this->redirect('index');
                }
            } elseif ($param['user_type'] == 'all_user') {
                $usersList = Users::getAll();
                if (!empty($usersList)) {
                    foreach ($usersList as $key => $val) {
                        $messagesUsersInfo['messages_id'] = $param['MessagesUsers']['messages_id'];
                        $messagesUsersInfo['type'] = $param['MessagesUsers']['type'];
                        $messagesUsersInfo['users_id'] = $val['id'];
                        $messagesUsersInfo['content'] = $param['MessagesUsers']['content'];
                        $messagesUsersInfo['create_time'] = date('Y-m-d H:i:s', time());
                        $messagesUsersInfo['create_user'] = admin;
                        $messagesUsersInfo['update_time'] = date('Y-m-d H:i:s', time());
                        $messagesUsersInfo['update_user'] = 'admin';
                        MessagesUsers::addInfo($messagesUsersInfo);
                        return $this->redirect('index');
                    }
                }
            } else {
                throw new ServerErrorHttpException('参数错误！');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'type' => empty($type) ? '1' : $type
            ]);
        }
    }

    /**
     * Updates an existing MessagesUsers model.
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
     * Deletes an existing MessagesUsers model.
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
     * Finds the MessagesUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MessagesUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MessagesUsers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionDel()
    {
        $idList = Yii::$app->request->post('selection');
        $type = Yii::$app->request->get('type');
        if (!empty($idList)) {
            foreach($idList as $key => $val) {
                $this->findModel($val)->delete();
            }
        }
        return $this->redirect(['index','MessagesUsersSearch[type]' => $type]);
    }
}
