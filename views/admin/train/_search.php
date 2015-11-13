<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TrainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'begin_date')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>
    <?= $form->field($model, 'end_date')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'level_id')->dropDownList(ArrayHelper::map(\app\models\Level::getAllByEnd(),'id', 'name'),['style'=>'width:100px']) ?>
    <?= $form->field($model, 'period_num')->dropDownList(\app\models\Train::getPeriodNum(),['style'=>'width:100px']) ?>

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::merge(['' => '请选择状态'],\app\models\Train::$statusList),['style'=>'width:200px']) ?>
    <?php // echo $form->field($model, 'sign_up_begin_time') ?>

    <?php // echo $form->field($model, 'sign_up_begin_time') ?>

    <?php // echo $form->field($model, 'sign_up_end_time') ?>

    <?php // echo $form->field($model, 'sign_up_status') ?>

    <?php // echo $form->field($model, 'begin_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'lesson') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'content') ?>

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
