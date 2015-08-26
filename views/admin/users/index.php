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

    <p>
        <?= Html::a('新建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            [
                'attribute' => 'status',
                'value' => function($searchModel){
                    return app\models\Users::getStatusName($searchModel->status);
                }
            ],
            // 'credentials_type',
            // 'credentials_number',
            // 'account_location',
            // 'telephone',
            // 'mobile_phone',
             'email:email',
            // 'height',
            // 'weight',
            // 'disease_history',
            // 'contact_address',
            // 'contact_postcode',
            // 'company_name',
            // 'company_address',
            // 'company_postcode',
            // 'company_contact_phone',
            // 'clothes_size',
            // 't_shirt_size',
            // 'shorts_size',
            // 'language',
            // 'spoken_language',
            // 'write_language',
            // 'lesson',
            [
                'label' => '查看',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('教育经历', ['Admin/usersEducation/', 'UserId' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('培训经历', ['Admin/usersTrain/', 'UserId' => $searchModel->id]).'<br>';
                    $url .= Html::a('运动经历', ['Admin/usersPlayers/', 'UserId' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('执教经历', ['Admin/usersVocational/', 'UserId' => $searchModel->id]);
                    return $url;
                }
            ],
            [
                'label' => '管理',
                'format' => 'html',
                'value' => function($searchModel) {
                    $url = Html::a('晋升', ['Admin/UsersLevel/', 'UserId' => $searchModel->id]);
                    $url .= '&nbsp;'.Html::a('活动', ['Admin/ActivityUsers/', 'UserId' => $searchModel->id]).'<br>';
                    $url .= Html::a('培训课程', ['Admin/TrainUsers/', 'UserId' => $searchModel->id]);
                    return $url;
                }
            ],
            // 'score',
             'create_time',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
