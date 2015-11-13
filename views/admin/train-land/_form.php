<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrainLand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-land-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'address')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'district')->dropDownList(\app\models\TrainLand::$districtList,['style'=>'width:300px']) ?>

    <?= $form->field($model, 'contacts')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'site_type')->dropDownList(\app\models\TrainLand::$typeList,['style'=>'width:200px']) ?>

    <?= $form->field($model, 'bus')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'site')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'content')->textInput(['style'=>'width:300px']) ?>
    <?php if (!$model->isNewRecord && !empty($model->thumb)) {?>
        <a href="#"><img src="/upload/images/train_land/thumb/<?= $model->thumb ?>"></a>
        <input type="hidden" name="old_thumb" value="<?= $model->thumb?>">

        <?= $form->field($model, 'thumb')->fileInput(['style'=>'width:500px']) ?>
    <?php } else {?>
        <?= $form->field($model, 'thumb')->fileInput(['style'=>'width:500px']) ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
