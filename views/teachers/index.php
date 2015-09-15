<!--banner-->
<div class="pxfc_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b>讲师列表
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con1">
            <div class="city_title">
                培训讲师
            </div>
            <div class="city_title2 mart20">
                北京共有 培训讲师<span>30</span>名 [主讲师<span>20</span> 名 | 助理讲师<span>5</span> 名  |  裁判讲师<span>5</span> 名 ]
            </div>
            <h3 class="jjfc_set2"><span class="fl">培训讲师授课分布</span></h3>
            <div class="box_table1 ClearFix" style="width:100%;float:left;">
                <ul class="list_uls1">
                    <?php if (!empty($data['teachersArea'])) {?>
                    <?php foreach ($data['teachersArea'] as $key => $val) :?>
                    <li><a href="javascript:;"><?= $val['district']?>(<?= $val['count']?>)</a></li>
                    <?php endforeach;?>
                    <?php }?>
                </ul>
            </div>
            <div style="clear:both;height:1px;"></div>
            <h3 class="jjfc_set6" style="border-bottom:solid 2px #438E0F;margin-bottom:20px;position:inherit;">培训讲师列表</h3>
            <div class="hud_box1">
                <div class="adva0">
                    <div class="leftLoop1">
                        <div class="bd">
                            <ul class="picList1">
                                <?php if (!empty($data['teachersList'])) {?>
                                <?php foreach ($data['teachersList'] as $key => $val) :?>
                                <li>
                                    <div class="pic">
                                        <a href="<?= \yii\helpers\Url::to(['teachers/view', 'id' => $val['id']])?>">
                                            <span><img src="/upload/images/teachers/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                            <p>
                                                姓名：<?= $val['name']?><br />年龄：<?= $val['age']?><br />职称：<?= app\models\Teachers::getLevelName($val['level'])?><br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                            </p>
                                        </a>
                                    </div>
                                </li>
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
                            $('.picList1 li').slice(9*i,9*i+9).wrapAll('<div class="yyy"></div>');
                        }
                        jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!--content-->