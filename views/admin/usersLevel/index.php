<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '晋升管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-level-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'level_id',
            'certificate_number',
            'district',
            // 'receive_address',
            // 'postcode',
            // 'is_pay',
            // 'create_time',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
