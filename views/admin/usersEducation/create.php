<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersEducation */

$this->title = 'Create Users Education';
$this->params['breadcrumbs'][] = ['label' => 'Users Educations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-education-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
