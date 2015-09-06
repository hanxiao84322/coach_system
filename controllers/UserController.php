<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\web\ServerErrorHttpException;
use app\models\LoginForm;


class UserController extends \yii\web\Controller
{
    public $layout = 'user';

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionRegister()
    {

        return $this->render('register');
    }

    public function actionRegisterPost()
    {
        $usersModel = new Users();
        $email =  \Yii::$app->request->post('email');
        $password =  \Yii::$app->request->post('password');
        $password_repeat =  \Yii::$app->request->post('password_repeat');
        $is_agree =  \Yii::$app->request->post('is_agree');

        if (empty($email) || empty($password) || empty($password_repeat) || empty($is_agree)) {
            throw new ServerErrorHttpException('缺少参数！');
        }

        $registerInfo = [
            'Users' => [
                'email' => $email,
                'password' => $password,
                'height' => '0',
                'weight' => '0'
            ]
        ];
        if ($usersModel->load($registerInfo) && $usersModel->save()) {
            return $this->redirect(['/user/register-info', 'id' => $usersModel->id]);
        } else {
            throw new ServerErrorHttpException('系统错误,原因：' . json_encode($usersModel->errors, JSON_UNESCAPED_UNICODE));
        }

    }

    public function actionRegisterInfo()
    {
        $userId =  \Yii::$app->request->get('id');

        $model = $this->findModel($userId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/user/register-education', 'id' => $model->id]);
        } else {
            return $this->render('registerInfo',[
            'model' => $model,
            ]);
        }
    }

    public function actionRegisterEducation()
    {

    }

    public function actionLogin()
    {
        if (!\Yii::$app->admin->isGuest) {
            return $this->redirect(['/user-center/index']);
        }
        $postInfo = Yii::$app->request->post();
        if (!empty($postInfo)) {
            if (is_numeric($postInfo['username'])) {
                $loginInfo = [
                    '_csrf' => $postInfo['_csrf'],
                    'LoginForm' => [
                        'mobile_phone' => $postInfo['username'],
                        'password' => $postInfo['password'],
                        'rememberMe' => $postInfo['rememberMe'],
                    ]
                ];
            } else {
                $loginInfo = [
                    '_csrf' => $postInfo['_csrf'],
                    'LoginForm' => [
                        'email' => $postInfo['username'],
                        'password' => $postInfo['password'],
                        'rememberMe' => $postInfo['rememberMe'],
                    ]
                ];
            }
            $model = new LoginForm();
            if ($model->load($loginInfo) && $model->login()) {
                return $this->redirect(['/user-center/index']);
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));

            }
        }else {
            return $this->render('login');
        }

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/home/index');
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
}
