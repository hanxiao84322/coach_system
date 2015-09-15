<?php

namespace app\controllers;

use app\models\News;
use app\models\Teachers;
use app\models\Train;
use app\models\TrainTeachers;
use Yii;
use yii\data\Pagination;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $imgNews = News::getImgRecommendNewsByCategory(2,5);
        $newsA = News::getImgRecommendNewsByCategory(4,5);
        $newsB = News::getImgRecommendNewsByCategory(1,5);
        $data = [
            'imgNews' => $imgNews,
            'newsA' => $newsA,
            'newsB' => $newsB,
        ];
        return $this->render('index', ['data' => $data]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $newInfo = News::findOne($id);
        $aboutNewsList = News::getAboutNewsByCategory($newInfo['category_id']);
        return $this->render('view', ['newInfo' => $newInfo, 'aboutNewsList' => $aboutNewsList]);

    }

    public function actionTrain()
    {
        $levelId = Yii::$app->request->get('level_id');
        $imgNews = News::getImgRecommendNewsByCategory(3,5);
        $teachersCount = Teachers::getTeachersCount();
        $trainCount = Train::getTrainCount();
        $trainTeachers = Teachers::getAllTeachersForNewsTrain();
        $trainWind = News::getTrainWindByLevelId($levelId,8);
        $newsPlace = News::getImgRecommendNewsByCategory(9,4);

        $data = [
            'imgNews' => $imgNews,
            'teachersCount' => $teachersCount,
            'trainTeachers' => $trainTeachers,
            'levelId' => $levelId,
            'trainWind' => $trainWind,
            'trainCount'=> $trainCount,
            'newsPlace' => $newsPlace
        ];
        return $this->render('train', ['data' => $data]);
    }

    public function actionList()
    {
        $imgNews = News::getImgRecommendNewsByCategory(2,5);
        $categoryId = Yii::$app->request->get('category_id');
        $query = News::find()->where(['category_id' => $categoryId]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $data = [
            'models' => $models,
            'pages' => $pages,
            'categoryId' => $categoryId,
            'imgNews' => $imgNews
        ];
        return $this->render('list', [
            'data' => $data
        ]);
    }


}
