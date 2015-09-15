<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'credentials_type')->textInput() ?>

    <?= $form->field($model, 'credentials_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'disease_history')->textInput() ?>

    <?= $form->field($model, 'contact_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clothes_size')->textInput() ?>

    <?= $form->field($model, 't_shirt_size')->textInput() ?>

    <?= $form->field($model, 'shorts_size')->textInput() ?>

    <?= $form->field($model, 'language')->textInput() ?>

    <?= $form->field($model, 'spoken_language')->textInput() ?>

    <?= $form->field($model, 'write_language')->textInput() ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'credentials_photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
