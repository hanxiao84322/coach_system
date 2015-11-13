<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MessagesUsers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '站内消息管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'users_id',
                'format' => 'html',
                'value' => '<a href="/Admin/users/index?UsersSearch[id]='.$model->users_id.'" target="_blank" style="width:300px">' . \app\models\Users::getOneUserNameById($model->users_id).'</a>'
            ],
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => app\models\Messages::$typeList[$model->type]
            ],
            [
                'attribute' => 'content',
                'format' => 'html',
                'value' => $model->content
            ],
        ],
    ]) ?>

</div>
