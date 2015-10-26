<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = '创建讲师';
$this->params['breadcrumbs'][] = ['label' => '讲师管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
