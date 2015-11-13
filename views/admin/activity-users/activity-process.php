<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '完成度管理';
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
                'attribute' => 'activity_id',
                'value'=> function ($searchModel) {
                    return app\models\Activity::getOneActivityNameById($searchModel->activity_id);
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
                'label' => '完成',
                'value'=> function ($searchModel) {
                    return app\models\ActivityProcess::getCount($searchModel->activity_id, $searchModel->user_id, app\models\ActivityProcess::FINISH);
                }
            ],
            [
                'label' => '未完成',
                'value'=> function ($searchModel) {
                    return app\models\ActivityProcess::getCount($searchModel->activity_id, $searchModel->user_id, app\models\ActivityProcess::NO_FINISH);
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
                    $url = Html::a('更新完成度信息', ['Admin/activity-process/', 'ActivityProcessSearch[user_id]' => $searchModel->user_id, 'ActivityProcessSearch[activity_id]' =>  $searchModel->activity_id]);
                    return $url;
                }
            ],
        ],
    ]); ?>

</div>
