<?php

namespace app\controllers;
use Yii;
use app\models\UsersLevel;
use yii\web\ServerErrorHttpException;


class SearchCertificateNumberController extends \yii\web\Controller
{
    public $layout = 'none';

    public function actionIndex()
    {

        if (Yii::$app->request->isPost) {
            $certificateNumber = Yii::$app->request->post('certificate_number');
            $credentialsNumber = Yii::$app->request->post('credentials_number');

            $result = UsersLevel::findOne(['certificate_number' => $certificateNumber, 'credentials_number'=> $credentialsNumber]);
            if (empty($result)) {
                throw new ServerErrorHttpException('不存在的证书！');
            } else {
                return $this->render('view', [
                    'data' => $result
                ]);
            }

        } else {
            return $this->render('index');
        }
    }

    public function actionView()
    {
        $result = UsersLevel::findOne(['user_id' => Yii::$app->user->id, 'level_id' => Yii::$app->user->identity->level_id]);

        return $this->render('view', [
            'data' => $result
        ]);
    }

}
