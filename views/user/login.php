<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
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
<div class="logo_search">
    <h1 class="fl"><a href="javascript:;"><img src="/images/logo.jpg" /></a></h1>
    <div class="fr search_system">
        教练员注册管理系统<span>培训报名申请</span>
    </div>
</div>
<!--logo search-->
<?php $form = ActiveForm::begin([
    'id'=>'login',
    'enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/login/login')
]); ?>
<div class="login">
    <div class="login_top1">
        <div class="login_set">
            <input type="text" placeholder="邮箱/已验证手机" class="w263" name="username">
            <input type="password" placeholder="密码" class="w263" name="password">
            <p class="ph40"><span><b><input type="checkbox" value="1" name="rememberMe" checked="" /></b>自动登陆</span><a href="<?= Url::to('/User/find-password')?>">忘记密码？</a></p>
            <input type="submit" value="登 陆" class="loginbj" name="submit">
            <p class="p_attent"><span>已注册学员或教练员可通过手机及邮箱登陆</span><a href="javascript:;">帮助</a> | <a href="javascript:;">联系我们</a> </p>
        </div>
    </div>
</div>
