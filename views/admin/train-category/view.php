<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TrainCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '班课类别设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
