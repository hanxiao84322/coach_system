<?php

namespace app\controllers;

use app\models\News;
use app\models\Pages;
use app\models\Train;
use app\models\TrainUsers;
use app\models\Users;
use yii\web\User;

class HomeController extends \yii\web\Controller
{
    public $layout = 'index';

    public function actionIndex()
    {

        $userCount = Users::getAllCount();
        $oneNewsPic = News::getOnePicIndexNewsByCategory(2);
        $newsA = News::getIndexNewsByCategory(2,6);
        $newsB = News::getIndexNewsByCategory(5,12);
        $newsC = News::getIndexNewsByCategory(7,5);
        $newsF = News::getOnePicIndexNewsByCategory(2);
        $newsRegister = TrainUsers::getAllByCount(5);
        $newContent = Pages::findOne(9);
        if (!empty($newsRegister)) {
            foreach($newsRegister as $key => $val) {
                $newsD[$key]['title'] = Users::getOneUserNameById($val['user_id']) . "报名" . Train::getOneTrainNameById($val['train_id']) . "已被录取";
                $newsD[$key]['create_time'] = $val['create_time'];
                $newsD[$key]['user_id'] = $val['user_id'];
            }
        }
        $newsE = News::getIndexNewsByCategory(6,5);

        $data = [
            'userCount' => $userCount,
            'oneNewsPic' => $oneNewsPic,
            'newsA' => $newsA,
            'newsB' => $newsB,
            'newsC' => $newsC,
            'newsD' => $newsD,
            'newsE' => $newsE,
            'newsF' => $newsF,
            'newsRegister' => $newContent
        ];
        return $this->render('index', ['data' => $data]);
    }

}
