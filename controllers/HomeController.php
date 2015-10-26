<?php

namespace app\controllers;

use app\models\News;
use app\models\Users;
use yii\web\User;

class HomeController extends \yii\web\Controller
{
    public $layout = 'index';

    public function actionIndex()
    {

        $userCount = Users::getAllCount();
        $newsA = News::getIndexNewsByCategory(2,5);
        $newsB = News::getIndexNewsByCategory(5,12);
        $newsC = News::getIndexNewsByCategory(7,5);
        $newsRegister = Users::getAllByCount();
        if (!empty($newsRegister)) {
            foreach($newsRegister as $key => $val) {
                $newsD[$key]['title'] = $val['username'] . "成功注册";
                $newsD[$key]['create_time'] = $val['create_time'];
                $newsD[$key]['id'] = $val['id'];
            }
        }
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
