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
        'brandLabel' => '教练员晋升系统',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => '系统设置', 'url' => ['/Admin/admin'],
            'items' => [
                [
                    'label' => '管理员角色',
                    'url' => ['/Admin/admin']
                ],
                [
                    'label' => '附件设置',
                    'url' => ['/Admin/configuration/attachments']
                ],
                [
                    'label' => '邮件设置',
                    'url' => ['/Admin/configuration/email']
                ],
                [
                    'label' => '全站功能管理',
                    'url' => ['/Admin/configuration/all-setting']
                ],
                [
                    'label' => '站点设置',
                    'url' => ['/Admin/configuration/web-setting']
                ],
                [
                    'label' => '登陆设置',
                    'url' => ['/Admin/configuration/login-setting']
                ]
            ]
        ],
        [
            'label' => '工具', 'url' => ['/Admin/tools/clear'],
            'items' => [
                [
                    'label' => '更新缓存',
                    'url' => ['/Admin/tools/clear']
                ],
                [
                    'label' => '数据库备份',
                    'url' => ['/Admin/tools/backup']
                ],
                [
                    'label' => '上传文件管理',
                    'url' => ['/Admin/tools/attachments']
                ],
                [
                    'label' => '运行记录',
                    'url' => ['/Admin/tools/run-log']
                ]
            ]
        ],
        [
            'label' => '信息发布', 'url' => ['/Admin/news-category'],
            'items' => [
                [
                    'label' => '栏目管理',
                    'url' => ['/Admin/news-category']
                ],
                [
                    'label' => '文章列表操作',
                    'url' => ['/Admin/news']
                ],
                [
                    'label' => '添加文章',
                    'url' => ['/Admin/news/create']
                ]
            ]
        ],
        [
            'label' => '学员管理', 'url' => ['/Admin/users'],
            'items' => [
                [
                    'label' => '学员角色设置',
                    'url' => ['/Admin/level']
                ],
                [
                    'label' => '学员列表操作',
                    'url' => ['/Admin/users']
                ],
                [
                    'label' => '添加学员',
                    'url' => ['/Admin/users/create']
                ],
                [
                    'label' => '成绩管理',
                    'url' => ['/Admin/train-users']
                ],
                [
                    'label' => '分值管理',
                    'url' => ['/Admin/activity-users']
                ],
                [
                    'label' => '证书管理',
                    'url' => ['/Admin/users-level/certificate-number']
                ],
                [
                    'label' => '发布信息管理',
                    'url' => ['/Admin/users/news']
                ],
                [
                    'label' => '晋升管理',
                    'url' => ['/Admin/users-level']
                ],
                [
                    'label' => '暂停学员',
                    'url' => ['/Admin/users/stop']
                ]
            ]
        ],
        [
            'label' => '讲师管理', 'url' => ['/Admin/teachers'],
            'items' => [
                [
                    'label' => '讲师角色设置',
                    'url' => ['/Admin/teachers-level']
                ],
                [
                    'label' => '讲师列表操作',
                    'url' => ['/Admin/teachers']
                ],
                [
                    'label' => '讲师评分管理',
                    'url' => ['/Admin/teachers-score']
                ],
                [
                    'label' => '发布信息管理',
                    'url' => ['/Admin/teachers/news']
                ],
                [
                    'label' => '暂停讲师',
                    'url' => ['/Admin/teachers/stop']
                ]
            ]
        ],
        [
            'label' => '班课管理', 'url' => ['/Admin/train'],
            'items' => [
                [
                    'label' => '班型级别设置',
                    'url' => ['/Admin/level']
                ],
                [
                    'label' => '班型类别设置',
                    'url' => ['/Admin/train-category']
                ],
                [
                    'label' => '培训地管理',
                    'url' => ['/Admin/train-land']
                ],
                [
                    'label' => '培训课程管理',
                    'url' => ['/Admin/train']
                ],
                [
                    'label' => '考勤管理',
                    'url' => ['/Admin/train-users/attendance']
                ],
            ]
        ],
        [
            'label' => '活劢管理', 'url' => ['/Admin/activity'],
            'items' => [
                [
                    'label' => '活劢级别设置',
                    'url' => ['/Admin/level']
                ],
                [
                    'label' => '活劢类别设置',
                    'url' => ['/Admin/activity-category']
                ],
                [
                    'label' => '活劢地管理',
                    'url' => ['/Admin/activity-land']
                ],
                [
                    'label' => '活劢管理',
                    'url' => ['/Admin/activity']
                ],
                [
                    'label' => '活劢评分管理',
                    'url' => ['/Admin/activity-users']
                ],
            ]
        ],
        [
            'label' => '财务管理', 'url' => ['/Admin/orders'],
            'items' => [
                [
                    'label' => '订单审核',
                    'url' => ['/Admin/orders/check']
                ],
                [
                    'label' => '缴费管理',
                    'url' => ['/Admin/orders']
                ],
                [
                    'label' => '财务汇总',
                    'url' => ['/Admin/orders/collect']
                ]
            ]
        ],
        [
            'label' => '站内消息', 'url' => ['/Admin/messages'],
            'items' => [
                [
                    'label' => '最新公告',
                    'url' => ['/Admin/messages?messageSearch[type]=1']
                ],
                [
                    'label' => '系统通知',
                    'url' => ['/Admin/messages?messageSearch[type]=2']
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
