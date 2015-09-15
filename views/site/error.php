<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;


$this->title = $name;
?>
<!--banner-->
<div class="bjsj_register">
    <div class="div_register1">
        <p class="login_infro"><span>温馨提示</span></p>
        <p class="success_set"><span> <img src="/images/error.jpg" width="22" height="22" /><?= nl2br(Html::encode($message)) ?></span></p>
        <p class="login_infro1"><span name="second">五</span>秒钟后返回上一页，如果没有跳转请点击<a href="javascript:history.back(-1);">这里</a>返回，谢谢</p>

    </div>
</div>
<!--banner-->