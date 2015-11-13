<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UsersLevelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-level-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::merge(['' => '请选择学员'],ArrayHelper::map(\app\models\Users::getAll(),'id', 'username')),['style'=>'width:200px']) ?>

    <?= $form->field($model, 'level_id')->dropDownList(ArrayHelper::map(\app\models\Level::getAllByEnd(),'id', 'name'),['style'=>'width:100px']) ?>

    <?= $form->field($model, 'certificate_number')->textInput(['style'=>'width:200px']) ?>

    <?php // echo $form->field($model, 'receive_address') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'is_pay') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_user') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
