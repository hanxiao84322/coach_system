<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
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
        <li><a href="<?= Url::to('/news/index')?>">最新动态</a></li>
        <li><a href="<?= Url::to('/train/index')?>">培训报名</a></li>
        <li><a href="<?= Url::to(['/news/train','level_id' => 2])?>">培训风采</a></li>
        <li><a href="<?= Url::to('/user/register-coach')?>" class="hover">教练员注册</a></li>
        <li><a href="<?= Url::to('/user/index')?>">教练员专区</a></li>
        <li><a href="<?= Url::to(['/news/list', 'category_id' => 10])?>" >政策法规</a></li>
        <li><a href="http://www.bj-fa.org.cn/" target="_blank">足协官网</a></li>
    </ul>
</div>
<!--nav-->
<script language="javascript">
    // JavaScript Document
    $(function(){
        //tab
        $(".tabs .title_h43 a:first-child").addClass("hover");
        $(".tabs").each(function(){
            $(".tab_son",this).eq(0).addClass("nodis");
        });
        $(".tabs .title_h43 a").click(function(){
            var nnum = $(this).index();
            $(this).siblings().removeClass("hover");
            $(this).addClass("hover");
            var nnum = $(this).index();
            $(this).parent().siblings(".tab_son").removeClass("nodis");
            $(this).parent().siblings(".tab_son").eq(nnum).addClass("nodis");

        });

    })
</script>
<!--banner-->
<div class="jly_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>"  style="color:#008000;">首页</a><b>></b>教练员注册
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con3">
            <div class="dib_boxet">
                <div class="w330 fl">
                    <p>教练员注册<span>公告</span></p>
                    <?= $data['regComment']?>
                </div>
                <div class="fr w320">
                    <h3 class="wh3_set"><span>最新注册</span><a href="<?= \yii\helpers\Url::to('/user/index')?>">更多>></a></h3>
                    <ul class="ul_list1">
                        <?php if (!empty($data['newRegNews'])) {?>
                        <?php foreach ($data['newRegNews'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/user/view/', 'id' => $val['user_id']])?>"><?= mb_substr($val['title'], 0, 18, 'utf-8')?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <?php $form = ActiveForm::begin([
                'id'=>'register',
                'enableAjaxValidation' => false,
                'action' => \yii\helpers\Url::to('/user/register-coach')
            ]); ?>
            <div class="zhuce_set">

                <table cellpadding="0" cellspacing="0" class="table_he10">
                    <tr>
                        <td>身份证号：</td>
                        <?php if (!empty($data['userLevelInfo'])) {?>
                        <td><input type="text" value="<?= $data['userLevelInfo']['credentials_number']?>" class="w218"  name="credentials_number"/></td>
                        <?php } else {?>
                        <td><input type="text" value="请输入身份证号码" class="w218"  name="credentials_number"/></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <td>教练证号：</td>
                        <?php if (!empty($data['userLevelInfo'])) {?>
                            <td><input type="text" value="<?= $data['userLevelInfo']['certificate_number']?>" class="w218"  name="certificate_number"/></td>
                        <?php } else {?>
                            <td><input type="text" value="请输入教练员证书编码" class="w218"  name="certificate_number"/></td>
                        <?php }?>
                    </tr>
                </table>
            </div>
            <div class="input_btn">
                <input type="submit" value="" class="submit_btn" />
            </div>
            <?php ActiveForm::end(); ?>
            <p class="attention"><b>（注）</b>如果您获得了教练员资格，请输入个人准确的身份证号、教练员证号，进行教练员验证，并完成注册！</p>
        </div>
    </div>
</div>
<!--content-->