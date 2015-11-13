<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Train */

$this->title = '数据库备份';
$this->params['breadcrumbs'][] = ['label' => '工具', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="teachers-level-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= Html::submitButton('备份', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <?php if (!empty($result)) {?>
        <?= $result?>
    <?php }?>



</div>
