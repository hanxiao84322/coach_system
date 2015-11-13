<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\WebAppAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

WebAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>教练员管理系统</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=2c327dae2b9abd9727b0e8da3d988040"></script>
    
    <?php $this->head() ?>
<script type="text/javascript" src="/js/self.js"></script>
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
        <p class="fr login_box"><?php if (Yii::$app->user->isGuest) {?><a href="<?= Url::to('/login/login')?>">登录</a><?php } else { ?><a href="<?= Url::to('/user-center/index')?>">会员中心</a> | <a href="<?= Url::to('/user/logout')?>">登出</a><?php }?> | <a href="javascript:;">加入收藏</a></p>
    </div>
</div>
<!--top-->
<!--logo search-->
<?php $form = ActiveForm::begin([
    'id'=>'registerInfo',
    'enableAjaxValidation' => false,
    'action' => \yii\helpers\Url::to('/search/index'),
    'method' => 'get'
]); ?>
<div class="logo_search">
    <h1 class="fl"><a href="javascript:;"><img src="/images/logo.jpg" /></a></h1>
    <div class="fr search">
        <span>教练员搜索：</span><input type="text" name="keyword" class="input_set" placeholder="输入教练员姓名、身份证号或证书编号" /><input type="submit" value="搜索"  class="search_btn" /><a href="<?= Url::to('/top-search/index')?>" class="top_search">高级搜索</a>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!--logo search-->
<!--nav-->
<div class="nav_box">
    <ul class="nav">
        <li><a href="<?= Url::to('/home/index')?>">首页</a></li>
        <li><a href="<?= Url::to('/news/index')?>" <?php if (Yii::$app->controller->id == 'news'  && Yii::$app->controller->action->id =='index') {?>class="hover"<?php }?>>最新动态</a></li>
        <li><a href="<?= Url::to('/train/index')?>" <?php if (Yii::$app->controller->id == 'train') {?>class="hover"<?php }?>>培训报名</a></li>
        <li><a href="<?= Url::to(['/news/train','level_id' => 2])?>" <?php if ((Yii::$app->controller->id == 'news' && Yii::$app->controller->action->id =='train') || Yii::$app->controller->id =='train-land') {?>class="hover"<?php }?>>培训风采</a></li>
        <li><a href="<?= Url::to('/user/register-coach')?>"<?php if (Yii::$app->controller->id == 'user' && Yii::$app->controller->action->id == 'register-coach') {?>class="hover"<?php }?>>教练员注册</a></li>
        <li><a href="<?= Url::to('/user/index')?>"<?php if (Yii::$app->controller->id == 'user' && Yii::$app->controller->action->id == 'index') {?>class="hover"<?php }?>>教练员专区</a></li>
        <li><a href="<?= Url::to(['/news/list', 'category_id' => 10])?>" <?php if (Yii::$app->controller->id == 'news' && Yii::$app->controller->action->id == 'list') {?>class="hover"<?php }?>>政策法规</a></li>
        <li><a href="http://www.bj-fa.org.cn/" target="_blank">足协官网</a></li>
    </ul>
</div>
<!--nav-->
<?= $content ?>

<!--foooter-->
<div class="footer">
    <p><a href="<?= Url::to('/home/index')?>">首页</a>  |  <a href="<?= Url::to('/news/index')?>">最新动态</a>  | <a href="<?= Url::to('/train/index')?>"> 培训报名</a>  |  <a href="<?= Url::to(['/news/train','level_id' => 2])?>">培训风采 </a> | <a href="<?= Url::to('/user/register-coach')?>"> 教练员注册</a>  | <a href="<?= Url::to('/user/index')?>"> 教练员专栏</a>  | <a href="<?= Url::to(['/news/list', 'id' => 10])?>"> 政策法规</a>  | <a href="http://www.bj-fa.org.cn/" target="_blank"> 足协官网</a>  | <a href="<?= Url::to(['/pages/view', 'id' => 2])?>"> 帮助中心</a> | <a href="<?= Url::to(['/pages/view', 'id' => 6])?>"> 关于本站</a></p>
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持

</div>
<!--foooter-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
