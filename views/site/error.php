<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = $name;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>注册成功</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    <script language="JavaScript">
        function myrefresh()
        {
            history.back(-1);
        }
        setTimeout('myrefresh()',5000); //指定1秒刷新一次
    </script>
</head>

<body>
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
        <p class="fr login_box"><a href="<?php if (Yii::$app->admin->isGuest) {?><a href="<?= Url::to('/user/login')?>">登录</a><?php } else { ?><a href="<?= Url::to('/user/logout')?>">登出</a><?php }?>">登录</a> | <a href="javascript:;">加入收藏</a></p>
    </div>
</div>
<!--top-->
<!--logo search-->
<div class="logo_search">
    <h1 class="fl"><a href="<?= Url::to('/home/index')?>"><img src="/images/logo.jpg" /></a></h1>
    <div class="fr search_system">
        教练员注册管理系统<span></span>
    </div>
</div>
<!--logo search-->
<!--banner-->
<div class="bjsj_register">
    <div class="div_register1">
        <p class="login_infro"><span>温馨提示</span></p>
        <p class="success_set"><span> <img src="/images/error.jpg" /><?= nl2br(Html::encode($message)) ?></span></p>
        <p class="login_infro1"><span name="second">五</span>秒钟后返回上一页，如果没有跳转请点击<a href="javascript:history.back(-1);">这里</a>返回，谢谢</p>

    </div>
</div>
<!--banner-->