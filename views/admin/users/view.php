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
            'name',
            [
                'attribute' => 'sex',
                'label'=>'性别',
                'value'=> app\models\Users::getSexName($model->sex)
            ],
            'birthday',
            [
                'attribute' => 'title',
                'label'=>'类型',
                'value'=> app\models\Users::getTitleName($model->title)
            ],
            [
                'attribute' => 'status',
                'label'=>'状态',
                'value'=> app\models\Users::getStatusName($model->status)
            ],
            [
                'attribute' => 'credentials_type',
                'label'=>'证件类型',
                'value'=> app\models\Users::getCredentialsName($model->credentials_type)
            ],
            'credentials_number',
            'account_location',
            'telephone',
            'mobile_phone',
            'email:email',
            'height',
            'weight',
            [
                'attribute' => 'disease_history',
                'label'=>'既往病史',
                'value'=> app\models\Users::getDiseaseHistoryName($model->disease_history)
            ],
            'contact_address',
            'contact_postcode',
            'company_name',
            'company_address',
            'company_postcode',
            'company_contact_phone',
            [
                'attribute' => 'clothes_size',
                'label'=>'训练服尺码',
                'value'=> app\models\Users::getSizeName($model->clothes_size)
            ],
            [
                'attribute' => 't_shirt_size',
                'label'=>'训练T恤尺码',
                'value'=> app\models\Users::getSizeName($model->t_shirt_size)
            ],
            [
                'attribute' => 'shorts_size',
                'label'=>'训练鞋尺码',
                'value'=> app\models\Users::getSizeName($model->shorts_size)
            ],
            [
                'attribute' => 'language',
                'label'=>'外语',
                'value'=> app\models\Users::getLanguageName($model->language)
            ],
            [
                'attribute' => 'spoken_language',
                'label'=>'外语',
                'value'=> app\models\Users::getAbilityName($model->spoken_language)
            ],
            [
                'attribute' => 'write_language',
                'label'=>'外语',
                'value'=> app\models\Users::getAbilityName($model->write_language)
            ],
            'lesson',
            'credit',
            'score',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
