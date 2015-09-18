<?php

namespace app\controllers;

use app\models\Pages;
use app\models\Users;

class PagesController extends \yii\web\Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        $id = \Yii::$app->request->get('id');
        $pageInfo = Pages::findOne($id);
        $userCount = Users::getAllCount();

        return $this->render('view',['pageInfo' => $pageInfo, 'userCount' => $userCount]);

    }

}
