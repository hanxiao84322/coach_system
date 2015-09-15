<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户基本信息管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'sex',
            'birthday',
            // 'credentials_type',
             'credentials_number',
            // 'account_loaction',
            // 'telephone',
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
            // 'writh_language',
            // 'photo',
            // 'credentials_photo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
