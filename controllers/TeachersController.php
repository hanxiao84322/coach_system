<?php

namespace app\controllers;

use app\models\Teachers;
use Yii;
use app\models\News;

class TeachersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $teachersArea = Teachers::getTeachersCountGroupByArea();
        $teachersList = Teachers::getAllTeachersForTeachersIndex();
        $data = [
            'teachersArea' => $teachersArea,
            'teachersList' => $teachersList
        ];
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = Teachers::findOne(['id' => $id]);
        $trainWind = News::getImgRecommendNewsByCategory(11, 12);

        return $this->render('view', [
            'data' => $model,
            'trainWind' => $trainWind
        ]);
    }



}
