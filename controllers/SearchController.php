<?php

namespace app\controllers;

use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersInfoSearch;
use app\models\UsersLevel;
use app\models\Level;
use Yii;
use yii\data\Pagination;

class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $keyword = Yii::$app->request->get('keyword');
        $levelId = Yii::$app->request->get('level_id');
        $district = Yii::$app->request->get('district');
        $sex = Yii::$app->request->get('sex');

        $levelList = Level::getAll();
        $districtList = [
            '朝阳区' => '朝阳区',
            '东城区' => '东城区',
            '海淀区' => '海淀区',
            '西城区' => '西城区',
            '昌平区' => '昌平区',
        ];
        $userName = '';
        $certificateNumber = '';
        $credentialsNumber = '';

        if (preg_match("/^[\x7f-\xff]+$/", $keyword)) {
            $userName = $keyword;
        } else if (strlen($keyword) > 10) {
            $credentialsNumber = $keyword;
        } else {
            $certificateNumber = $keyword;
        }

        $order = Yii::$app->request->get('order');

        $query = UsersInfoSearch::find()->from(UsersInfo::tableName() . ' ui')->select("ui.*,ul.level_id as level_id")->leftJoin(UsersLevel::tableName() . ' ul', ' ui.user_id = ul.user_id')->leftJoin(Users::tableName() . ' u', ' u.id = ui.user_id');

        if (!empty($order)) {
            $query->orderBy($order);
        }

        if (!empty($levelId)) {
            $query->andFilterWhere(['ul.level_id' => $levelId]);
        }

        if (!empty($district)) {
            $query->andFilterWhere(['district' => $district]);
        }
        if (!empty($sex)) {
            $query->andFilterWhere(['sex' => $sex]);
        }
        if (!empty($userName)) {
            $query->andFilterWhere(['like', 'name', $userName]);
        }
        if (!empty($certificateNumber)) {
            $query->andFilterWhere(['like', 'certificate_number', $certificateNumber]);
        }
        if (!empty($credentialsNumber)) {
            $query->andFilterWhere(['like', 'credentials_number', $credentialsNumber]);
        }

        $pages = new Pagination([
            'totalCount'=>$query->count(),
            'pageSize' => 15
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $data = [
            'models' => $models,
            'pages' => $pages,
            'count' =>  $query->count(),
            'levelList' => $levelList,
            'districtList' => $districtList
        ];

        return $this->render('index', [
            'data' => $data
        ]);
    }

}
