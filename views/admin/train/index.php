<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '培训课程';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建培训课程', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'category',
                'value' => function($searchModel){
                    return app\models\TrainCategory::getNameById($searchModel->category);
                }
            ],
            [
                'attribute' => 'level_id',
                'value'=> function ($searchModel) {
                    return app\models\Level::getOneLevelNameById($searchModel->level_id);
                }
            ],
            [
                'attribute' => 'status',
                'value'=> function ($searchModel) {
                    return app\models\Train::getStatusName($searchModel->status);
                }
            ],
            [
                'label' => '管理',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('讲师管理', ['Admin/train-teachers', 'TrainTeachersSearch[train_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('添加讲师', ['Admin/train-teachers/create', 'train_id' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('学员', ['Admin/train-users/', 'TrainUsersSearch[train_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('考勤', ['Admin/train-users/attendance', 'train_id' => $searchModel->id]).'<br>';
                    return $url;
                }
            ],
            //            'recruit_count',
            // 'sign_up_begin_time',
            // 'sign_up_end_time',
            // 'sign_up_status',
            // 'begin_time',
            // 'end_time',
            // 'status',
            // 'lesson',
            // 'address',
            // 'content:ntext',
             'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
