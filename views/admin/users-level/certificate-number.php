<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '证书管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-level-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'user_id',
                'value' => function($searchModel){
                    return app\models\Users::getOneUserNameById($searchModel->user_id);
                }
            ],
            [
                'attribute' => 'level_id',
                'value' => function($searchModel){
                    return app\models\Level::getOneLevelNameById($searchModel->level_id);
                }
            ],
            'certificate_number',

             'create_time',
             'update_time',
             'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
