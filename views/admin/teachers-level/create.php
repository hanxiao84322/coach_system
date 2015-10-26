<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TeachersLevel */

$this->title = '创建讲师角色';
$this->params['breadcrumbs'][] = ['label' => '讲师角色设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
