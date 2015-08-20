<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'password',
            'sex',
            'birthday',
            'title',
            'status',
            'credentials_type',
            'credentials_number',
            'account_location',
            'telephone',
            'mobile_phone',
            'email:email',
            'height',
            'weight',
            'disease_history',
            'contact_address',
            'contact_postcode',
            'company_name',
            'company_address',
            'company_postcode',
            'company_contact_phone',
            'clothes_size',
            't_shirt_size',
            'shorts_size',
            'language',
            'spoken_language',
            'write_language',
            'lesson',
            'credit',
            'score',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
