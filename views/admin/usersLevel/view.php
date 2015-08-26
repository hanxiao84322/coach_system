<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-level-view">

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
            'level_id',
            'certificate_number',
            'district',
            'receive_address',
            'postcode',
            'is_pay',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>