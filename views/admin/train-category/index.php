<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '班课类别设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建班课类别', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($searchModel){
                    return "<a href='/Admin/train?TrainSearch[category]=" . $searchModel->id . "' target='_blank'>" . $searchModel->name . "</a>";
                }
            ],
            'create_time',
            'create_user',
            'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
