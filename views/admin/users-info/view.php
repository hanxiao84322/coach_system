<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '用户基本信息管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-info-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'sex',
                'value'=> app\models\UsersInfo::getSexName($model->sex)
            ],
            'birthday',
            [
                'attribute' => 'sex',
                'value'=> '身份证'
            ],
            'credentials_number',
            'account_location',
            'telephone',
            'height',
            'weight',
            [
                'attribute' => 'disease_history',
                'value'=> app\models\UsersInfo::getDiseaseHistoryName($model->disease_history)
            ],
            'contact_address',
            'contact_postcode',
            'company_name',
            'company_address',
            'company_postcode',
            'company_contact_phone',
            [
                'attribute' => 'clothes_size',
                'value'=> app\models\UsersInfo::getSizeName($model->clothes_size)
            ],
            [
                'attribute' => 't_shirt_size',
                'value'=> app\models\UsersInfo::getSizeName($model->t_shirt_size)
            ],
            [
                'attribute' => 'shorts_size',
                'value'=> app\models\UsersInfo::getSizeName($model->shorts_size)
            ],
            [
                'attribute' => 'language',
                'value'=> app\models\UsersInfo::getLanguageName($model->language)
            ],
            [
                'attribute' => 'spoken_language',
                'value'=> app\models\UsersInfo::getAbilityName($model->spoken_language)
            ],
            [
                'attribute' => 'write_language',
                'value'=> app\models\UsersInfo::getAbilityName($model->write_language)
            ],
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value'=> $model->photo ? '<img src="/upload/images/user_info/photo/'. $model->photo . '">' : '无'
            ],
            [
                'attribute' => 'credentials_photo',
                'format' => 'html',
                'value'=> $model->credentials_photo ? '<img src="/upload/images/user_info/credentials_photo/'. $model->credentials_photo . '">' : '无'
            ]
        ],
    ]) ?>

</div>
