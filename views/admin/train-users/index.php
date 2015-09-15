<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评分管理';
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
                'format' => 'html',
                'value'=> function ($searchModel) {
                    return '<a href="/Admin/users/index?UsersSearch[id]=' . $searchModel->user_id . '">' . app\models\Users::getOneUserNameById($searchModel->user_id) . '</a>';
                }
            ],
            [
                'attribute' => 'status',
                'value'=> function ($searchModel) {
                    return app\models\TrainUsers::$statusList[$searchModel->status];
                }
            ],
            'practice_score',
             'theory_score',
             'rule_score',
             'score_appraise',
            [
                'attribute' => 'attendance_appraise',
                'format' => 'html',
                'value' => function ($searchModel) {
                    return '<a href="/Admin/attendance/index?AttendanceSearch[user_id]=' . $searchModel->user_id . '&AttendanceSearch[train_id]=' . $searchModel->train_id . '" target="_blank" style="width:300px">' . $searchModel->attendance_appraise . '</a>';
                }
            ],
            // 'practice_comment',
            // 'theory_comment',
            // 'rule_comment',
            // 'total_comment',
            // 'result_comment',
            // 'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
