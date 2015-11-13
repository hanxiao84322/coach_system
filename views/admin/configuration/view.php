<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */

$this->title = '更新配置';
$this->params['breadcrumbs'][] = ['label' => '配置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'web_name',
            'contact_email:email',
            'attach_size',
            'keyword',
            'description',
            'copyright',
            'address',
            'contact_phone',
            'icp',
        ],
    ]) ?>

</div>
