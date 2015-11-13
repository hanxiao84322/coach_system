<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrainUsers */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript">
    function display_confirm()
    {
        var r=confirm("确认操作吗？")
        if (r==true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
<div class="train-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-trainusers-trainname">
        <label class="control-label" for="trainusers-trainname">参与培训课程:</label>
        <a href="/Admin/train/index?TrainSearch[id]=<?= $model->train_id?>" target="_blank" style="width:300px"><?= $model->trainName?></a>
        <div class="help-block"></div>
    </div>
    <div class="form-group field-trainusers-username">
        <label class="control-label" for="trainusers-username">参与学员:</label>
            <a href="/Admin/users/index?UsersSearch[id]=<?= $model->user_id?>" target="_blank" style="width:300px"><?= $model->userName?></a>
        <div class="help-block"></div>
    </div>
    <?php if (in_array($model->status, [\app\models\TrainUsers::PASS,\app\models\TrainUsers::NO_PASS])) {?>
        <?= $form->field($model, 'status')->dropDownList([$model->status=>\app\models\TrainUsers::$statusList[$model->status]],['style'=>'width:200px']) ?>
    <?php } else {?>
        <?= $form->field($model, 'status')->dropDownList(\app\models\TrainUsers::$statusList,['style'=>'width:200px']) ?>
    <?php }?>
    评分说明：
    <br>实践评分（满分100分）理论评分（满分100分）规则评分（满分100分）
    <br>总评：等于（实践分数+理论分数+规则分数）除以 3
    <br>通过：每一项评分都超过60
    <br>未通过：有一项评分低于60
    <br>评价结果：79-100 推荐晋级；59-79 实践1年推荐晋级；0-59未通过
        <br>未通过：有一项评分低于60
    <?= $form->field($model, 'practice_score')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'theory_score')->textInput(['style'=>'width:100px']) ?>

    <?= $form->field($model, 'rule_score')->textInput(['style'=>'width:100px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '评分', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','onClick'=>'return display_confirm();']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
