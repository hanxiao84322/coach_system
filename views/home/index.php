<!--banner-->
<div class="banner">
    <div class="pic" style="text-align:center;">
        <a href=""><img src="/images/banner.png" /></a>
    </div>
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="reg_con">
        <span>北京市共有注册教练员：<?= $data['userCount']?> 名</span>  [  市级 <b><?= \app\models\Users::getAllCountByLevelId(2)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;D 级 <b><?= \app\models\Users::getAllCountByLevelId(3)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;C级 <b><?= \app\models\Users::getAllCountByLevelId(4)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;B 级 <b><?= \app\models\Users::getAllCountByLevelId(5)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;A级 <b><?= \app\models\Users::getAllCountByLevelId(6)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;职业级 <b><?= \app\models\Users::getAllCountByLevelId(7)?></b> 名   ]
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="one_set">
            <ul>
                <li>
                    <img src="/images/t4.jpg" />
                    <a href="<?=\yii\helpers\Url::to('/train/index')?>"><span>教练员培训报名</span></a>
                    <a href="<?=\yii\helpers\Url::to('/train/index')?>">各级别教练员</a>
                    <a href="<?=\yii\helpers\Url::to('/train/index')?>">培训报名</a>
                </li>
                <li>
                    <img src="/images/t2.jpg" />
                    <a href="<?=\yii\helpers\Url::to('/user/register-coach')?>"><span>教练员注册</span></a>
                    <a href="<?=\yii\helpers\Url::to('/user/register-coach')?>">在线注册</a>
                    <a href="<?=\yii\helpers\Url::to('/user/register-coach')?>">实时管理</a>
                </li>
                <li style="border-right:none;">
                    <img src="/images/t3.jpg" />
                    <a href="<?=\yii\helpers\Url::to('/top-search/index')?>"><span>教练员查询</span></a>
                    <a href="<?=\yii\helpers\Url::to('/top-search/index')?>">注册教练员</a>
                    <a href="<?=\yii\helpers\Url::to('/top-search/index')?>">实时查询</a>
                </li>
            </ul>
        </div>
        <script type="text/javascript" src="/js/picban.js"></script>
        <!--<script type="text/javascript">
//$(function(){
//var len = $(".num > li").length;
//    var index = 0;  //图片序号
//    var adTimer;
//    $(".num li").mouseover(function() {
//        index = $(".num li").index(this);  //获取鼠标悬浮 li 的index
//        showImg(index);
//    }).eq(0).mouseover();
//    //滑入停止动画，滑出开始动画.
//    $('#scrollPics').hover(function() {
//        clearInterval(adTimer);
//    }, function() {
//        adTimer = setInterval(function() {
//            showImg(index)
//            index++;
//            if (index == len) {       //最后一张图片之后，转到第一张
//                index = 0;
//            }
//        }, 5000);
//    }).trigger("mouseleave");
//
//    function showImg(index) {
//        var adHeight = $("#scrollPics>ul>li:first").height();
//        $(".slider").stop(true, false).animate({
//            "marginTop": -adHeight * index + "px"    //改变 marginTop 属性的值达到轮播的效果
//        }, 1000);
//        $(".num li").removeClass("on")
//            .eq(index).addClass("on");
//    }
//
//})

 
</script>-->
        <div class="two_set">
            <div class="two_top">
                <div class="fl tt_left" style="position:relative;">
                    <!-- 代码 开始
					<div id="bn"> 
                        <span class="tu"> 
                            <a href="#" class="lianjie"><img src="/images/pic.jpg" width="322" height="218" /></a> 
                            <a href="#" class="lianjie" style="display:none"><img src="/images/pic.jpg" height="218" width="322"  /></a> 
                            <a href="#" class="lianjie" style="display:none"><img src="/images/pic.jpg" height="218" width="322" /></a> 
                            <a href="#" class="lianjie" style="display:none"><img src="/images/pic.jpg" height="218" width="322" /></a> 
                            <a href="#" class="lianjie" style="display:none"><img src="/images/pic.jpg" height="218" width="322" /></a>
                        </span> 
                        <div id="hao">
                            <a class="xu">1</a> 
                            <a class="xu">2</a>
                            <a class="xu">3</a> 
                            <a class="xu">4</a> 
                            <a class="xu">5</a> 
                        </div>
                        <div class="tiao"></div>
                    </div> -->
                    <!-- 代码 结束 -->
          			<a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $data['oneNewsPic']['id']])?>"><img src="<?= '/upload/images/news/thumb/' . $data['oneNewsPic']['thumb']?>" width="323" height="220" />
                    <span style="position:absolute;left:0px;bottom:0px;width:322px;height:30px;background:rgba(6,68,0,0.7);font-size:16px;color:#fff;line-height:30px;text-align:center"><?= mb_substr($data['oneNewsPic']['title'], 0, 18, 'utf-8')?></span></a>
                </div>
                <div class="fl tt_middle">
                    <h3 class="news_title">最新动态</h3>
                    <ul class="news_dt">
                        <?php if (!empty($data['newsA'])) {?>
                        <?php foreach ($data['newsA'] as $key => $val) :?>
                        <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= mb_substr($val['title'], 0, 18, 'utf-8')?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                        <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
                <div class="fr tt_right">
                    <h3 class="news_title">最新公告</h3>
                    <?= $data['newsRegister']['content']?>
                </div>
            </div>
           <div class="two_middle">
                <h3 class="jjfc">教练员风采</h3>
                <div class="krakatoa" data-settings="{ items : 4, autoplay : true, loop : true }">
                    <?php if (!empty($data['newsB'])) {?>
                        <?php foreach ($data['newsB'] as $key => $val) :?>
                            <a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="<?= '/upload/images/news/thumb/' . $val['thumb']?>" WIDTH="197" HEIGHT="130" /><span><?= mb_substr($val['title'], 0, 18, 'utf-8')?></span></a>
                        <?php endforeach;?>
                    <?php }?>
                </div>
               <script src="/js/jquery.krakatoa.js"></script>
               <script>
                    window.onload = function() {
                            $('.krakatoa').krakatoa( { width: '960px', height: 'auto' });
                        };
                </script>

            </div>
            <div class="two_bottom">
                <div class="fl tb_left">
                    <h3 class="titlebj"><span>培训计划</span><a href="<?= \yii\helpers\Url::to(['/news/list/', 'category_id' => 7])?>"><img src="/images/more.png" /></a></h3>
                    <ul class="ul_list">
                        <?php if (!empty($data['newsC'])) {?>
                            <?php foreach ($data['newsC'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= mb_substr($val['title'], 0, 18, 'utf-8')?></a><span><?= date('m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
                <div class="fl tb_left1">
                    <h3 class="titlebj"><span>最新报名</span><a href="<?= \yii\helpers\Url::to('/user/index/')?>"><img src="/images/more.png" /></a></h3>
                    <ul class="ul_list">
                        <?php if (!empty($data['newsD'])) {?>
                            <?php foreach ($data['newsD'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/user/view/', 'id' => $val['user_id']])?>"><?= mb_substr($val['title'], 0, 18, 'utf-8')?></a><span><?= date('m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
                <div class="fr tb_left">
                    <h3 class="titlebj"><span>教练员动态</span><a href="<?= \yii\helpers\Url::to(['/news/list/', 'category_id' => 6])?>"><img src="/images/more.png" /></a></h3>
                    <ul class="ul_list">
                        <?php if (!empty($data['newsE'])) {?>
                            <?php foreach ($data['newsE'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= mb_substr($val['title'], 0, 18, 'utf-8')?></a><span><?= date('m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--content-->