<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;
use app\models\Sms;


class FindPasswordController extends Controller
{
    public $layout = 'none';

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionIndex()
    {
        $step = Yii::$app->request->get('step');
        $userId = Yii::$app->request->get('user_id');

        if (empty($step)) {
            $step = 1;
        }
        $users = Users::findOne($userId);
        $username = $users['username'];
        $phone = $users['mobile_phone'];
        $phoneHidden = substr_replace($phone, '****', 4, 4);

        if (Yii::$app->request->isPost) {
            if ($step == 1) {
                $username = Yii::$app->request->post('username');
                if (is_numeric($username)) {
                    $where = ['mobile_phone' => $username];
                } else {
                    $where = ['email' => $username];
                }
                $verifyCode = Yii::$app->request->post('verifyCode');
                if (empty($verifyCode)) {
                    throw new ServerErrorHttpException('请输入验证码！');
                }
                if (!empty($_SESSION['__captcha/site/captcha'])) {
                    if ($_SESSION['__captcha/site/captcha'] != $verifyCode) {
                        throw new ServerErrorHttpException('验证码输入错误，请重新输入！');
                    }
                } else {

                }
                $userInfo = Users::findOne($where);

                if (empty($userInfo)) {
                    throw new ServerErrorHttpException('不存在的用户！');
                }
                return $this->redirect(['/find-password/index', 'step' => 2, 'user_id' => $userInfo['id']]);
            } elseif($step == 2) {

                $checkNum = Yii::$app->request->post('check_num');
                $session = Yii::$app->session;

                if ($checkNum != $session['checkNum']) {
                    throw new ServerErrorHttpException('短信验证码输入错误，请重新输入！');
                } else {
                    return $this->redirect(['/find-password/index', 'step' => 3, 'user_id' => $userId]);
                }
            } elseif($step == 3) {

                $username = Yii::$app->request->post('username');
                $password = Yii::$app->request->post('password');
                $password_confirm = Yii::$app->request->post('password_confirm');
                if ($password != $password_confirm) {
                    throw new ServerErrorHttpException('两次输入密码不一致，请重新输入！');
                }
                $password = md5($password);
                $result = Users::updateAll(['password' => $password, 'username' => $username], ['id' => $userId]);
                if (!$result) {
                    throw new ServerErrorHttpException('更新密码错误！');
                }
                return $this->redirect(['/find-password/index', 'step' => 4]);
            } else {
                $success = 'true';
            }
        }

        $data = [
            'users' => $users,
            'step' => $step,
            'phoneHidden' => $phoneHidden,
            'phone' => $phone,
            'username' => $username
        ];
        return $this->render('index', ['data' => $data]);
    }

    public function actionGetCheckNum()
    {
        $phone = Yii::$app->request->get('phone');
        $checkNum = rand(100000,999999);
        $session = Yii::$app->session;

        if (!isset($session['time']))//判断缓存时间
        {
            $session['time'] = date("Y-m-d H:i:s");
        }
        $session['checkNum'] = $checkNum;//将content的值保存在session中
        if (!empty($phone)) {
            if ((strtotime($session['time']) + 60) < time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过期
                session_destroy();
                $session->remove('time');
                $msg =  '验证码已过期，请重新获取！';
            } else {
                $content = "尊敬的学员，您的验证码是".$checkNum.",此验证码于一分钟后过期，谢谢！【教练系统】";
                $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);

                $result = $smsModel->pushMt($phone, time(), $content, 0);
                if ($result == '0') {
                    $msg = '验证码已经发送到手机'.$phone . '，请注意查收。';
                } else {
                    $msg = $result;
                }
            }
        } else {
            $msg =  '发送失败，请再次尝试！';
        }
        return $msg;
    }

}

