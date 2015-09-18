<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersPlayers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '球员经历管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-players-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'team',
            'begin_time',
            'end_time',
            'level',
            'address',
            'witness',
            'witness_phone',
            'description',
            'create_time',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
