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
<?php
use yii\widgets\ActiveForm;
?>
<!--banner-->
<div class="jly_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('home/index')?>">首页</a><b>></b>教练员专栏
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
<div class="con_set">
<div class="news_con1">
<div class="city_title11">
    <?php $form = ActiveForm::begin([
        'id'=>'register',
        'enableAjaxValidation' => false,
        'action' => \yii\helpers\Url::to('/search/index')
    ]); ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding-right:0;">教练员高级搜索：</td>
            <td><input type="text" value="请输入教练员姓名或教练证书编号" class="w240" name="certificate_number" /></td>
            <td><select class="w188" name="area_base">
                    <?php if (!empty($data['districtList'])) {?>
                        <?php foreach ($data['districtList'] as $key => $val) :?>
                            <option value="<?= $val?>"><?= $val?></option>
                        <?php endforeach;?>
                    <?php }?>
            </select></td>
            <td><select class="w80" name="level">
                    <option value="" selected>不限级别</option>
                    <?php if (!empty($data['levelList'])) {?>
                        <?php foreach ($data['levelList'] as $key => $val) :?>
                            <option value="<?= $val['id']?>"><?= $val['name']?></option>
                        <?php endforeach;?>
                    <?php }?>            </select></td>
            <td><select class="w90" name="sex"><option value="">不限性别</option><option value="1">男</option><option value="2">女</option></select></td>
            <td><input type="submit" value="搜索"></td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>
</div>
<h3 class="jjfc_set20"><span class="fl">教练员统计</span><span class="fr span_set">北京市共有注册教练员：[<b> <?= $data['userCount']?></b> 名 ]</span></h3>
<div class="sj_six">
    <ul>
        <li><img src="/images/shi1.jpg" /><span><?= \app\models\Users::getAllCountByLevelId(2)?><b>人</b></span></li>
        <li><img src="/images/D.jpg" /><span><?= \app\models\Users::getAllCountByLevelId(3)?><b>人</b></span></li>
        <li><img src="/images/C.jpg" /><span><?= \app\models\Users::getAllCountByLevelId(4)?><b>人</b></span></li>
        <li><img src="/images/B.jpg" /><span><?= \app\models\Users::getAllCountByLevelId(5)?><b>人</b></span></li>
        <li><img src="/images/A.jpg" /><span><?= \app\models\Users::getAllCountByLevelId(6)?><b>人</b></span></li>
        <li><img src="/images/ZY.jpg" /><span><?= \app\models\Users::getAllCountByLevelId(7)?><b>人</b></span></li>
    </ul>
</div>
<h3 class="jjfc_set21"><span class="fl">教练员分布</span></h3>
<div class="box_table1 ClearFix" style="width:100%;float:left;">
    <ul class="list_uls5">
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">东城区(18)</a></li>
        <li><a href="javascript:;">其他地区(2)</a></li>
    </ul>
</div>
<div style="clear:both;height:1px;"></div>
<div class="tabs martop">
<h3 class="title_h43"><a href="javascript:;">市级教练员</a><a href="javascript:;">D级教练员</a><a href="javascript:;">C级教练员</a><a href="javascript:;">B级教练员</a><a href="javascript:;">A级教练员</a><a href="javascript:;">职业级教练员</a><span class="pxbxi_Set1">最新注册</span></h3>
<!--市级教练员-->
<div class="tab_son box_table1 ClearFix">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php if (!empty($data['coachA'])) {?>
                        <?php foreach ($data['coachA'] as $key => $val) :?>

                        <li>
                            <div class="pic">
                                <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                    <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                    <p>
                                        姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" />
                                    </p>
                                </a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php }?>

                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div>
</div>
<!--市级教练员-->
<!--D级教练员-->
<div class="tab_son box_table1 ClearFix">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php if (!empty($data['coachB'])) {?>
                            <?php foreach ($data['coachB'] as $key => $val) :?>

                                <li>
                                    <div class="pic">
                                        <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                            <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                            <p>
                                                姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" />
                                            </p>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php }?>

                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div></div>
<!--D级教练员-->
<!--C级教练员-->
<div class="tab_son box_table1 ClearFix">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php if (!empty($data['coachC'])) {?>
                            <?php foreach ($data['coachC'] as $key => $val) :?>

                                <li>
                                    <div class="pic">
                                        <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                            <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                            <p>
                                                姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" />
                                            </p>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php }?>

                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div></div>
<!--C级教练员-->
<!--B级教练-->
<div class="tab_son box_table1 ClearFix">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php if (!empty($data['coachD'])) {?>
                            <?php foreach ($data['coachD'] as $key => $val) :?>

                                <li>
                                    <div class="pic">
                                        <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                            <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                            <p>
                                                姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" />
                                            </p>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php }?>

                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div></div>
<!--B级教练-->
<!--A级教练员-->
<div class="tab_son box_table1 ClearFix">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php if (!empty($data['coachE'])) {?>
                            <?php foreach ($data['coachE'] as $key => $val) :?>

                                <li>
                                    <div class="pic">
                                        <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                            <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                            <p>
                                                姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" />
                                            </p>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php }?>

                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div></div>
<!--A级教练员--
<!--职业级教练员-->
<div class="tab_son box_table1 ClearFix">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php if (!empty($data['coachF'])) {?>
                            <?php foreach ($data['coachF'] as $key => $val) :?>

                                <li>
                                    <div class="pic">
                                        <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                            <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                            <p>
                                                姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= \app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" />
                                            </p>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php }?>

                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div></div>
<!--职业级教练员-->
</div>
<h3 class="jjfc_set4" style="border-bottom:solid 2px #438E0F;margin-bottom:20px;position:inherit;">教练员风采</h3>
<div class="hud_box">
    <div class="adva0">
        <div class="leftLoop2">
            <div class="bd">
                <ul class="picList2">
                    <?php if (!empty($data['newsList'])) {?>
                    <?php foreach ($data['newsList'] as $key => $val) :?>
                        <?php if ((($key+1)%4 == 0)) {?>
                        <li>
                        <div class="pic">
                            <p><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="215" height="143" /></a></p>
                            <p class="three_title"><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></p>
                        </div>
                    </li>
                        <?php } else  {?>
                                <li style="margin-right:0;">
                                    <div class="pic">
                                        <p><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="215" height="143" /></a></p>
                                        <p class="three_title"><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></p>
                                    </div>
                                </li>
                        <?php }?>
                    <?php endforeach;?>
                    <?php }?>
                </ul>
            </div>
            <div class="hd">
                <a class="next"></a>
                <a class="prev"></a>
                <ul><li>1</li><li>2</li><li>3</li><li>4</li></ul>

            </div>
        </div>
        <script type="text/javascript">
            for(var i=0;i<=1000;i++)
            {
                $('.picList2 li').slice(8*i,8*i+8).wrapAll('<div class="yyy"></div>');
            }
            jQuery(".leftLoop2").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});
        </script>
    </div>
</div>
</div>
</div>
</div>
<!--content-->