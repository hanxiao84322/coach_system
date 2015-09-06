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
            'label' => '用户', 'url' => ['/Admin/users'],
            'items' => [
                ['label' => '基本信息',
                    'url' => ['/Admin/users']
                ],
                ['label' => '培训信息',
                    'url' => ['/Admin/train-users']
                ],
                ['label' => '活动信息',
                    'url' => ['/Admin/users-activity']
                ],
                ['label' => '晋升信息',
                    'url' => ['/Admin/users-level']
                ]
            ]
        ],
        ['label' => '讲师', 'url' => ['/Admin/teachers']],
        ['label' => '级别', 'url' => ['/Admin/level']],
        ['label' => '培训课程', 'url' => ['/Admin/train'],
            'items' => [
                ['label' => '培训课程信息管理',
                    'url' => ['/Admin/train']
                ],
                ['label' => '评分管理',
                    'url' => ['/Admin/train-users']
                ],
                ['label' => '讲师管理',
                    'url' => ['/Admin/train-teachers']
                ],
                ['label' => '考勤信息',
                    'url' => ['/Admin/train-users/attendance']
                ]
            ]
        ],
        ['label' => '活动', 'url' => ['/Admin/activity']],
        ['label' => '内容', 'url' => ['/Admin/pages']],
        [
            'label' => '新闻管理', 'url' => ['/Admin/news'],
            'items' => [
                ['label' => '分类',
                    'url' => ['/Admin/news-category']
                ],
                ['label' => '新闻',
                    'url' => ['/Admin/news']
                ]
            ]
        ],
        ['label' => '配置', 'url' => ['/Admin/configuration']],
        [
            'label' => '管理员管理', 'url' => ['/Admin/admin'],
            'items' => [
                ['label' => '权限组',
                    'url' => ['/Admin/admin-group']
                ],
                ['label' => '管理员',
                    'url' => ['/Admin/admin']
                ]
            ]
        ],
            Yii::$app->admin->isGuest ?
            ['label' => '登陆', 'url' => ['/Admin/site/login']] :
            [
                'label' => '登出 (' . Yii::$app->admin->identity->username . ')',
                'url' => ['/Admin/site/logout'],
                'linkOptions' => ['data-method' => 'post'],
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
