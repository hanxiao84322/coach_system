<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */

$this->title = $model->day;
$this->params['breadcrumbs'][] = ['label' => '考勤管理', 'url' => ['index','AttendanceSearch[train_id]' => $model->train_id, 'AttendanceSearch[user_id]' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'day',
            [
                'attribute'=> 'status',
                'format' => 'html',
                'value' => app\models\Attendance::getStatusName($model->status)

            ]
        ],
    ]) ?>

</div>
