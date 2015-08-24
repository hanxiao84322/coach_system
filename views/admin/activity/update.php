<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = '更新活动: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新活动';
?>
<div class="activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
