<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersInfo */

$this->title = '更新用户基本信息: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '用户基本信息管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="users-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
