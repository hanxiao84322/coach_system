<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\WebAppAsset;
use yii\helpers\Url;


WebAppAsset::register($this);
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

<!--top-->
<div class="top">
    <div class="time_login">
        <p class="fl" id="time">
            <script language=JavaScript>
                var d, s = "";
                var x = new Array("星期日", "星期一", "星期二","星期三","星期四", "星期五","星期六");
                d = new Date();
                s+=d.getFullYear()+"年"+(d.getMonth() + 1)+"月"+d.getDate()+"日　";
                s+=x[d.getDay()];
                document.writeln(s);
            </script>
        </p>
        <p class="fr login_box"><?php if (Yii::$app->admin->isGuest) {?><a href="<?= Url::to('/user/login')?>">登录</a><?php } else { ?><a href="<?= Url::to('/user-center/index')?>">会员中心</a> | <a href="<?= Url::to('/user/logout')?>">登出</a><?php }?> | <a href="javascript:;">加入收藏</a></p>
    </div>
</div>
<!--top-->
<!--logo search-->
<div class="logo_search">
    <h1 class="fl"><a href="javascript:;"><img src="/images/logo.jpg" /></a></h1>
    <div class="fr search">
        <span>教练员搜索：</span><input type="text" class="input_set" placeholder="输入教练员姓名、身份证号或证书编号" /><input type="submit" value="搜索"  class="search_btn" /><a href="javascript:;" class="top_search">高级搜索</a>
    </div>
</div>
<!--logo search-->
<!--nav-->
<div class="nav_box">
    <ul class="nav">
        <li><a href="<?= Url::to('/home/index')?>" class="hover">首页</a></li>
        <li><a href="<?= Url::to(['/news/index','id' => '2'])?>">最新动态</a></li>
        <li><a href="<?= Url::to('/train/index')?>">培训报名</a></li>
        <li><a href="<?= Url::to(['/news/index','id' => '3'])?>">培训风采</a></li>
        <li><a href="<?= Url::to('/register/coach')?>">教练员注册</a></li>
        <li><a href="<?= Url::to('/coach/index')?>">教练员专区</a></li>
        <li><a href="<?= Url::to(['/news/index','id' => '10'])?>">政策法规</a></li>
        <li><a href="javascript:;">足协官网</a></li>
    </ul>
</div>
<!--nav-->
<?= $content ?>

<!--foooter-->
<div class="footer">
    <p><a href="javascript:;">首页</a>  |  <a href="javascript:;">最新动态</a>  | <a href="javascript:;"> 培训报名</a>  |  <a href="javascript:;">培训风采 </a> | <a href="javascript:;"> 教练员注册</a>  | <a href="javascript:;"> 教练员专栏</a>  | <a href="javascript:;"> 政策法规</a>  | <a href="javascript:;"> 足协官网</a>  | <a href="javascript:;"> 帮助中心</a> | <a href="javascript:;"> 关于本站</a></p>
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持

</div>
<!--foooter-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
