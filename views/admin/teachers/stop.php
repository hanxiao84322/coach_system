<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '暂停讲师';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'status',
                'value' => function($searchModel){
                    return app\models\Teachers::getStatusName($searchModel->status);
                }
            ],
//            [
//                'attribute' => 'sex',
//                'value' => function($searchModel){
//                    return app\models\Teachers::getSexName($searchModel->sex);
//                }
//            ],
//            'age',
            [
                'attribute' => 'level',
                'value' => function($searchModel){
                    return app\models\Teachers::getLevelName($searchModel->level);
                }
            ],
            // 'lesson',
             'create_time',
             'create_user',
             'update_time',
             'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
