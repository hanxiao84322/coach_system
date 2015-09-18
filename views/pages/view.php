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
        <span>北京市共有注册教练员：<?= $userCount?> 名</span>  [  市级 <b><?= \app\models\Users::getAllCountByLevelId(2)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;D 级 <b><?= \app\models\Users::getAllCountByLevelId(3)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;C级 <b><?= \app\models\Users::getAllCountByLevelId(4)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;B 级 <b><?= \app\models\Users::getAllCountByLevelId(5)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;A级 <b><?= \app\models\Users::getAllCountByLevelId(6)?></b> 名&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;职业级 <b><?= \app\models\Users::getAllCountByLevelId(7)?></b> 名   ]
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
                    <img src="images/t3.jpg" />
                    <span>教练员证书查询</span>
                    <a href="javascript:;">注册教练员证书</a>
                    <a href="javascript:;">在线查询</a>
                </li>
            </ul>
        </div>
        <div class="two_set1">
            <p class="p_logo1"><img src="/images/logo1.jpg" /><span><?= $pageInfo['title']?></span></p>
            <p class="p_con"><?= $pageInfo['content']?></p>
        </div>
    </div>
</div>
<!--content-->