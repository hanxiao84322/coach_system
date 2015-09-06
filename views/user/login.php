<?php
use yii\helpers\Url;
?>
<div class="login_top">
    <h1 class="fl"><img src="/images/logo.jpg" /></h1>
    <p class="login_two"><a href=""<?= Url::to('/home/index')?>">教练员管理系统</a> | <a href=""<?= Url::to('/user/login')?>">欢迎登陆</a></p>
</div>
<?php
use yii\bootstrap\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'id'=>'login',
    'enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/user/login')
]); ?>
<div class="login">
    <div class="login_top1">
        <div class="login_set">
            <input type="text" placeholder="邮箱/已验证手机" class="w263" name="username">
            <input type="password" placeholder="密码" class="w263" name="password">
            <p class="ph40"><span><b><input type="checkbox" value="1" name="rememberMe" checked="" /></b>自动登陆</span><a href="javascript:;">忘记密码？</a></p>
            <input type="submit" value="登 陆" class="loginbj" name="submit">
            <p class="p_attent"><span>已注册学员或教练员可通过手机及邮箱登陆</span><a href="javascript:;">帮助</a> | <a href="javascript:;">联系我们</a> </p>
        </div>
    </div>
</div>
