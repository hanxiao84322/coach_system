<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="form-group field-trainusers-trainname">
        <label class="control-label" for="trainusers-trainname">参与培训课程:</label>
        <a href="/Admin/train/index?TrainSearch[id]=<?= $model->train_id?>" target="_blank" style="width:300px"><?= \app\models\Train::getOneTrainNameById($model->train_id)?></a>
        <div class="help-block"></div>
    </div>
    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">参与学员:</label>
        <a href="/Admin/users/index?UsersSearch[id]=<?= $model->user_id?>" target="_blank" style="width:300px"><?= \app\models\Users::getOneUserNameById($model->user_id)?></a>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'day')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Attendance::$statusList,['style'=>'width:100px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
