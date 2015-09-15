<?php

namespace app\controllers;

use app\models\News;
use app\models\Users;
use yii\web\User;

class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $userCount = Users::getAllCount();
        $newsA = News::getIndexNewsByCategory(2,5);
        $newsB = News::getIndexNewsByCategory(5,12);
        $newsC = News::getIndexNewsByCategory(7,5);
        $newsD = News::getIndexNewsByCategory(8,5);
        $newsE = News::getIndexNewsByCategory(6,5);


        $data = [
            'userCount' => $userCount,
            'newsA' => $newsA,
            'newsB' => $newsB,
            'newsC' => $newsC,
            'newsD' => $newsD,
            'newsE' => $newsE,

        ];
        return $this->render('index', ['data' => $data]);
    }

}
