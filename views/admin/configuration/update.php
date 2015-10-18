<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */

$this->title = '系统设置';
$this->params['breadcrumbs'][] = ['label' => '系统设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="configuration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
