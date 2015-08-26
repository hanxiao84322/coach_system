<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */

$this->title = '更新配置';
$this->params['breadcrumbs'][] = ['label' => '配置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="configuration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
