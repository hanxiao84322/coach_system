<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TeachersLevel */

$this->title = '讲师角色更新: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '讲师角色设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teachers-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
