<?php

namespace app\controllers;

use app\models\Level;
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
        $districtList = [
            '朝阳区' => '朝阳区',
            '东城区' => '东城区',
            '海淀区' => '海淀区',
            '西城区' => '西城区',
            '昌平区' => '昌平区',
        ];
        $data = [
            'levelList' => $levelList,
            'districtList' => $districtList
        ];
        return $this->render('index', [
            'data' => $data
        ]);
    }
}