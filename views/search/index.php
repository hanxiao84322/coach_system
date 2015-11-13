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
        <li><a href="<?= Url::to('/user/register-coach')?>">教练员注册</a></li>
        <li><a href="<?= Url::to('/user/index')?>" class="hover">教练员专区</a></li>
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
        $(".more").click(function(){
            $(this).hide();
            $(".shouq").show();
            $(".anji_search1").addClass("anji_search2")
        })
        $(".shouq").click(function(){
            $(this).hide();
            $(".more").show();
            $(".anji_search1").removeClass("anji_search2")
        })

    })
</script>
<!--banner-->
<div class="jly_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>" style="color:#008000;">首页</a><b>></b>搜索
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
<div class="con_set">
<div class="news_con1">
<?php $form = ActiveForm::begin([
    'id'=>'registerInfo',
    'enableAjaxValidation' => false,
    'action' => \yii\helpers\Url::to('/search/index')
]); ?>
<div class="search_tiaojian ClearFix">
    <h3 class="jiaolys_set">教练员搜索</h3>
    <div class="anji_search ClearFix">
        <p class="fl tiaoj_title">按等级：</p>
        <ul class="fl ul_w755 ClearFix">
            <?php if (!empty($data['levelList'])) {?>
                <?php foreach ($data['levelList'] as $key => $val) :?>
                    <li><a href="<?= \yii\helpers\Url::to(['/search/index','level_id'=>$val['id']])?>"><?= $val['name']?></a></li>
                <?php endforeach;?>
            <?php }?>
        </ul>
    </div>
    <div class="anji_search1 ClearFix">
        <p class="fl tiaoj_title">按区域：</p>
        <ul class="fl ul_w755 ClearFix">
            <?php if (!empty($data['districtList'])) {?>
                <?php foreach ($data['districtList'] as $key => $val) :?>
                    <li><a href="<?= \yii\helpers\Url::to(['/search/index','district'=>$val])?>"><?= $val?></a></li>
                <?php endforeach;?>
            <?php }?>
        </ul>
        <a href="javascript:;" class="fl more">更多></a>
        <a href="javascript:;" class="fl shouq">收起></a>
    </div>
    <div class="anji_search ClearFix">
        <p class="fl tiaoj_title">按性别：</p>
        <ul class="fl ul_w755 ClearFix">
            <li><a href="<?= \yii\helpers\Url::to(['/search/index','sex'=>1])?>">男</a></li>
            <li><a href="<?= \yii\helpers\Url::to(['/search/index','sex'=>2])?>">女</a></li>
        </ul>
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="paix_set">
    <ul class="fl px_list">
        <li>排序：</li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','keyword'=>$data['keyword'],'level_id'=>$data['levelId'],'sex'=>$data['sex'],'district'=>$data['district'],'order'=>'u.create_time desc'])?>">注册时长</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','keyword'=>$data['keyword'],'level_id'=>$data['levelId'],'sex'=>$data['sex'],'district'=>$data['district'],'order'=>'ui.birthday asc'])?>">年龄</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','keyword'=>$data['keyword'],'level_id'=>$data['levelId'],'sex'=>$data['sex'],'district'=>$data['district'],'order'=>'u.score desc'])?>">评分</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','keyword'=>$data['keyword'],'level_id'=>$data['levelId'],'sex'=>$data['sex'],'district'=>$data['district'],'order'=>'u.lesson desc'])?>">执教经验</a></li>
    </ul>
</div>
<h3 class="search_titleset"><span class="fl">搜索结果</span></h3>
<div class="martop">
    <!--市级教练员-->
    <div class="box_table ClearFix">
        <ul class="picList_set">
            <?php if (!empty($data['models'])) {?>
                <?php foreach ($data['models'] as $key => $val) :?>
                    <li>
                        <div class="pic">
                            <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['user_id']])?>">
                                <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                <p>
                                    姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" />
                                </p>
                            </a>
                        </div>
                    </li>
                <?php endforeach;?>
            <?php } else {?>
                没有符合条件的学员
            <?php } ?>
        </ul>
        <!--number-->
        <div class="number_box" style="margin:0 auto;width:520px">
            <?php
            echo \yii\widgets\LinkPager::widget(['pagination' => $data['pages']])
            ?>
        </div>
        <!--number-->
    </div>
    <!--市级教练员-->
</div>
</div>
</div>
</div>