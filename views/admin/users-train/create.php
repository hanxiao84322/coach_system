<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersTrain */

$this->title = 'Create Users Train';
$this->params['breadcrumbs'][] = ['label' => 'Users Trains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-train-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
