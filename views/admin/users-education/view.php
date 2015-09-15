<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersEducation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Educations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-education-view">

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
            'school',
            'begin_time',
            'end_time',
            'address',
            'educational_background',
            'witness',
            'witness_phone',
            'description',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
