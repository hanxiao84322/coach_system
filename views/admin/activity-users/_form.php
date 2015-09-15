<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'practice_score')->textInput() ?>

    <?= $form->field($model, 'theory_score')->textInput() ?>

    <?= $form->field($model, 'rule_score')->textInput() ?>

    <?= $form->field($model, 'score_appraise')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attendance_appraise')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practice_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'theory_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rule_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'create_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'update_user')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
