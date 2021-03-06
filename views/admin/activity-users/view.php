<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityUsers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '评分管理', 'url' => ['index']];

?>
<div class="activity-users-view">

    <h1>评分</h1>

    <p>
        <?= Html::a('评分', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'attribute' => 'activity_id',
                'format' => 'html',
                'value' => '<a href="/Admin/activity/index?ActivitySearch[id]='.$model->activity_id.'" target="_blank" style="width:300px">' . $model->activityName.'</a>'
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => '<a href="/Admin/users/index?UsersSearch[id]='.$model->user_id.'" target="_blank" style="width:300px">' . $model->userName.'</a>'
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => app\models\ActivityUsers::$statusList[$model->status]
            ],
            'practice_score',
            'theory_score',
            'rule_score',
            'score_appraise',
            [
                'attribute' => 'attendance_appraise',
                'format' => 'html',
                'value' => '<a href="/Admin/attendance/index?AttendanceSearch[user_id]='.$model->user_id.'&AttendanceSearch[activity_id]='.$model->activity_id.'" target="_blank" style="width:300px">' . $model->attendance_appraise.'</a>'
            ],
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
