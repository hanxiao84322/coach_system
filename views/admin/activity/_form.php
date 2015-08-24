<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'category')->dropDownList(\app\models\Train::$categoryList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'level_id')->dropDownList(ArrayHelper::map(\app\models\Level::getAll(),'id', 'name'),['style'=>'width:100px']) ?>

    <?= $form->field($model, 'recruit_count')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'sign_up_begin_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'sign_up_end_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'sign_up_status')->dropDownList(\app\models\Train::$signUpStatusList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'begin_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'end_time')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Train::$statusList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'integration')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'address')->textInput(['style'=>'width:500px']) ?>

    <?= $form->field($model, 'lesson')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'launch')->textInput(['style'=>'width:500px']) ?>

    <?= $form->field($model, 'organizers')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'join_teams')->textInput(['style'=>'width:300px']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
