<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersEducationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Educations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-education-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users Education', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'school',
            'begin_time',
            'end_time',
            // 'address',
            // 'educational_background',
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
