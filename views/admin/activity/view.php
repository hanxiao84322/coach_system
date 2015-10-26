<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新活动', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除活动', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
                'label'=>'分类',
                'value'=> app\models\Train::getCategoryName($model->category)
            ],
            [
                'attribute' => 'level_id',
                'label'=>'分类',
                'value'=> app\models\Level::getOneLevelNameById($model->level_id)
            ],
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
            'content:ntext',
            'lesson',
            'score',
            'address',
            'launch',
            'organizers',
            'join_teams',
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
