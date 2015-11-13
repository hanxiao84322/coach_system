<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrainLand */

$this->title = '更新培训地: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '培训地管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="train-land-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
