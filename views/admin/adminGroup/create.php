<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdminGroup */

$this->title = '创建权限组';
$this->params['breadcrumbs'][] = ['label' => '管理权限组', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
