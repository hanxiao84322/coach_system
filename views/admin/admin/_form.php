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

    <div class="form-group field-admin-password has-success">
        <label for="admin-password" class="control-label">密码</label>&nbsp;&nbsp;&nbsp;<?php if (!$model->isNewRecord) {echo '不需要修改请不用填写';}?>
        <input type="password" style="width:300px" value="" name="Admin[password]" class="form-control" id="admin-password">

        <div class="help-block"></div>
    </div>

    <div class="form-group field-admin-password_repeat has-success">
        <label for="admin-password_repeat" class="control-label">重复密码</label>
        <input type="password" style="width:300px" name="Admin[password_repeat]" class="form-control" id="admin-password_repeat">

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'email')->textInput(['style'=>'width:300px']) ?>


    <div class="form-group field-admin-group_id">
        <label for="admin-group_id" class="control-label">权限组</label>
        <input type="hidden" value="" name="Admin[group_id]"><div id="admin-group_id">
            <?php foreach (\app\models\Admin::$menuTitle as $key => $val) :?>

            <label><input type="checkbox" <?php if (strstr($model->group_id, (string)$key)) { echo 'checked=""';}?> value="<?= $key?>" name="Admin[group_id][]"> <?= $val?></label>
            <?php endforeach;?>
            </div>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'type')->dropDownList(\app\models\Admin::$typeList,['style'=>'width:200px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
