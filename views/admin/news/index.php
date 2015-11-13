<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表操作';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(['action'=>\yii\helpers\Url::to('/Admin/news/del')]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => Html::checkBox('selection_all', false, [
                    'class' => 'select-on-check-all',
                ]),
            ],
            'title',
            [
                'attribute' => 'category_id',
                'value' => function($searchModel){
                    return app\models\NewsCategory::getOneCategoryNameById($searchModel->category_id);
                },
            ],
            // 'status',
            // 'thumb',
            // 'is_pic',
            [
                'attribute' => 'is_recommend',
                'value' => function($searchModel){
                    return app\models\NewsCategory::getIsRecommendName($searchModel->is_recommend);
                }
            ],            // 'tag',
            // 'related_news',
             'create_time',
             'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <input name="update_status" type="submit" value="删除">
    <?php ActiveForm::end(); ?>
</div>
