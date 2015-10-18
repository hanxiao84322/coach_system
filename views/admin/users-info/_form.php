<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'sex')->dropDownList(\app\models\UsersInfo::$sexList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

        <?= $form->field($model, 'sex')->dropDownList(\app\models\UsersInfo::$credentialsType,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'credentials_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'disease_history')->dropDownList(\app\models\UsersInfo::$diseaseHistory,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'contact_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_contact_phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'clothes_size')->dropDownList(\app\models\UsersInfo::$languageList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 't_shirt_size')->dropDownList(\app\models\UsersInfo::$abilityList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'shorts_size')->dropDownList(\app\models\UsersInfo::$abilityList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'language')->dropDownList(\app\models\UsersInfo::$abilityList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'spoken_language')->dropDownList(\app\models\UsersInfo::$abilityList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'write_language')->dropDownList(\app\models\UsersInfo::$abilityList,['style'=>'width:100px']) ?>
    <?php if (!empty($model->photo)) {?>
        <div class="form-group field-usersinfo-company_contact_phone">
            <label for="usersinfo-company_contact_phone" class="control-label">形象照</label>
            <img src="/upload/images/users_info/photo/<?= $model->photo ?>">
            <div class="help-block"></div>
        </div>
    <?php }?>
    <?php if (!empty($model->credentials_photo)) {?>
        <div class="form-group field-usersinfo-company_contact_phone">
            <label for="usersinfo-company_contact_phone" class="control-label">证件照</label>
            <img src="/upload/images/users_info/credentials_photo/<?= $model->credentials_photo ?>">
            <div class="help-block"></div>
        </div>
    <?php }?>

    <?php ActiveForm::end(); ?>

</div>
