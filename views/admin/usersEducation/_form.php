<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersEducation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-education-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'begin_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'educational_background')->textInput() ?>

    <?= $form->field($model, 'witness')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'witness_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'update_user')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
