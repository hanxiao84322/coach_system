<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActivityCategory */

$this->title = '创建活动类别';
$this->params['breadcrumbs'][] = ['label' => '创建活动类别', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
