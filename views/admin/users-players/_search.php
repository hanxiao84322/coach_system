<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersPlayersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-players-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'team') ?>

    <?= $form->field($model, 'begin_time') ?>

    <?= $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'witness') ?>

    <?php // echo $form->field($model, 'witness_phone') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
