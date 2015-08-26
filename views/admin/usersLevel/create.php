<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */

$this->title = 'Create Users Level';
$this->params['breadcrumbs'][] = ['label' => 'Users Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
