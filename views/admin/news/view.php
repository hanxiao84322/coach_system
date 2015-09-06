<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '新闻管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新新闻', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除新闻', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'content',
                'format' => 'html',
                'value' => $model->content
            ],
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'value' => app\models\NewsCategory::getOneCategoryNameById($model->category_id)
            ],
            [
                'attribute' => 'status',
                'value' => app\models\News::getStatusName($model->status)
            ],
            [
                'attribute' => 'thumb',
                'format' => 'html',
                'value' => $model->thumb ? '<img src="/upload/images/news/thumb/'. $model->thumb . '">' : '无'
            ],
            [
                'attribute' => 'is_recommend',
                'value' => $model->is_recommend ? '是' : '否'
            ],
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
