<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'level_id') ?>

    <?= $form->field($model, 'recruit_count') ?>

    <?php // echo $form->field($model, 'sign_up_begin_time') ?>

    <?php // echo $form->field($model, 'sign_up_end_time') ?>

    <?php // echo $form->field($model, 'sign_up_status') ?>

    <?php // echo $form->field($model, 'begin_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'lesson') ?>

    <?php // echo $form->field($model, 'integration') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'launch') ?>

    <?php // echo $form->field($model, 'organizers') ?>

    <?php // echo $form->field($model, 'join_teams') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'create_user') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
