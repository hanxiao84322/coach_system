<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\MessagesUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<script>
function showContent() {
    $.get("/Admin/messages/get-content?id=" + $("#messages_id").val(), function (data) {
        $("#content").val(data);
    });
};
</script>
<div class="messages-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-messagesusers-type">
        <label for="messagesusers-type" class="control-label">用户类型</label>
        <select style="width:200px;" name="user_type" class="form-control">
            <option value="user_name">用户名</option>
            <option value="user_level">级别</option>
            <option value="all_user">全体用户</option>
        </select>

        <div class="help-block"></div>
    </div>
    用户名例如：张教练，级别例如：C级，全体用户不用填写
    <?= $form->field($model, 'users_id')->textInput(['style' => 'width:600px;']) ?>
<input name="MessagesUsers[type]" value="<?= $type?>" type="hidden">
    <?= $form->field($model, 'messages_id')->dropDownList(array_merge(array('' => '请选择模板'), ArrayHelper::map(\app\models\Messages::getAll(), 'id', 'title')), ['style' => 'width:500px;', 'onChange' => 'return showContent();', 'id' => 'messages_id']) ?>

    <?= $form->field($model, 'content')->textarea(['style' => 'width:500px;', 'id' => 'content']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
