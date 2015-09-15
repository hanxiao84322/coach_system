<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersPlayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Players';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-players-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users Players', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'team',
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
