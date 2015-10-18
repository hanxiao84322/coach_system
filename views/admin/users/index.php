<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
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
            'mobile_phone',
            'email:email',
            [
                'label' => '查看',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('基本信息', ['Admin/users-info/', 'UsersInfoSearch[user_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('教育经历', ['Admin/users-education/', 'UsersEducationSearch[user_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('培训经历', ['Admin/users-train/', 'UsersTrainSearch[user_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('运动经历', ['Admin/users-players/', 'UsersPlayersSearch[user_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('执教经历', ['Admin/users-vocational/', 'UsersVocationalSearch[user_id]' => $searchModel->id]);
                    return $url;
                }
            ],
            [
                'label' => '管理',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('晋升', ['Admin/users-level/', 'UsersLevelSearch[user_id]' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('活动', ['Admin/ActivityUsers/', 'UserId' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('培训课程', ['Admin/train-users/', 'TrainUsersSearch[user_id]' => $searchModel->id]);
                    return $url;
                }
            ],
             'create_time',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
