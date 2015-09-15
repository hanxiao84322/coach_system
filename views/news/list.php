<!--banner-->
<div class="news_banner">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b><?= \app\models\NewsCategory::getOneCategoryNameById($data['categoryId'])?>
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
                <ul class="ul_list1">
                    <?php if (!empty($data['models'])) {?>
                        <?php foreach ($data['models'] as $key => $val) :?>
                            <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>""><?= $val['title']?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                        <?php endforeach;?>
                    <?php }?>
                </ul>
                <!--number-->
                <div class="number_box">
                    <?php
                    echo \yii\widgets\LinkPager::widget(['pagination' => $data['pages']])
                    ?>
                </div>
                <!--number-->
            </div>
        </div>
    </div>
</div>
<!--content-->