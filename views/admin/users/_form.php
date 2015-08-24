<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin([
        'id'=>'addUser',
        'enableAjaxValidation' => false,
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'password')->passwordInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'sex')->dropDownList(\app\models\Users::$sexList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'birthday')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['style' => '500px']]) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Users::$statusList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'credentials_type')->dropDownList(\app\models\Users::$credentialsType,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'credentials_number')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'account_location')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'telephone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'email')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'height')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'weight')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'disease_history')->dropDownList(\app\models\Users::$diseaseHistory,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'contact_address')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'contact_postcode')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'company_name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'company_address')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'company_postcode')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'company_contact_phone')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'clothes_size')->dropDownList(\app\models\Users::$sizeList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 't_shirt_size')->dropDownList(\app\models\Users::$sizeList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'shorts_size')->dropDownList(\app\models\Users::$sizeList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'language')->dropDownList(\app\models\Users::$languageList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'spoken_language')->dropDownList(\app\models\Users::$abilityList,['style'=>'width:100px']) ?>

    <?= $form->field($model, 'write_language')->dropDownList(\app\models\Users::$abilityList,['style'=>'width:100px']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
