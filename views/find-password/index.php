<?php
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>找回密码</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#get_check_num").click(function () {
                $.get("/find-password/get-check-num?phone=" +<?= $data['phone']?>, function (data) {
                    alert(data);
                });
            });

            var test = {
                node: null,
                count: 60,
                start: function () {
                    //console.log(this.count);
                    if (this.count > 0) {
                        this.node.innerHTML = this.count--;
                        var _this = this;
                        setTimeout(function () {
                            _this.start();
                        }, 1000);
                    } else {
                        this.node.removeAttribute("disabled");
                        this.node.innerHTML = "再次发送";
                        this.count = 60;
                    }
                },
                //初始化
                init: function (node) {
                    this.node = node;
                    this.node.setAttribute("disabled", true);
                    this.start();
                }
            };
        });
    </script>
</head>

<body>
<div class="login_top">
    <h1 class="fl"><img src="/images/logo.jpg"/></h1>

    <p class="login_two"><a href="<?= \yii\helpers\Url::to('/home/index') ?>">教练员管理系统</a> | <a
            href="<?= \yii\helpers\Url::to('/find-password/index') ?>">找回密码</a></p>
</div>
<?php if ($data['step'] == 1) { ?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="login" style="padding-top:84px;height:510px;">
        <div class="findPassword"
             style="width:823px;height:436px;background:url(../images/Newpabj.jpg) no-repeat;margin:0 auto;padding-top:45px;">
            <div class="stepBox"><img src="/images/step1.png"/></div>
            <div class="padNew">
                <table cellpadding="0" cellspacing="0" class="newsTable">
                    <tr>
                        <td valign="top" style="line-height:34px;">账户名：</td>
                        <td><input type="text" name="username" value="已验证手机/邮箱" class="w185" onfocus="this.value = '';"
                                   onblur="if (this.value == '') {this.value = '已验证手机/邮箱';}"/><b>请输入您的验证手机或邮箱</b></td>
                    </tr>
                    <tr>
                        <?= Captcha::widget(['name' => 'verifyCode', 'captchaAction'=>'find-password/captcha','imageOptions' => ['title' => '换一个', 'alt' => '换一个'], 'template' => '<td align="right">验证码：</td><td><input type="text" class="w188" name="verifyCode" /><div class="col-lg-3">{image}</div></td>']); ?>

                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="提 交" class="tjButton"/></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

<?php } elseif ($data['step'] == 2) { ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="login" style="padding-top:84px;height:510px;">
        <div class="findPassword">
            <div class="stepBox"><img src="/images/step2.png" /></div>
            <div class="padNew1">
                <table cellpadding="0" cellspacing="0" class="newsTable">
                    <tr>
                        <td valign="top" align="right" style="line-height:34px;">请选择验证身份方式：</td>
                        <td><select class="w185"><option value="1">已验证手机</option><option value="2">已验证手机</option></select></td>
                    </tr>
                    <tr>
                        <td valign="top" align="right" style="line-height:34px;">姓名：</td>
                        <td><?= $data['username']?></td>
                    </tr>
                    <tr>
                        <td valign="top" align="right" style="line-height:34px;">已验证手机：</td>
                        <td><?= $data['phoneHidden']?></td>
                    </tr>
                    <tr>
                        <td valign="top" align="right" style="line-height:34px;">请填写手机校验码：</td>
                        <td><p style="height:45px;"><input type="text" class="w185 fl" name="check_num" /><input type="button"
                                                                                                                 value="获取短信校验码"
                                                                                                                 id="get_check_num"
                                                                                                                 name="get_check_num"
                                                                                                                 class="w215se"></p><b>校验码已发出，请注意查收短信，如果没有收到，你可以在<i>120</i>秒后要求系统重新发送</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="提 交" class="tjButton" /></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
<?php } elseif ($data['step'] == 3) { ?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="login" style="padding-top:84px;height:510px;">
        <div class="findPassword">
            <div class="stepBox"><img src="/images/step3.png" /></div>
            <div class="padNew">
                <table cellpadding="0" cellspacing="0" class="newsTable">
                    <tr>
                        <td valign="top" style="line-height:34px;">真是姓名：</td>
                        <td><input type="text" name="username" value="" class="w185" /><b>请输入您注册时的真是姓名</b></td>
                    </tr>
                    <tr>
                        <td valign="top" style="line-height:34px;">新登录密码：</td>
                        <td><input type="password" value="" name="password" class="w185" /><b>由字母加数字或符号至少两种以上字符组成的6-20位半角字符，区分大小写。</b></td>
                    </tr>
                    <tr>
                        <td valign="top" style="line-height:34px;">确认新密码：</td>
                        <td><input type="password" value="" class="w185" name="password_confirm" /><b>请再次输入新密码</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="提 交" class="tjButton" /></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
<?php } else { ?>
    <div class="login" style="padding-top:84px;height:510px;">
        <div class="findPassword">
            <div class="stepBox"><img src="/images/step4.png" /></div>
            <div class="padNew">
                <p class="Newsuccess"><img src="/images/Newsuccess.jpg" /> 新密码设置成功！</p>
                <p class="passWsu">请牢记您设置的密码。<a href="<?= Url::to('/home/index')?>">返回首页</a></p>
            </div>
        </div>
    </div>
<?php }?>

<!--foooter-->
<div class="footer">
    <p><a href="<?= Url::to('/home/index')?>">首页</a>  |  <a href="<?= Url::to('/news/index')?>">最新动态</a>  | <a href="<?= Url::to('/train/index')?>"> 培训报名</a>  |  <a href="<?= Url::to(['/news/train','level_id' => 2])?>">培训风采 </a> | <a href="<?= Url::to('/user/register-coach')?>"> 教练员注册</a>  | <a href="<?= Url::to('/user/index')?>"> 教练员专栏</a>  | <a href="<?= Url::to(['/news/list', 'id' => 10])?>"> 政策法规</a>  | <a href="http://www.bj-fa.org.cn/" target="_blank"> 足协官网</a>  | <a href="<?= Url::to(['/pages/view', 'id' => 2])?>"> 帮助中心</a> | <a href="<?= Url::to(['/pages/view', 'id' => 6])?>"> 关于本站</a></p>
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持

</div>
<!--foooter-->
</body>
</html>
