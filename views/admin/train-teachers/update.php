<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrainTeachers */

$this->title = '更新讲师:';
$this->params['breadcrumbs'][] = ['label' => '讲师管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="train-teachers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
