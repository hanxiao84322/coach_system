<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrainTeachers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-trainteachers-trainname">
        <label class="control-label" for="trainteachers-trainname">参与培训课程:</label>
        <a href="/Admin/train/index?TrainSearch[id]=<?= $model->trainId?>" target="_blank" style="width:300px"><?= $model->trainName?></a>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'train_id')->hiddenInput(['value'=>$model->trainId])->label(false) ?>

    <div class="form-group field-trainteachers-teachers_id has-success">
        <label for="trainteachers-teachers_id" class="control-label">讲师</label>
        <select style="width:200px" name="TrainTeachers[teachers_id]" class="form-control" id="trainteachers-teachers_id">
            <?php foreach(\app\models\Teachers::getAll() as $key => $val):?>
            <option value="<?= $val['id']?>" <?php if ($model->teachers_id == $val['id']) {?> selected <?php }?>><?= $val['name']?><?php if (\app\models\TrainTeachers::findOne(['train_id' => $model->trainId, 'teachers_id' => $val['id']])) {?>———已选<?php }?></option>
            <?php endforeach;?>
        </select>

        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
