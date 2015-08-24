<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Level */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '级别管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新级别', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除级别', ['delete', 'id' => $model->id], [
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
            'lesson',
            'credit',
            'score',
            'login_duration',
            'register_fee',
            'content',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
