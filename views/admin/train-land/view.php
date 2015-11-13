<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TrainLand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '培训地管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-land-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            'contacts',
            'contact_phone',
            [
                'attribute' => 'site_type',
                'value'=> app\models\TrainLand::$typeList[$model->site_type]
            ],
            [
                'attribute' => 'district',
                'value'=> app\models\TrainLand::$districtList[$model->district]
            ],
            'bus',
            'site',
            'content',
            [
                'attribute' => 'thumb',
                'format' => 'html',
                'value' => $model->thumb ? '<img src="/upload/images/train_land/thumb/'. $model->thumb . '">' : '无'
            ],
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
