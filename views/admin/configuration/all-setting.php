<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */

$this->title = '系统设置';
$this->params['breadcrumbs'][] = ['label' => '系统设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="configuration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="configuration-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'keyword')->textInput(['style'=>'width:300px']) ?>

        <?= $form->field($model, 'description')->textInput(['style'=>'width:300px']) ?>

        <?= $form->field($model, 'copyright')->textInput(['style'=>'width:300px']) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>