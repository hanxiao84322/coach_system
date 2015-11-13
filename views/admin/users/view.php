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
                'value'=> app\models\Level::getOneLevelNameById($model->level_id)
            ],
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
    <h2>基本信息</h2>
    <?php if (!empty($modelInfo)) {?>

    <?= DetailView::widget([
        'model' => $modelInfo,
        'attributes' => [
            [
                'attribute' => 'sex',
                'value'=> app\models\UsersInfo::getSexName($modelInfo->sex)
            ],
            'birthday',
            [
                'attribute' => 'credentials_type',
                'value'=> '身份证'
            ],
            'credentials_number',
            'account_location',
            'telephone',
            'height',
            'weight',
            [
                'attribute' => 'disease_history',
                'value'=> app\models\UsersInfo::getDiseaseHistoryName($modelInfo->disease_history)
            ],
            'contact_address',
            'contact_postcode',
            'company_name',
            'company_address',
            'company_postcode',
            'company_contact_phone',
            [
                'attribute' => 'clothes_size',
                'value'=> app\models\UsersInfo::getSizeName($modelInfo->clothes_size)
            ],
            [
                'attribute' => 't_shirt_size',
                'value'=> app\models\UsersInfo::getSizeName($modelInfo->t_shirt_size)
            ],
            [
                'attribute' => 'shorts_size',
                'value'=> app\models\UsersInfo::getSizeName($modelInfo->shorts_size)
            ],
            [
                'attribute' => 'language',
                'value'=> app\models\UsersInfo::getLanguageName($modelInfo->language)
            ],
            [
                'attribute' => 'spoken_language',
                'value'=> app\models\UsersInfo::getAbilityName($modelInfo->spoken_language)
            ],
            [
                'attribute' => 'write_language',
                'value'=> app\models\UsersInfo::getAbilityName($modelInfo->write_language)
            ],
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value'=> $modelInfo->photo ? '<img src="/upload/images/users_info/photo/'. $modelInfo->photo . '">' : '无'
            ],
            [
                'attribute' => 'credentials_photo',
                'format' => 'html',
                'value'=> $modelInfo->credentials_photo ? '<img src="/upload/images/users_info/credentials_photo/'. $modelInfo->credentials_photo . '">' : '无'
            ]
        ],
    ]) ?>
    <?php } else {?>
        没有基本信息
    <?php }?>

    <h2>教育经历</h2>
    <?php if (!empty($modelEducation)) {?>
        <?php foreach ($modelEducation as $key => $val) :?>
            <?= DetailView::widget([
                'model' => $val,
                'attributes' => [
                    'id',
                    'school',
                    'begin_time',
                    'end_time',
                    'address',
                    [
                        'attribute' => 'educational_background',
                        'value'=> app\models\UsersEducation::getEducationalBackground($val->educational_background)
                    ],
                    'witness',
                    'witness_phone',
                    'description',
                    'create_time',
                    'update_time',
                    'update_user',
                ],
            ]) ?>

        <?php endforeach;?>
    <?php } else {?>
        没有教育经历
    <?php }?>
    <h2>培训经历</h2>
    <?php if (!empty($modelTrain)) {?>
        <?php foreach ($modelTrain as $key => $val) :?>
            <?= DetailView::widget([
                'model' => $val,
                'attributes' => [
                    'id',
                    'credentials_number',
                    'begin_time',
                    'end_time',
                    [
                        'attribute' => 'level',
                        'value'=> app\models\UsersTrain::getLevel($val->level)
                    ],
                    'address',
                    'witness',
                    'witness_phone',
                    'description',
                    'create_time',
                    'update_time',
                    'update_user',
                ],
            ]) ?>

        <?php endforeach;?>
    <?php } else {?>
        没有培训经历
    <?php }?>
    <h2>执教经历</h2>
    <?php if (!empty($modelVocational)) {?>
        <?php foreach ($modelVocational as $key => $val) :?>
            <?= DetailView::widget([
                'model' => $val,
                'attributes' => [
                    'id',
                    'team',
                    'begin_time',
                    'end_time',
                    [
                        'attribute' => 'post',
                        'value'=> app\models\UsersVocational::getLevel($val->level)
                    ],
                    'address',
                    'witness',
                    'witness_phone',
                    'description',
                    'create_time',
                    'update_time',
                    'update_user',
                ],
            ]) ?>

        <?php endforeach;?>
    <?php } else {?>
        没有执教经历
    <?php }?>
    <h2>球员经历</h2>
    <?php if (!empty($modelPlayers)) {?>
        <?php foreach ($modelPlayers as $key => $val) :?>
            <?= DetailView::widget([
                'model' => $val,
                'attributes' => [
                    'id',
                    'team',
                    'begin_time',
                    'end_time',
                    [
                        'attribute' => 'level',
                        'value'=> app\models\UsersPlayers::getLevel($val->level)
                    ],
                    'address',
                    'witness',
                    'witness_phone',
                    'description',
                    'create_time',
                    'update_time',
                    'update_user',
                ],
            ]) ?>

        <?php endforeach;?>
    <?php } else {?>
        没有球员经历
    <?php }?>
</div>
