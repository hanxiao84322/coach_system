<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户晋升管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-level-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'train_id',
                'value'=> \app\models\Train::getOneTrainNameById($model->train_id)
            ],
            [
                'attribute' => 'user_id',
                'value'=> \app\models\Users::getOneUserNameById($model->user_id)
            ],
            [
                'attribute' => 'status',
                'value'=> \app\models\UsersLevel::getStatusName($model->status)
            ],
            'certificate_number',
            [
                'attribute' => 'end_date',
                'value'=> date('Y-m-d', strtotime($model->end_date))
            ],
            'district',
            'receive_address',
            'postcode',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value'=> "<img src='/upload/images/users_info/photo/".  \app\models\UsersInfo::getPhotoByUserId($model->user_id) . "' width=157 height='210'>"
            ],
            [
                'attribute' => 'credentials_photo',
                'format' => 'html',
                'value'=> "<img src='/upload/images/users_level/credentials_photo/".  $model->credentials_photo . "' width=500 height='210'>"
            ],
            [
                'attribute' => 'level_id',
                'value'=> \app\models\Level::getOneLevelNameById($model->level_id+1)
            ],
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
