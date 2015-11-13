<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityUsers */

$this->title = '评分';
$this->params['breadcrumbs'][] = ['label' => '活动评分管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '评分', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '评分';
?>
<div class="activity-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
