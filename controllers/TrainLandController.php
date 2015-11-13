<?php

namespace app\controllers;

use app\models\Level;
use app\models\TrainLand;
use app\models\TrainUsers;
use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersLevel;
use Yii;
use app\models\Train;
use yii\web\ServerErrorHttpException;
use yii\data\Pagination;
use app\models\TrainTeachers;

class TrainLandController extends \yii\web\Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        $countList = TrainLand::getCountList();
        $query = TrainLand::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $count = count($countList);
        $data = [
            'count' => $count,
            'models' => $models,
            'pages' => $pages
        ];
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $trainLandInfo = TrainLand::findOne($id);

        return $this->render('view', ['trainLandInfo' => $trainLandInfo]);

    }

}