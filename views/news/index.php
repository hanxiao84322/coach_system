<!--nav-->
<!--banner-->
<div class="news_banner">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>" style="color:#008000;">首页</a><b>></b>最新动态
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con">
            <!--adv-->
            <div class="adv0">
                <div class="adv_s">
                    <div class="leftLoop">
                        <div class="bd">
                            <ul class="picList">

                                <?php if (!empty($data['imgNews'])) {?>
                                    <?php foreach ($data['imgNews'] as $key => $val) :?>
                                        <li>
                                            <div class="pic">
                                                <a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="<?= '/upload/images/news/thumb/'.$val['thumb']?>" width="890" height="285" /></a>
                                            </div>
                                            <div class="content_pic">
                                                <?= $val['title']?>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                <?php }?>

                            </ul>
                        </div>
                        <div class="hd">
                            <div class="sj_mark">
                                <a class="next"></a>
                                <a class="prev"></a>
                            </div>
                            <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                        </div>
                    </div>
                </div>
                <script type="text/javascript">jQuery(".leftLoop").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});</script>
            </div>
            <!--adv-->
            <div class="conbox_w727">
                    <h3 class="h60_title"><span>最新公告</span><a href="<?= \yii\helpers\Url::to(['/news/list', 'category_id' => 4])?>">更多>></a></h3>
                <ul class="ul_list1">
                    <?php if (!empty($data['newsA'])) {?>
                        <?php foreach ($data['newsA'] as $key => $val) :?>
                            <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                        <?php endforeach;?>
                    <?php }?>
                </ul>
                <h3 class="h60_title1"><span>培训动态</span><a href="<?= \yii\helpers\Url::to(['/news/list', 'category_id' => 1])?>">更多>></a></h3>
                <ul class="ul_list1">
                    <?php if (!empty($data['newsB'])) {?>
                        <?php foreach ($data['newsB'] as $key => $val) :?>
                            <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                        <?php endforeach;?>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--content-->