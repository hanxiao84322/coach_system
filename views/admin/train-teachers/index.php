<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainTeachersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '培训讲师管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-teachers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'train_id',
                'value'=> function ($searchModel) {
                    return app\models\Train::getOneTrainNameById($searchModel->train_id);
                }
            ],
            [
                'attribute' => 'teachers_id',
                'value'=> function ($searchModel) {
                    return app\models\Teachers::getOneTeacherNameById($searchModel->teachers_id);
                }
            ],
            'create_time',
            'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
