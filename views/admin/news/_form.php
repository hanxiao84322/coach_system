<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pjkui\kindeditor\KindEditor;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(\app\models\NewsCategory::getAll(),'id', 'name'),['style'=>'width:100px']) ?>

    <?= $form->field($model, 'content')->widget('pjkui\kindeditor\Kindeditor',['clientOptions'=>['allowFileManager'=>'true','allowUpload'=>'true']])  ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\News::$statusList,['style'=>'width:100px']) ?>
    <?php if (!$model->isNewRecord && !empty($model->thumb)) {?>
        <a href="#"><img src="/upload/images/news/thumb/<?= $model->thumb ?>"></a>

        <?= $form->field($model, 'thumb')->fileInput(['style'=>'width:500px']) ?>
    <?php } else {?>
        <?= $form->field($model, 'thumb')->fileInput(['style'=>'width:500px']) ?>
    <?php } ?>


    <?= $form->field($model, 'is_recommend')->radioList([ '0' => '否', '1' => '是']) ?>

    <?php if (!empty($model->user_id)) {?>
        <div class="form-group field-trainusers-username">
            <label class="control-label" for="trainusers-username">作者:</label>
            <a href="/Admin/users/index?UsersSearch[id]=<?= $model->user_id?>" target="_blank" style="width:300px"><?= \app\models\Users::getOneUserNameById($model->user_id)?></a>
            <div class="help-block"></div>
        </div>
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
