<?php

namespace app\controllers;

use app\models\Train;
use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersLevel;
use app\models\Level;
use Yii;
use yii\data\Pagination;
use yii\web\ServerErrorHttpException;

class SearchController extends \yii\web\Controller
{
    public $layout = 'user';

    public function actionIndex()
    {
        $keyword = Yii::$app->request->get('keyword', '');
        $levelId = Yii::$app->request->get('level_id', '');
        $district = Yii::$app->request->get('district', '');
        $sex = Yii::$app->request->get('sex', '');

        if (empty($keyword) && empty($levelId) && empty($district) && empty($sex)) {
            throw new ServerErrorHttpException('请输入关键字！');
        }
        $levelList = Level::getAll();
        $districtList = Train::$districtList;
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

        $query = Users::find()->from(Users::tableName() . ' u')->select("u.*,ui.account_location,ui.sex")->leftJoin(UsersLevel::tableName() . ' ul', ' u.id = ul.user_id')->leftJoin(UsersInfo::tableName() . ' ui', ' u.id = ui.user_id');

        if (!empty($order)) {
            $query->orderBy($order);
        }

        $query->andFilterWhere(['!=', 'u.level_id', '1']);

        if (!empty($levelId)) {
            $query->andFilterWhere(['u.level_id' => $levelId]);
        }

        if (!empty($district)) {
            $query->andFilterWhere(['account_location' => $district]);
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
        $result = [];
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $result[$key]['name'] = $val['username'];
                $result[$key]['photo'] = UsersInfo::getPhotoByUserId($val['id']);
                $result[$key]['birthday'] = UsersInfo::getBirthdayByUserId($val['id']);
                $result[$key]['level_id'] = $val['level_id'];
                $result[$key]['user_id'] = $val['id'];
            }
        }

        $data = [
            'models' => $result,
            'pages' => $pages,
            'count' =>  $query->count(),
            'levelList' => $levelList,
            'districtList' => $districtList,
            'keyword' => empty($keyword)? '' : $keyword,
            'levelId' => empty($levelId) ? '' : $levelId,
            'district' => empty($district) ? '' : $district,
            'sex' => empty($sex)  ? '' : $sex,
        ];

        return $this->render('index', [
            'data' => $data
        ]);
    }

}
