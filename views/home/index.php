<!--banner-->
<div class="banner">
    <div class="adv_set">
        <div class="advss">
            <div class="leftLoop">
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <div class="pic">
                                <a href=""><img src="/images/banner.jpg" /></a>
                            </div>
                        </li>
                        <li>
                            <div class="pic">
                                <a href=""><img src="/images/banner.jpg" /></a>
                            </div>
                        </li>
                        <li>
                            <div class="pic">
                                <a href=""><img src="/images/banner.jpg" /></a>
                            </div>
                        </li>
                        <li>
                            <div class="pic">
                                <a href=""><img src="/images/banner.jpg" /></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="hd">
                    <div class="sj_mark">
                        <a class="next"></a>
                        <a class="prev"></a>
                    </div>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>
                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});</script>
        </div>
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
        <img src="/images/people1.jpg" class="people1" />
        <img src="/images/people2.jpg" class="people2" />
        <div class="one_set">
            <ul>
                <li>
                    <img src="/images/t4.jpg" />
                    <span>教练员培训报名</span>
                    <a href="<?=\yii\helpers\Url::to('/train/index')?>">各级别教练员</a>
                    <a href="<?=\yii\helpers\Url::to('/train/index')?>">培训报名</a>
                </li>
                <li>
                    <img src="/images/t2.jpg" />
                    <span>教练员注册</span>
                    <a href="<?=\yii\helpers\Url::to('/user/register-coach')?>">在线注册</a>
                    <a href="<?=\yii\helpers\Url::to('/user/register-coach')?>">实时管理</a>
                </li>
                <li style="border-right:none;">
                    <img src="/images/t3.jpg" />
                    <span>教练员证书查询</span>
                    <a href="javascript:;">注册教练员证书</a>
                    <a href="javascript:;">在线查询</a>
                </li>
            </ul>
        </div>
        <div class="two_set">
            <div class="two_top">
                <div class="fl tt_left">
                    <img src="/images/pic.jpg" />
                </div>
                <div class="fl tt_middle">
                    <h3 class="news_title">最新动态</h3>
                    <ul class="news_dt">
                        <?php if (!empty($data['newsA'])) {?>
                        <?php foreach ($data['newsA'] as $key => $val) :?>
                        <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                        <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
                <div class="fr tt_right">
                    <h3 class="news_title">最新公告</h3>
                    <img src="/images/adv.jpg" />
                    联&nbsp;&nbsp;系&nbsp;人：陈老师、张老师<br />联系电话：010 89898787<br />开课日期：2015年05月10日<br />培训地址：北京市宣武区先浓痰体育场
                </div>
            </div>
            <div class="two_middle">
                <h3 class="jjfc">教练员风采</h3>
                <div class="krakatoa" data-settings="{ items : 4, autoplay : true, loop : true }">
                    <?php if (!empty($data['newsB'])) {?>
                        <?php foreach ($data['newsB'] as $key => $val) :?>
                            <a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="<?= '/upload/images/news/thumb/' . $val['thumb']?>" WIDTH="197" HEIGHT="130" /><span><?= $val['title']?></span></a>
                        <?php endforeach;?>
                    <?php }?>
                </div>
                <script>
                    $(window).on('load',function(){
                        $('.krakatoa').krakatoa( { width: '960px', height: 'auto' });
                    });
                </script>
            </div>
            <div class="two_bottom">
                <div class="fl tb_left">
                    <h3 class="titlebj"><span>培训计划</span><a href="<?= \yii\helpers\Url::to(['/news/category/', 'category_id' => 7])?>"><img src="/images/more.png" /></a></h3>
                    <ul class="ul_list">
                        <?php if (!empty($data['newsC'])) {?>
                            <?php foreach ($data['newsC'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
                <div class="fl tb_left1">
                    <h3 class="titlebj"><span>最新注册</span><a href="<?= \yii\helpers\Url::to(['/news/category/', 'category_id' => 8])?>"><img src="/images/more.png" /></a></h3>
                    <ul class="ul_list">
                        <?php if (!empty($data['newsD'])) {?>
                            <?php foreach ($data['newsD'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
                <div class="fr tb_left">
                    <h3 class="titlebj"><span>教练员动态</span><a href="<?= \yii\helpers\Url::to(['/news/category/', 'category_id' => 6])?>"><img src="/images/more.png" /></a></h3>
                    <ul class="ul_list">
                        <?php if (!empty($data['newsE'])) {?>
                            <?php foreach ($data['newsE'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--content-->