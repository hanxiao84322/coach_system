<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdminGroup */

$this->title = '更新权限组: ' . ' ' . $model->group_name;
$this->params['breadcrumbs'][] = ['label' => '权限组管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新权限组';
?>
<div class="admin-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
