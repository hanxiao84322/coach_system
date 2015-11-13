<!--banner-->
<div class="pxfc_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b><a href="<?= \yii\helpers\Url::to(['/news/train', 'id' => 2])?>">培训风采</a><b>></b><a href="<?= \yii\helpers\Url::to('/train-land/index')?>">培训地点</a><b>></b>绿荫阳光足球公园
    </div>
</div>
<!--注册人数-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con1">
            <div class="city_title">
                培训地点
            </div>
            <div class="city_title2 mart20">
                北京共有（<b><?= $data['count']?></b>）个地区设立培训站  共有足球场<span> <?= \app\models\TrainLand::getAllCountBySiteType()?></span> 块  [ 天然草场<span> <?= \app\models\TrainLand::getAllCountBySiteType(1)?></span> 块  |  人工草<span> <?= \app\models\TrainLand::getAllCountBySiteType(2)?></span> 块 |  土场<span> <?= \app\models\TrainLand::getAllCountBySiteType(3)?></span> 块 |  其它<span> <?= \app\models\TrainLand::getAllCountBySiteType(4)?></span> 块 ]
            </div>
            <h3 class="jjfc_set2"><span class="fl">培训地点分布</span></h3>
            <div class="box_table1 ClearFix" style="width:100%;float:left;">
                <ul class="list_uls1">
                    <?php foreach (\app\models\TrainLand::$districtList as $key => $val) :?>
                        <li><a href="javascript:;"><?= $val?>(<?= \app\models\TrainLand::getAllCountByDistrict($key)?>)</a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div style="clear:both;height:1px;"></div>
            <h3 class="jjfc_set1"><span class="fl">培训地点列表</span></h3>
            <ul class="ClearFix h390">
                <?php if (!empty($data['models'])) {?>
                    <?php foreach ($data['models'] as $key => $val) :?>
                        <?php if ((($key+1)%4 == 0)) {?>
                            <li><a href="<?= \yii\helpers\Url::to(['/train-land/view/', 'id' => $val['id']])?>"><img src="/upload/images/train_land/thumb/<?= $val['thumb']?>" width="219" height="146" /></a><a href="<?= \yii\helpers\Url::to(['/train-land/view/', 'id' => $val['id']])?>"><?= $val['name']?></a></li>
                        <?php } else  {?>
                            <li class="mro"><a href="<?= \yii\helpers\Url::to(['/train-land/view/', 'id' => $val['id']])?>"><img src="/upload/images/train_land/thumb/<?= $val['thumb']?>" width="219" height="146" /></a><a href="<?= \yii\helpers\Url::to(['/train-land/view/', 'id' => $val['id']])?>"><?= $val['name']?></a></li>
                        <?php }?>
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