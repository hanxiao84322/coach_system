<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrainUsers */

$this->title = 'Update Train Users: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Train Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="train-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
