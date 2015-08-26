<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'web_name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'contact_email')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'attach_size')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'keyword')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'description')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'copyright')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'address')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'icp')->textInput(['style'=>'width:300px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
