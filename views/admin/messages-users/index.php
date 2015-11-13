<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessagesUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if ($searchType == 1) {
    $this->title = '最新公告管理';
} else {
    $this->title = '系统通知管理';
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create','type' => $searchType], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(['action'=>\yii\helpers\Url::to('/Admin/messages-users/del')]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => Html::checkBox('selection_all', false, [
                    'class' => 'select-on-check-all',
                ]),
            ],
            [
                'attribute' => 'users_id',
                'format' => 'html',
                'value'=> function ($searchModel) {
                    return '<a href="/Admin/users/index?UsersSearch[id]=' . $searchModel->users_id . '">' . app\models\Users::getOneUserNameById($searchModel->users_id) . '</a>';
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value'=> function ($searchModel) {
                    return \app\models\MessagesUsers::$statusList[$searchModel->status];
                }
            ],
            [
                'attribute' => 'type',
                'format' => 'html',
                'value'=> function ($searchModel) {
                    return \app\models\Messages::$typeList[$searchModel->type];
                }
            ],
            'content',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <input name="update_status" type="submit" value="删除">
    <?php ActiveForm::end(); ?>
</div>
