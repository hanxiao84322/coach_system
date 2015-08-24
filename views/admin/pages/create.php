<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = '创建内容';
$this->params['breadcrumbs'][] = ['label' => '内容管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
