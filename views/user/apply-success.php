<?php
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
        教练员管理系统
    </div>
</div>
<!--logo search-->
<div class="pxmobSet" style="background:url(/images/Npxbm.jpg) no-repeat center top;height:119px;"></div>

<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="rgsd_box_set">
            <p class="registStep" style="text-align:center;margin-top:25px;"><img src="/images/registStep6.jpg" /></p>
            <!--banner-->
                <div class="div_register1">
                    <p class="login_infro1">【 <?= Yii::$app->user->identity->username?> 您是：第<?= $data['orders']?>位  报名申请<?= $data['trainName']?>  】</p>
                    <p class="success_set"><span> <img src="/images/success.jpg" />完成申请！！！	欢迎报名参加<?= $data['trainName']?></span></p>
                    <p class="success_infro"><span>我们将在7-14个工作日审核您的信息，并将通过您预留的联系方式反馈报名申请信息结果，尽请留意查看！</span>您的电话为：<?= Yii::$app->user->identity->mobile_phone ?>，电子邮件为：<?= Yii::$app->user->identity->email?><br />
                        您也可登陆 <a href="<?= \yii\helpers\Url::to('/user-center/index')?>">个人管理</a> 页面进行相关操作！
                        <b>如系统30秒之内无法自动跳转，请点击<a href="<?= \yii\helpers\Url::to('/user-center/index')?>">这里</a> !</b></p>
                </div>
            <!--banner-->


        </div>
    </div>
</div>
<!--content-->