<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teachers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'sex')->dropDownList(\app\models\Teachers::$sexList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'age')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'level')->dropDownList(\app\models\TeachersLevel::getAll(),['style'=>'width:300px']) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Users::$statusList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'phone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'email')->textInput(['style'=>'width:300px']) ?>


    <?php if (!$model->isNewRecord && !empty($model->photo)) {?>
        <a href="#"><img src="/upload/images/teachers/photo/<?= $model->photo ?>"></a>
        <?= $form->field($model, 'photo')->fileInput(['style'=>'width:500px']) ?>
    <?php } else {?>
        <?= $form->field($model, 'photo')->fileInput(['style'=>'width:500px']) ?>
    <?php } ?>

    <?= $form->field($model, 'lesson')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'score')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'register_district')->dropDownList(\app\models\Train::$districtList,['style'=>'width:300px']) ?>

    <?= $form->field($model, 'certificate_number')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'content')->textarea(['style'=>'width:500px']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
