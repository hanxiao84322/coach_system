<?php

namespace app\controllers;

use app\models\Level;
use app\models\TrainUsers;
use Yii;
use app\models\Train;
use yii\web\ServerErrorHttpException;
use yii\data\Pagination;

class TrainController extends \yii\web\Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        $levelId = \Yii::$app->request->get('levelId') ? \Yii::$app->request->get('levelId') : 2;

        $query = Train::find()->where(['level_id' => $levelId]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $val->begin_time = date('Y-m-d', strtotime($val->begin_time));
                //录取人数
                $countResult = \app\models\TrainUsers::find()->where(['train_id' => $val->id, 'status' => [TrainUsers::APPROVED,TrainUsers::DOING,TrainUsers::END]]);
                $val->already_recruit_count  = $countResult->count();
            }
        }
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'levelId' => $levelId
        ]);
    }

    public function actionApply()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/user/register');
        } else {
            $trainId = Yii::$app->request->get('id');
            $userId = Yii::$app->user->id;
            $trainInfo = Train::findOne(['id' => $trainId]);
            $trainLevelInfo = Level::findOne(['id' => $trainInfo['level_id']]);
            if ($trainLevelInfo['order'] != (Yii::$app->user->identity->level_order + 1)) {
                throw new ServerErrorHttpException('系统错误,原因：您目前没有权限报名该级别下的课程，谢谢。');
            }

            //检查用户参与的课程，状态不是取消的都算是已经参与了报名
            $isExist = TrainUsers::findOne(['user_id' => $userId, 'train_id' => $trainId, 'status !=' . TrainUsers::CANCEL]);

            if (!empty($isExist)) {
                throw new ServerErrorHttpException('系统错误,原因：您已经参与了该培训课程，请重新选择培训课程，谢谢。');

            }
            $data = [
                'train_id' => $trainId,
                'user_id' => $userId,
                'status' => '1'
            ];
            $model = new TrainUsers();
            $model->setAttributes($data);
            if ($model->save()) {
                return $this->redirect('/user-center/index');
            } else {
                throw new ServerErrorHttpException('系统错误,原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE));

            }

        }
    }

}
