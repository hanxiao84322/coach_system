<!--banner-->
<div class="bjsj_register">
    <div class="div_register1">
        <p class="login_infro"><span>报名成功</span></p>
    <p class="login_infro1">【 <?= Yii::$app->user->identity->username?> 您是：第<?= $data['orders']?>位  报名申请<?= $data['trainName']?>  】</p>
        <p class="success_set"><span> <img src="/images/success.jpg" />报名成功！！！	欢迎报名参加<?= $data['trainName']?></span></p>
        <p class="success_infro"><span>我们将在7-14个工作日审核您的信息，并将通过您预留的联系方式反馈报名申请信息结果，尽请留意查看！</span>您的电话为：<?= Yii::$app->user->identity->mobile_phone ?>，电子邮件为：<?= Yii::$app->user->identity->email?><br />
            您也可登陆 <a href="<?= \yii\helpers\Url::to('/user-center/index')?>">个人管理</a> 页面进行相关操作！
            <b>如系统30秒之内无法自动跳转，请点击<a href="<?= \yii\helpers\Url::to('/user-center/index')?>">这里</a> !</b></p>
    </div>
</div>
<!--banner-->