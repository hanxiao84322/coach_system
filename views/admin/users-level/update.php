<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */

$this->title = '更新用户晋升信息';
$this->params['breadcrumbs'][] = ['label' => '用户晋升管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="users-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'photo' => $photo
    ]) ?>

</div>
