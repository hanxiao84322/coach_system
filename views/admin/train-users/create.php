<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrainUsers */

$this->title = 'Create Train Users';
$this->params['breadcrumbs'][] = ['label' => 'Train Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
