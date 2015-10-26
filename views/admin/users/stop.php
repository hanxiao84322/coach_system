<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '暂停学员';
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

            'username',
            [
                'attribute' => 'email_auth',
                'value' => function($searchModel){
                    return $searchModel->email_auth ? '是' : '否';
                }
            ],
            [
                'attribute' => 'phone_auth',
                'value' => function($searchModel){
                    return $searchModel->phone_auth ? '是' : '否';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($searchModel){
                    return app\models\Users::getStatusName($searchModel->status);
                }
            ],
            'create_time',
             'update_time',
             'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
