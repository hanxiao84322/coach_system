<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MessagesUsers */

if ($type == 1) {
    $this->title = '创建最新公告';
} else {
    $this->title = '创建系统通知';
}
$this->params['breadcrumbs'][] = ['label' => '站内消息管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type
    ]) ?>

</div>
