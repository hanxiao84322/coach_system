<!--banner-->
<div class="jly_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b><a href="javascript:;">学员</a><b>></b><?= $data['name']?>
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con1">
            <div class="city_title1">
                学院（<?= $data['name']?>）基本信息
            </div>
            <div class="js_infromation">
                <p class="fl js_header"><img src="/upload/images/users_info/photo/<?= $data['photo']?>" width="198" height="219" /></p>
                <div class="fl w250">
                    <table cellpadding="0" cellspacing="0" class="table_s361">
                        <tr>
                            <th colspan="2">学院基本信息</th>
                        </tr>
                        <tr>
                            <td>姓 名</td>
                            <td><?= $data['name']?></td>
                        </tr>
                        <tr>
                            <td>性 别</td>
                            <td><?= \app\models\Teachers::$sexList[$data['sex']]?></td>
                        </tr>
                        <tr>
                            <td>年 龄</td>
                            <td><?= date('Y', time()) - date('Y', strtotime($data['birthday']))?></td>
                        </tr>
                        <tr>
                            <td>级 别</td>
                            <td><?= \app\models\Level::getOneLevelNameById($userModel['level_id'])?></td>
                        </tr>
                        <tr>
                            <td>注册地区</td>
                            <td><?= $data['account_location']?></td>
                        </tr>
                        <tr>
                            <td>证书编号</td>
                            <td><?= \app\models\UsersLevel::getLevelCertificateNumberByUserIdAndLevelId($userModel['id'], $userModel['level_id'])?></td>
                        </tr>
                    </table>
                </div>
                <div class="set_w400 fr" style="height:218px;">
                    <h3 class="jsjj_box1">教练员互动信息</h3>
                    <table cellpadding="0" cellspacing="0" class="press_box1">
                        <tr>
                            <td width="142">注册积分</td>
                            <td style="border-right:none;">（<b>60</b>）分</td>
                        </tr>
                        <tr>
                            <td width="87">活动积分</td>
                            <td style="border-right:none;">（<b><?= $userModel['score']?></b>）分</td>
                        </tr>
                        <tr>
                            <td width="87" style="border-bottom:none;">综合评分</td>
                            <td style="border-bottom:none;border-right:none;">
                                <p class="p_flset">
                                    <img src="/images/xx.png" /> <img src="/images/xx.png" /> <img src="/images/xx.png" /> <img src="/images/xx.png" /> <img src="/images/xx.png" /> <span><b>4.8</b>分  共159人评价</span>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="clear:both;"></div>
            <h3 class="jjfc_set5"><span class="fl">教练员活动分布</span></h3>
            <div class="box_table1 ClearFix">
                <ul class="list_uls4">
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;">东城区(<b>8</b>)课时</a></li>
                    <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                </ul>
            </div>
            <h3 class="jjfc_set4" style="border-bottom:solid 2px #438E0F;margin-bottom:20px;position:inherit;">教练员参与活动风采</h3>
            <div class="hud_box">
                <div class="adva0">
                    <div class="leftLoop1">
                        <div class="bd">
                            <ul class="picList">
                                <?php foreach ($trainWind as $key => $val) :?>
                                    <?php if ((($key+1)%4 == 0)) {?>

                                        <li style="margin-right:0;">
                                            <div class="pic">
                                                <p><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="219" height="146" /></a></p>
                                                <p class="three_title"><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></p>
                                            </div>
                                        </li>
                                    <?php } else  {?>
                                        <li>
                                            <div class="pic">
                                                <p><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="219" height="146" /></a></p>
                                                <p class="three_title"><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></p>
                                            </div>
                                        </li>
                                    <?php }?>

                                <?php endforeach;?>
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
                            $('.picList li').slice(8*i,8*i+8).wrapAll('<div class="yyy"></div>');
                        }
                        jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!--content-->