<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActivityUsers */

$this->title = 'Create Activity Users';
$this->params['breadcrumbs'][] = ['label' => 'Activity Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
