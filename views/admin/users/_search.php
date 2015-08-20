<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'credentials_type') ?>

    <?php // echo $form->field($model, 'credentials_number') ?>

    <?php // echo $form->field($model, 'account_loaction') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'mobile_phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'disease_history') ?>

    <?php // echo $form->field($model, 'contact_address') ?>

    <?php // echo $form->field($model, 'contact_postcode') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'company_address') ?>

    <?php // echo $form->field($model, 'company_postcode') ?>

    <?php // echo $form->field($model, 'company_contact_phone') ?>

    <?php // echo $form->field($model, 'clothes_size') ?>

    <?php // echo $form->field($model, 't_shirt_size') ?>

    <?php // echo $form->field($model, 'shorts_size') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'spoken_language') ?>

    <?php // echo $form->field($model, 'writh_language') ?>

    <?php // echo $form->field($model, 'lession') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
