<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersTrainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '培训信息管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-train-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'credentials_number',
            'begin_time',
            'end_time',
            // 'level',
            // 'address',
            // 'witness',
            // 'witness_phone',
            // 'description',
            // 'create_time',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
