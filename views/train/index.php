<!--banner-->
<div class="pxbm_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('home/index')?>" style="color:#008000;">首页</a><b>></b>培训报名
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
<div class="con_set">
<div class="news_con">
<div class="notice_set">
    <span>教练员培训须知！</span>1、热爱教练事业优先<br />2、大专以上学历（体育专业优先）。 <br />3、年龄在25-45岁。 <br />4、提交报名表后会在7-14个工作日以短信形式通知录取信息以及培训信息，请您务必准确填写每项信息<br /><b>注意：如有虚假报名申请将列入教练员黑名单！！</b>
</div>

<div class="tabs martop">
<h3 class="title_h44">
    <a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '2']) ?>" <?php if ($levelId == 2):?> class="hover" <?php endif;?>>市级班</a>
    <a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '3']) ?>" <?php if ($levelId == 3):?> class="hover" <?php endif;?>>D级班</a>
    <a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '4']) ?>" <?php if ($levelId == 4):?> class="hover" <?php endif;?>>C级班</a>
    <a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '5']) ?>" <?php if ($levelId == 5):?> class="hover" <?php endif;?>>B级班</a>
    <a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '6']) ?>" <?php if ($levelId == 6):?> class="hover" <?php endif;?>>A级班</a>
    <a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '7']) ?>" <?php if ($levelId == 7):?> class="hover" <?php endif;?>>职业级班</a>
    <span class="pxke_Set">培训课程</span></h3>
<!--北京市市级教练员培训-->
<div class="tab_son" style="display: block;">
    <div class="h132">
        <p class="fl"><img src="/images/l<?= $levelId-1?>.jpg" /></p>
        <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById($levelId)?></div>
        <p class="fr"><img src="/images/pic3.jpg" /></p>
    </div>
    <div class="table_box">
        <table cellpadding="0" cellspacing="0" class="h31">
            <tr>
                <td width="50" class="pxset">排序</td>
                <td colspan="4">&nbsp;</td>
                <?php if ($orderBy == '`begin_time` desc') {?>
                    <td width="100">时间 <a href="<?= \yii\helpers\Url::to(['/train/index','order_by' => '`begin_time` asc'])?>"><img src="/images/sj.jpg" /></a></td>
                <?php } else {?>
                    <td width="100">时间 <a href="<?= \yii\helpers\Url::to(['/train/index','order_by' => '`begin_time` desc'])?>"><img src="/images/sj.jpg" /></a></td>

                <?php }?>
                <?php if ($orderBy == '`category` desc') {?>
                    <td width="100">类别 <a href="<?= \yii\helpers\Url::to(['/train/index','order_by' => '`category` asc'])?>"><img src="/images/sj.jpg" /></a></td>
                <?php } else {?>
                    <td width="100">类别 <a href="<?= \yii\helpers\Url::to(['/train/index','order_by' => '`category` desc'])?>"><img src="/images/sj.jpg" /></a></td>

                <?php }?>
                <?php if ($orderBy == '`status` desc') {?>
                    <td width="100">状态 <a href="<?= \yii\helpers\Url::to(['/train/index','order_by' => '`status` asc'])?>"><img src="/images/sj.jpg" /></a></td>
                <?php } else {?>
                    <td width="100">状态 <a href="<?= \yii\helpers\Url::to(['/train/index','order_by' => '`status` desc'])?>"><img src="/images/sj.jpg" /></a></td>

                <?php }?>

            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="table_set">
            <tr>
                <th width="50">序</th>
                <th width="210">培训课排期</th>
                <th>类别</th>
                <th>开课时间</th>
                <th>培训地点</th>
                <th>报名人数</th>
                <th>报名状态</th>
            </tr>
            <?php foreach ($models as $key => $val) :?>
                <tr>
                    <?php if (isset($_GET['page']) && $_GET['page'] > 1) {?>
                        <td><?= $key+1+($_GET['per-page']*($_GET['page']-1)) ?></td>
                    <?php } else {?>
                        <td><?= $key+1 ?></td>
                    <?php }?>
                <td><a href="<?= \yii\helpers\Url::to(['/train/view', 'id'=> $val->id])?>"><?= $val->name ?> 第<?= $val->period_num ?>期</td>
                <td><?= \app\models\Train::$categoryList[$val->category] ?></td>
                <td><?= $val->begin_time ?></td>
                <td><?= \app\models\TrainLand::getNameById($val->train_land_id) ?></td>
                <td>招<?= $val->recruit_count ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                    <?php if ($val['status'] == \app\models\Train::BEGIN_SIGN_UP) {?>
                <td><b><a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val->id])?>" style="color:green;">申请报名</a></b></td>
                    <?php } else {?>
                        <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Train::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Train::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Train::$statusList[$val->status]?></a></b></td>
                    <?php } ?>


            </tr>
            <?php endforeach; ?>

        </table>
        <!--number-->
        <div class="number_box">
            <?php
            echo \yii\widgets\LinkPager::widget(['pagination' => $pages])
            ?>
        </div>
        <!--number-->
    </div>
</div>
</div>
</div>
</div>
</div>
<!--content-->

