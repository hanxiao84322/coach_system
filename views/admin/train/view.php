<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Train */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '培训课程管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新培训课程', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除培训课程', ['delete', 'id' => $model->id], [
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
            'name',
            [
                'attribute' => 'category',
                'label'=>'级别',
                'value'=> app\models\TrainCategory::getNameById($model->category)
            ],
            [
                'attribute' => 'level_id',
                'label'=>'级别',
                'value'=> app\models\Level::getOneLevelNameById($model->level_id)
            ],
            'code',
            'recruit_count',
            'sign_up_begin_time',
            'sign_up_end_time',
            'begin_time',
            'end_time',
            [
                'attribute' => 'status',
                'label'=>'状态',
                'value'=> app\models\Train::getStatusName($model->status)
            ],
            'district',
            'address',
            'bus',
            'near_site',
            'content:ntext',
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
