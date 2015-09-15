<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新用户', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除用户', ['delete', 'id' => $model->id], [
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
            'username',
            [
                'attribute' => 'level_id',
                'value'=> app\models\Level::getOneLevelNameById($model->level_id)            ],
            [
                'attribute' => 'email_auth',
                'value' => $model->email_auth ? '是' : '否'
            ],
            [
                'attribute' => 'phone_auth',
                'value' => $model->phone_auth ? '是' : '否'
            ],
            [
                'attribute' => 'status',
                'value'=> app\models\Users::getStatusName($model->status)
            ],
            'mobile_phone',
            'email:email',
            'lesson',
            'credit',
            'score',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
