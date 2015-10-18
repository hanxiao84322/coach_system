<?php
use yii\widgets\ActiveForm;
?>
<body>
<div class="login_top">
    <h1 class="fl"><img src="/images/logo.jpg" /></h1>
    <p class="login_two"><span>教练员管理系统</span></p>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="jl_check1">
    <div class="w10001">
        <div class="tabset1">
            <input type="text" name="credentials_number" placeholder="教练员身份证号" class="w235_s" />
            <input type="text" name="certificate_number" placeholder="教练员证书编号" class="w235_s" />
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="/images/searchbtn.jpg" /></a>
    </div>
</div>
<?php ActiveForm::end(); ?>

<div class="login_footer">
    <a href="javascript:;">首页</a>  |  <a href="javascript:;">最新动态</a>  | <a href="javascript:;"> 培训报名</a>  |  <a href="javascript:;">培训风采</a>  | <a href="javascript:;"> 教练员注册</a>  | <a href="javascript:;"> 教练员专栏</a>  |  <a href="javascript:;">政策法规</a>  |  <a href="javascript:;">足协官网</a>  | <a href="javascript:;"> 帮助中心</a> |  <a href="javascript:;">关于本站</a><br />
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持
</div>
</body>
</html>
