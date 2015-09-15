<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersPlayers */

$this->title = 'Create Users Players';
$this->params['breadcrumbs'][] = ['label' => 'Users Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-players-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
