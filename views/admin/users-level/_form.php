<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\UsersLevel;

/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-level-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group field-trainusers-trainname">
        <label class="control-label" for="trainusers-trainname">参与培训课程:</label>
        <a href="/Admin/train/index?TrainSearch[id]=<?= $model->train_id?>" target="_blank" style="width:300px"><?= \app\models\Train::getOneTrainNameById($model->train_id)?></a>
        <div class="help-block"></div>
    </div>
    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">参与学员:</label>
        <a href="/Admin/users/index?UsersSearch[id]=<?= $model->user_id?>" target="_blank" style="width:300px"><?= \app\models\Users::getOneUserNameById($model->user_id)?></a>
        <div class="help-block"></div>
    </div>

    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">晋升级别:</label>
        <?= \app\models\Level::getOneLevelNameById($model->level_id+1)?></a>
        <div class="help-block"></div>
    </div>

    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">证件号码:</label>
        <?= $model->certificate_number?></a>
        <div class="help-block"></div>
    </div>

    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">所属区域:</label>
        <?= $model->district?></a>
        <div class="help-block"></div>
    </div>

    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">收货地址:</label>
        <?= $model->receive_address?></a>
        <div class="help-block"></div>
    </div>

    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">邮编:</label>
        <?= $model->postcode?></a>
        <div class="help-block"></div>
    </div>

    <?php if (($model->status == UsersLevel::PAY) || ($model->status == UsersLevel::REG)) {?>
    <?= $form->field($model, 'status')->dropDownList([UsersLevel::REG=>UsersLevel::$statusList[UsersLevel::REG],UsersLevel::PAY=>UsersLevel::$statusList[UsersLevel::PAY],UsersLevel::SEND_CARD=>UsersLevel::$statusList[UsersLevel::SEND_CARD]],['style'=>'width:100px']) ?>
    <?php } else {?>
        <div class="form-group field-trainusers-username">
            <label class="control-label" for="trainusers-username">状态:</label>
            <?= \app\models\UsersLevel::$statusList[$model->status]?></a>
            <div class="help-block"></div>
        </div>
    <?php }?>
    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">形象照:</label>
        <?php if (!empty($photo)) {?>
            <img src='/upload/images/users_info/photo/<?= $photo?>' width=157 height='210'>
        <?php } else {?>
        无
        <?php }?>
        <div class="help-block"></div>
    </div>
    <?php if (($model->status == UsersLevel::LEVEL_UP) || ($model->status == UsersLevel::SEND_CARD)) {?>
        <div class="form-group field-trainusers-username">
            <label class="control-label" for="trainusers-username">到期时间:</label>
            <?= date('Y-m-d', strtotime($model->end_date))?></a>
            <div class="help-block"></div>
        </div>
    <?php }?>

    <?php if (($model->status != UsersLevel::SEND_CARD) && ($model->status != UsersLevel::LEVEL_UP)) {?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php }?>

    <?php ActiveForm::end(); ?>

</div>
