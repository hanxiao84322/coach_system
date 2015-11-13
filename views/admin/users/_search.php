<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'level_id')->dropDownList(ArrayHelper::map(\app\models\Level::getAllByEnd(),'id', 'name'),['style'=>'width:100px']) ?>

    <?php // echo $form->field($model, 'email_auth') ?>

    <?php // echo $form->field($model, 'phone_auth') ?>

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::merge([''=>'选择状态'],\app\models\Users::$statusList),['style'=>'width:100px']) ?>

    <?php // echo $form->field($model, 'mobile_phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'lesson') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'authKey') ?>

    <?php // echo $form->field($model, 'accessToken') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_user') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
