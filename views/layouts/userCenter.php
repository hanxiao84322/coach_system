<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link href="/css/user_center.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="/js/self.js"></script>
</head>
<body>

<div class="user_box">
    <div class="user_top">
        <h1 class="fl logo_h1"><img src="/images/user/logo.jpg" /></h1>
        <p class="fl font28">教练员注册管理系统</p>
        <a href="<?= Url::to('/user/logout')?>" class="quit_box">退出登录</a>
    </div>
    <div class="user_nav">
        <div class="max_width" style="padding:0 0 0 40px;max-width:1160px;height:50px;">
            <a href="<?= Url::to('/user-center/index')?>" class="user_fixed">个人管理中心</a>
            <a href="<?= Url::to('/home/index')?>" class="home">首页</a>
            <a href="<?= Url::to('/user-center/help')?>" class="help">帮助</a>
        </div>
    </div>
</div>
<?= $content ?>
</body>
</html>
