<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrainUsers */

$this->title = '操作';
//成绩管理
$this->params['breadcrumbs'][] = ['label' => '培训课程管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trainName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '评分';
?>
<div class="train-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
