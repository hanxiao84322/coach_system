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
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b>搜索
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
<div class="con_set">
<div class="news_con1">
<?php $form = ActiveForm::begin([
    'id'=>'registerInfo',
    'enableAjaxValidation' => false,
    'action' => \yii\helpers\Url::to('/search/index')
]); ?>
<div class="search_tiaojian ClearFix">
    <h3 class="jiaolys_set">教练员搜索</h3>
    <div class="anji_search ClearFix">
        <p class="fl tiaoj_title">按等级：</p>
        <ul class="fl ul_w755 ClearFix">
            <?php if (!empty($data['levelList'])) {?>
                <?php foreach ($data['levelList'] as $key => $val) :?>
                    <li><a href="<?= \yii\helpers\Url::to(['/search/index','level_id'=>$val['id']])?>"><?= $val['name']?></a></li>
                <?php endforeach;?>
            <?php }?>
        </ul>
    </div>
    <div class="anji_search1 ClearFix">
        <p class="fl tiaoj_title">按区域：</p>
        <ul class="fl ul_w755 ClearFix">
            <?php if (!empty($data['districtList'])) {?>
                <?php foreach ($data['districtList'] as $key => $val) :?>
                    <li><a href="<?= \yii\helpers\Url::to(['/search/index','district'=>$val])?>"><?= $val?></a></li>
                <?php endforeach;?>
            <?php }?>
        </ul>
        <a href="javascript:;" class="fl more">更多></a>
        <a href="javascript:;" class="fl shouq">收起></a>
    </div>
    <div class="anji_search ClearFix">
        <p class="fl tiaoj_title">按性别：</p>
        <ul class="fl ul_w755 ClearFix">
            <li><a href="<?= \yii\helpers\Url::to(['/search/index','sex'=>1])?>">男</a></li>
            <li><a href="<?= \yii\helpers\Url::to(['/search/index','sex'=>2])?>">女</a></li>
        </ul>
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="paix_set">
    <ul class="fl px_list">
        <li>排序：</li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','order'=>'u.create_time desc'])?>">注册时长</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','order'=>'ui.birthday asc'])?>">年龄</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','order'=>'u.score desc'])?>">评分</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/search/index','order'=>'u.lesson desc'])?>">执教经验</a></li>
    </ul>
    <div class="fr jiance_Set">检索：共搜索到<b><?= $data['count']?></b>条结果</div>
</div>
<h3 class="search_titleset"><span class="fl">搜索结果</span></h3>
<div class="martop">
    <!--市级教练员-->
    <div class="box_table ClearFix">
        <ul class="picList_set">
            <?php if (!empty($data['models'])) {?>
                <?php foreach ($data['models'] as $key => $val) :?>
                    <li>
                        <div class="pic">
                            <a href="<?= \yii\helpers\Url::to(['/user/view','id' => $val['id']])?>">
                                <span><img src="/upload/images/users_info/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                <p>
                                    姓名：<?= $val['name']?><br />年龄：<?= date('Y', time()) - date('Y', strtotime($val['birthday']))?><br />职称：<?= '国家讲师'?><br />评分：<img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" /><img src="/images/xx.jpg" />
                                </p>
                            </a>
                        </div>
                    </li>
                <?php endforeach;?>
            <?php }?>
        </ul>
        <!--number-->
        <div class="number_box" style="margin:0 auto;width:520px">
            <?php
            echo \yii\widgets\LinkPager::widget(['pagination' => $data['pages']])
            ?>
        </div>
        <!--number-->
    </div>
    <!--市级教练员-->
</div>
</div>
</div>
</div>