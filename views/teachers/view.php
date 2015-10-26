<script type="text/javascript">
    $(function(){
        $(".p_flset,.hover_box").hover(function(){
            $(".hover_box").show();
        },function(){
            $(".hover_box").hide();
        });
    });
</script>
<!--banner-->
<div class="jly_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b><a href="<?= \yii\helpers\Url::to('/teachers/index')?>">讲师</a><b>></b><?= $data['name']?>
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con1">
            <div class="city_title1">
                讲师（邓加）基本信息
            </div>
            <div class="js_infromation">
                <p class="fl js_header"><img src="/upload/images/teachers/photo/<?= $data['photo']?>" width="198" height="219" /></p>
                <div class="fl w250">
                    <table cellpadding="0" cellspacing="0" class="table_s36">
                        <tr>
                            <th colspan="2">讲师基本信息</th>
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
                            <td><?= $data['age']?></td>
                        </tr>
                        <tr>
                            <td>级 别</td>
                            <td><?= \app\models\Teachers::$levelList[$data['level']]?></td>
                        </tr>
                        <tr>
                            <td>教授课时</td>
                            <td>（<b><?= $data['lesson']?></b>）课时</td>
                        </tr>
                        <tr>
                            <td>授课积分</td>
                            <td>（<b><?= $data['score']?></b>）积分</td>
                        </tr>
                    </table>
                </div>
                <div class="set_w400 fr">
                    <h3 class="jsjj_box">讲师简介</h3>
                    <div class="h150">
                        <?= $data['content']?>
                    </div>
                    <div class="position_zhpj">
                        <span class="fl zhpj_set">综合评价</span>
                        <p class="p_flset fl">
                            <img src="/images/xx.png" /> <img src="/images/xx.png" /> <img src="/images/xx.png" /> <img src="/images/xx.png" /> <img src="/images/xx.png" /> <span><b>4.8</b>分 共159人评价</span>
                        </p>
                        <div class="hover_box">
                            <table cellpadding="0" cellspacing="0" class="press_box">
                                <tr>
                                    <td width="73"><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /></td>
                                    <td width="23">5分</td>
                                    <td width="87"><p class="prgess"></p></td>
                                    <td>91.77%</td>
                                </tr>
                                <tr>
                                    <td><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /></td>
                                    <td>4分</td>
                                    <td><p class="prgess"></p></td>
                                    <td>4.23%</td>
                                </tr>
                                <tr>
                                    <td><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /></td>
                                    <td>3分</td>
                                    <td><p class="prgess"></p></td>
                                    <td>1.54%</td>
                                </tr>
                                <tr>
                                    <td><img src="/images/xx1.jpg" /><img src="/images/xx1.jpg" /></td>
                                    <td>2分</td>
                                    <td><p class="prgess"></p></td>
                                    <td>0.54%</td>
                                </tr>
                                <tr>
                                    <td><img src="/images/xx1.jpg" /></td>
                                    <td>1分</td>
                                    <td><p class="prgess"></p></td>
                                    <td>1.54%</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="jjfc_set5"><span class="fl">讲师授课分布</span></h3>
            <div class="box_table1 ClearFix" style="width:100%;float:left;">
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
            <div style="clear:both;height:1px;"></div>
            <h3 class="jjfc_set4" style="border-bottom:solid 2px #438E0F;margin-bottom:20px;position:inherit;">讲师授课风采</h3>
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