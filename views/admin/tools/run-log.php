<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Train */

$this->title = '运行记录';
$this->params['breadcrumbs'][] = ['label' => '工具', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-view">

    <h1><?= Html::encode($this->title) ?></h1>

    本站已安全运行了:<span class="smalltxt">
   <SCRIPT language=javascript><!--
       BirthDay=new Date("may 20,2015");
       today=new Date();
       timeold=(today.getTime()-BirthDay.getTime());
       sectimeold=timeold/1000
       secondsold=Math.floor(sectimeold);
       msPerDay=24*60*60*1000
       e_daysold=timeold/msPerDay
       daysold=Math.floor(e_daysold);
       document.write("<font color=red>"+daysold+"</font>天 !");
       //-->
   </SCRIPT>
        <br>
        系统类型：<?= php_uname('s')?>
        <br>
        系统类版本号：<?= php_uname('r')?>
        <br>
        系统类版本号：<?= php_uname('r')?>
        <br>
        PHP版本：<?= PHP_VERSION?>
        <br>
        服务器IP：<?=  GetHostByName($_SERVER['SERVER_NAME'])?>
        <br>
        服务器解译引擎：<?= $_SERVER['SERVER_SOFTWARE']?>
        <br>


</div>
