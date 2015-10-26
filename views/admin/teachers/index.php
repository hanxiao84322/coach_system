<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeachersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '讲师管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建讲师', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'sex',
                'value' => function($searchModel){
                    return app\models\Teachers::getSexName($searchModel->sex);
                }
            ],
            'age',
            [
                'attribute' => 'level',
                'value' => function($searchModel){
                    return app\models\TeachersLevel::getNameById($searchModel->level);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($searchModel){
                    return app\models\Teachers::getStatusName($searchModel->status);
                }
            ],
            // 'lesson',
            // 'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
