<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>登录</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="login_top">
    <h1 class="fl"><img src="/images/logo.jpg" /></h1>
    <p class="login_two"><a href="<?= Url::to('/home/index')?>">教练员管理系统</a> | <a href="javascript:;">欢迎登陆</a></p>
</div>
<?php $form = ActiveForm::begin([
    'id'=>'login',
    'enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/user/login')
]); ?>
<div class="login">
    <div class="login_top1">
        <div class="login_set">
        	<div class="Newbottom">
            <input type="text" placeholder="邮箱/已验证手机" class="w263" name="username">
            <input type="password" placeholder="密码" class="w2631" name="password">
            <p class="ph40"><span><b><input type="checkbox" value="1" name="rememberMe" checked="" /></b>自动登陆</span><a href="<?= Url::to('/find-password/index')?>">忘记密码？</a></p>
            <input type="submit" value="登 陆" class="loginbj">
            <p class="p_attent"><span>已注册学员或教练员可通过手机及邮箱登陆</span><a href=" <a href="<?= Url::to(['/pages/view', 'id' => 2])?>">帮助</a> | <a href=" <a href="<?= Url::to(['/pages/view', 'id' => 4])?>">联系我们</a> </p>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<div class="login_footer">
    <p><a href="<?= Url::to('/home/index')?>">首页</a>  |  <a href="<?= Url::to('/news/index')?>">最新动态</a>  | <a href="<?= Url::to('/train/index')?>"> 培训报名</a>  |  <a href="<?= Url::to(['/news/train','level_id' => 2])?>">培训风采 </a> | <a href="<?= Url::to('/user/register-coach')?>"> 教练员注册</a>  | <a href="<?= Url::to('/user/index')?>"> 教练员专栏</a>  | <a href="<?= Url::to(['/pages/view', 'id' => 1])?>"> 政策法规</a>  | <a href="http://www.bj-fa.org.cn/" target="_blank"> 足协官网</a>  | <a href="<?= Url::to(['/pages/view', 'id' => 2])?>"> 帮助中心</a> | <a href="<?= Url::to(['/pages/view', 'id' => 6])?>"> 关于本站</a></p>
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持

</div>
</body>
</html>
