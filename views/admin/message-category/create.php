<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MessageCategory */

$this->title = 'Create Message Category';
$this->params['breadcrumbs'][] = ['label' => 'Message Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
