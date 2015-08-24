<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Train */

$this->title = '更新培训课程: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '管理培训课程', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="train-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
