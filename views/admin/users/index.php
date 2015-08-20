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
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'password',
            'sex',
            'birthday',
            // 'title',
            // 'status',
            // 'credentials_type',
            // 'credentials_number',
            // 'account_location',
            // 'telephone',
            // 'mobile_phone',
            // 'email:email',
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
            // 'credit',
            // 'score',
            // 'create_time',
            // 'update_time',
            // 'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
