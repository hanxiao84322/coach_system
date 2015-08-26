<?php

namespace app\controllers\Admin;

use app\models\AdminLoginForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'admin',
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->render('index');
        } else {
            return $this->redirect(['Admin/site/login']);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->admin->isGuest) {
            return $this->redirect(['Admin/site/index']);
        }
        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->adminLogin()) {
            return $this->redirect(['Admin/site/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->redirect(['Admin/site/login']);
    }
}
