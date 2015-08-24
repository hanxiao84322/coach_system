<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'create_time',
            'create_user',
            'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
