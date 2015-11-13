<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrainLand */

$this->title = '新建培训地';
$this->params['breadcrumbs'][] = ['label' => '培训地管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-land-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
