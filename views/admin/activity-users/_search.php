<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'practice_score') ?>

    <?php // echo $form->field($model, 'theory_score') ?>

    <?php // echo $form->field($model, 'rule_score') ?>

    <?php // echo $form->field($model, 'score_appraise') ?>

    <?php // echo $form->field($model, 'attendance_appraise') ?>

    <?php // echo $form->field($model, 'practice_comment') ?>

    <?php // echo $form->field($model, 'theory_comment') ?>

    <?php // echo $form->field($model, 'rule_comment') ?>

    <?php // echo $form->field($model, 'total_comment') ?>

    <?php // echo $form->field($model, 'result_comment') ?>

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
