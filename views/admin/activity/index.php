<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建活动', ['create'], ['class' => 'btn btn-success']) ?>
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
                    return app\models\Train::getCategoryName($searchModel->category);
                }
            ],
            [
                'attribute' => 'level_id',
                'value'=> function ($searchModel) {
                    return app\models\Level::getOneLevelNameById($searchModel->level_id);
                }
            ],
            'recruit_count',
            [
                'label' => '管理',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('教练', ['Admin/ActivityUsers/', 'id' => $searchModel->id]);
                    return $url;
                }
            ],
            // 'sign_up_begin_time',
            // 'sign_up_end_time',
            // 'sign_up_status',
            // 'begin_time',
            // 'end_time',
            // 'status',
            // 'content:ntext',
            // 'lesson',
            // 'integration',
            // 'address',
            // 'launch',
            // 'organizers',
            // 'join_teams',
            // 'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
