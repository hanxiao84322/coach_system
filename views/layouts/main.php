<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '教练员晋升管理系统',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => '用户管理', 'url' => ['/Admin/users'],
            'items' => [
                ['label' => '基本信息',
                    'url' => ['/Admin/users']
                ],
                ['label' => '培训信息',
                    'url' => ['/Admin/usersTrain']
                ],
                ['label' => '活动信息',
                    'url' => ['/Admin/usersActivity']
                ],
                ['label' => '晋升信息',
                    'url' => ['/Admin/usersLevel']
                ]
            ]
        ],
        ['label' => '级别管理', 'url' => ['/Admin/level']],
        ['label' => '培训课程管理', 'url' => ['/Admin/train']],
        ['label' => '活动管理', 'url' => ['/Admin/activity']],
        ['label' => '内容管理', 'url' => ['/Admin/pages']],
        [
            'label' => '新闻管理', 'url' => ['/Admin/news'],
            'items' => [
                ['label' => '分类',
                    'url' => ['/Admin/newscategory']
                ],
                ['label' => '新闻',
                    'url' => ['/Admin/news']
                ]
            ]
        ],
        Yii::$app->user->isGuest ?
            ['label' => '登陆', 'url' => ['/Admin/login']] :
            [
                'label' => '登出 (' . Yii::$app->user->identity->username . ')',
                'url' => ['/Admin/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],

    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
