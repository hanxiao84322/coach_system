<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '成绩管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="train-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $form = ActiveForm::begin(['action'=>\yii\helpers\Url::to('/Admin/train-users/update-status')]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => Html::checkBox('selection_all', false, [
                    'class' => 'select-on-check-all',
                ]),
            ],
            [
                'attribute' => 'train_id',
                'format' => 'html',
                'value'=> function ($searchModel) {
                    return '<a href="/Admin/train/index?TrainSearch[id]=' . $searchModel->train_id . '" target="_blank" >' . app\models\Train::getOneTrainNameById($searchModel->train_id) . '</a>';
                }
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value'=> function ($searchModel) {
                    return '<a href="/Admin/users/index?UsersSearch[id]=' . $searchModel->user_id . '" target="_blank" >' . app\models\Users::getOneUserNameById($searchModel->user_id) . '</a>';
                }
            ],
            [
                'attribute' => 'status',
                'value'=> function ($searchModel) {
                    return app\models\TrainUsers::$statusList[$searchModel->status];
                }
            ],
            'practice_score',
             'theory_score',
             'rule_score',
             'score_appraise',
            [
                'attribute' => 'attendance_appraise',
                'format' => 'html',
                'value' => function ($searchModel) {
                    return '<a href="/Admin/attendance/index?AttendanceSearch[user_id]=' . $searchModel->user_id . '&AttendanceSearch[train_id]=' . $searchModel->train_id . '" target="_blank" style="width:300px">' . $searchModel->attendance_appraise . '</a>';
                }
            ],
            // 'practice_comment',
            // 'theory_comment',
            // 'rule_comment',
            // 'total_comment',
            // 'result_comment',
            // 'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <select name="status">
        <?php foreach ($statusList as $key => $val) :?>
            <option value="<?= $key?>"><?= $val?></option>
        <?php endforeach;?>
    </select>
    <input name="update_status" type="submit" value="修改状态">
    <?php ActiveForm::end(); ?>

</div>
