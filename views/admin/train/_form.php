<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Train */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-form">

    <?php $form = ActiveForm::begin([
        'id'=>'addTrain',
        'enableAjaxValidation' => false,
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'category')->dropDownList(\app\models\Train::$categoryList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'level_id')->dropDownList(ArrayHelper::map(\app\models\Level::getAll(),'id', 'name'),['style'=>'width:100px']) ?>

    <?= $form->field($model, 'recruit_count')->textInput(['style'=>'width:100px']) ?>
    <?php if ($model->isNewRecord) {?>
    <?= $form->field($model, 'sign_up_begin_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'sign_up_end_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>
    <?php } else {?>
    <?= $form->field($model, 'sign_up_begin_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px','disabled' => 'disabled']]) ?>

    <?= $form->field($model, 'sign_up_end_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px','disabled' => 'disabled']]) ?>
    <?php }?>
    <?= $form->field($model, 'district')->dropDownList(\app\models\Train::$districtList,['style'=>'width:100px']) ?>

    <?php if ($model->isNewRecord) {?>
    <?= $form->field($model, 'begin_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'end_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>
    <?php } else {?>
    <?= $form->field($model, 'begin_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px','disabled' => 'disabled']]) ?>

    <?= $form->field($model, 'end_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px','disabled' => 'disabled']]) ?>
    <?php }?>
    <?php if  ($model->status == \app\models\Train::DOING) {?>
    <?= $form->field($model, 'status')->dropDownList([\app\models\Train::END => \app\models\Train::$statusList[\app\models\Train::END]],['style'=>'width:200px']) ?>
    <?php  } elseif  ($model->status == \app\models\Train::END) { ?>
        <?= $form->field($model, 'status')->dropDownList([\app\models\Train::END => \app\models\Train::$statusList[\app\models\Train::END]],['style'=>'width:200px']) ?>
    <?php } else {?>
        <?= $form->field($model, 'status')->dropDownList(\app\models\Train::$statusList,['style'=>'width:200px']) ?>
    <?php }?>

    <?= $form->field($model, 'lesson')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'address')->textInput(['style'=>'width:500px']) ?>
    <?= $form->field($model, 'bus')->textInput(['style'=>'width:500px']) ?>
    <?= $form->field($model, 'near_site')->textInput(['style'=>'width:500px']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
