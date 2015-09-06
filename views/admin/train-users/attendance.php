<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '考勤信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'train_id',
                'value'=> function ($searchModel) {
                    return app\models\Train::getOneTrainNameById($searchModel->train_id);
                }
            ],
            [
                'attribute' => 'user_id',
                'value'=> function ($searchModel) {
                    return app\models\Users::getOneUserNameById($searchModel->user_id);
                }
            ],
//            'practice_score',
            // 'theory_score',
            // 'rule_score',
            [
                'label' => '请假',
                'value'=> function ($searchModel) {
                    return app\models\Attendance::getCount($searchModel->train_id, $searchModel->user_id, app\models\Attendance::LEAVE);
                }
            ],
            [
                'label' => '迟到',
                'value'=> function ($searchModel) {
                    return app\models\Attendance::getCount($searchModel->train_id, $searchModel->user_id, app\models\Attendance::LATER);
                }
            ],
            [
                'label' => '早退',
                'value'=> function ($searchModel) {
                    return app\models\Attendance::getCount($searchModel->train_id, $searchModel->user_id, app\models\Attendance::ABSENCES);
                }
            ],
            [
                'label' => '旷课',
                'value'=> function ($searchModel) {
                    return app\models\Attendance::getCount($searchModel->train_id, $searchModel->user_id, app\models\Attendance::EARLY);
                }
            ],
            // 'attendance_appraise',
            // 'practice_comment',
            // 'theory_comment',
            // 'rule_comment',
            // 'total_comment',
            // 'result_comment',
            // 'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            [
                'label' => '操作',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('更新考勤', ['Admin/attendance/', 'AttendanceSearch[user_id]' => $searchModel->user_id, 'AttendanceSearch[train_id]' =>  $searchModel->train_id]);
                    return $url;
                }
            ],
        ],
    ]); ?>

</div>
