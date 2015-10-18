<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Messages */

$this->title = '创建站内消息';
$this->params['breadcrumbs'][] = ['label' => '管理站内消息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
