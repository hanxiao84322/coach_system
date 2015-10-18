<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Users::$statusList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'email')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'lesson')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'credit')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'score')->textInput(['style'=>'width:100px']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
