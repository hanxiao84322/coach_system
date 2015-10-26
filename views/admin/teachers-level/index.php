<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeachersLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '讲师角色设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-level-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建讲师角色', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            'content',
            'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
