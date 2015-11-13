<?php

namespace app\controllers;

use app\models\Level;
use app\models\Train;
use app\models\UsersInfo;
use app\models\UsersInfoSearch;
use app\models\UsersLevel;
use app\models\UsersSearch;
use Yii;
use yii\data\Pagination;

class TopSearchController extends \yii\web\Controller
{
    public $layout = 'none';

    public function actionIndex()
    {
        $levelList = Level::getAll();
        $districtList = Train::$districtList;
        $data = [
            'levelList' => $levelList,
            'districtList' => $districtList
        ];
        return $this->render('index', [
            'data' => $data
        ]);
    }
}