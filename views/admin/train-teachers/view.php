<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TrainTeachers */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => '讲师管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-teachers-view">

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
            [
                'attribute' => 'train_id',
                'format' => 'html',
                'value' => '<a href="/Admin/train/index?TrainSearch[id]='.$model->train_id.'" target="_blank" style="width:300px">' . \app\models\Train::getOneTrainNameById($model->train_id).'</a>'
            ],
            [
                'attribute' => 'teachers_id',
                'format' => 'html',
                'value' => '<a href="/Admin/teachers/index?TeachersSearch[id]='.$model->teachers_id.'" target="_blank" style="width:300px">' . \app\models\Teachers::getOneTeacherNameById($model->teachers_id).'</a>'
            ],
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
