<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TrainUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'train_id')->dropDownList(ArrayHelper::merge([''=>'选择课程'],ArrayHelper::map(\app\models\Train::getAll(),'id', 'name')),['style'=>'width:300px']) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::merge([''=>'选择用户'],ArrayHelper::map(\app\models\Users::getAll(),'id', 'username')),['style'=>'width:200px']) ?>

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::merge([''=>'选择状态'],\app\models\TrainUsers::$statusList),['style'=>'width:100px']) ?>

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
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
