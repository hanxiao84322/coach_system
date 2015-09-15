<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityUsers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activity Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'activity_id',
            'user_id',
            'status',
            'practice_score',
            'theory_score',
            'rule_score',
            'score_appraise',
            'attendance_appraise',
            'practice_comment',
            'theory_comment',
            'rule_comment',
            'total_comment',
            'result_comment',
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
