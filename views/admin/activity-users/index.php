<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivityUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分值管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activity_id',
            'user_id',
            'status',
            'practice_score',
            // 'theory_score',
            // 'rule_score',
            // 'score_appraise',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
