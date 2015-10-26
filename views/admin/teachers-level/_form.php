<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeachersLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teachers-level-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'code')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'content')->textarea(['style'=>'width:700px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
