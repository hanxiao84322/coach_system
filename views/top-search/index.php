<script LANGUAGE = "JavaScript" >
    function checkValue()
    {
        $("#search").submit();

    }
</script>

<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<div class="login_top">
    <h1 class="fl"><img src="/images/logo.jpg" /></h1>
    <p class="login_two"><a href="<?= \yii\helpers\Url::to('/home/index')?>"><span>教练员管理系统</span></a></p>
</div>
<?php $form = ActiveForm::begin([
    'id'=>'search',
    'enableAjaxValidation' => false,
    'action' => \yii\helpers\Url::to('/search/index'),
    'method' => 'get'
]); ?>
<div class="jl_check">
    <div class="w1000">
        <div class="tabset">
            <input type="text" name="keyword" placeholder="教练员姓名/身份证号/证书编号" class="fl w240_i" />
            <p class="w100 fl"><select class="fl w100_i" name="level_id">
                    <option value="" selected>不限级别</option>
                    <?php if (!empty($data['levelList'])) {?>
                        <?php foreach ($data['levelList'] as $key => $val) :?>
                        <option value="<?= $val['id']?>"><?= $val['name']?></option>
                        <?php endforeach;?>
                    <?php }?>
            </select></p>
            <p class="w100 fl"><select class="fl w100_i" name="sex"><option value="">不限性别</option><option value="1">男</option><option value="2">女</option></select></p>
            <p class="w140"><select class="fl w140_i" name="district">
                    <option value="" selected>不限区域</option>
                    <?php if (!empty($data['districtList'])) {?>
                        <?php foreach ($data['districtList'] as $key => $val) :?>
                            <option value="<?= $val?>"><?= $val?></option>
                        <?php endforeach;?>
                    <?php }?></select></p>
        </div>
        <a href="javascript:void(0);" onClick="javascript:return checkValue();" class="ssearchbtn"><img src="/images/searchbtn.jpg" /></a>
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="login_footer">
    <p><a href="<?= Url::to('/home/index')?>">首页</a>  |  <a href="<?= Url::to('/news/index')?>">最新动态</a>  | <a href="<?= Url::to('/train/index')?>"> 培训报名</a>  |  <a href="<?= Url::to(['/news/train','level_id' => 2])?>">培训风采 </a> | <a href="<?= Url::to('/user/register-coach')?>"> 教练员注册</a>  | <a href="<?= Url::to('/user/index')?>"> 教练员专栏</a>  | <a href="<?= Url::to(['/news/list', 'id' => 10])?>"> 政策法规</a>  | <a href="http://www.bj-fa.org.cn/" target="_blank"> 足协官网</a>  | <a href="<?= Url::to(['/pages/view', 'id' => 2])?>"> 帮助中心</a> | <a href="<?= Url::to(['/pages/view', 'id' => 6])?>"> 关于本站</a></p>
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持
</div>
