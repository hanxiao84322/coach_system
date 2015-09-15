<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersTrain */

$this->title = 'Update Users Train: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Trains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-train-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
