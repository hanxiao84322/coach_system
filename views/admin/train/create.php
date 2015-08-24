<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Train */

$this->title = '创建培训课程';
$this->params['breadcrumbs'][] = ['label' => '培训课程管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
