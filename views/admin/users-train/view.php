<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersTrain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Trains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-train-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'user_id',
            'credentials_number',
            'begin_time',
            'end_time',
            'level',
            'address',
            'witness',
            'witness_phone',
            'description',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
