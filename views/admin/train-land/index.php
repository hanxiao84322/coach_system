<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainLandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '培训地管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-land-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建培训地', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'address',
            'contacts',
            'contact_phone',
            [
                'attribute' => 'site_type',
                'value' => function($searchModel){
                    return app\models\TrainLand::$typeList[$searchModel->site_type];
                }
            ],
            [
                'attribute' => 'district',
                'value' => function($searchModel){
                    return app\models\TrainLand::$districtList[$searchModel->district];
                }
            ],
            // 'site',
            // 'content',
             'create_time',
            // 'create_user',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
