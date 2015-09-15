<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersVocational */

$this->title = 'Create Users Vocational';
$this->params['breadcrumbs'][] = ['label' => 'Users Vocationals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-vocational-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
