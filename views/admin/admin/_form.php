<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'password')->passwordInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'email')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'type')->dropDownList(\app\models\Admin::$typeList,['style'=>'width:200px']) ?>

    <?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(\app\models\AdminGroup::getAll(),'id', 'group_name'),['style'=>'width:200px'])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
