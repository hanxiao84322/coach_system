<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrainCategory */

$this->title = '创建班课类别';
$this->params['breadcrumbs'][] = ['label' => '班课类别设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
