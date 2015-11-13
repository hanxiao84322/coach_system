<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

<!--foooter-->
<div class="footer">
    <p><a href="<?= Url::to('/home/index')?>">首页</a>  |  <a href="<?= Url::to('/news/index')?>">最新动态</a>  | <a href="<?= Url::to('/train/index')?>"> 培训报名</a>  |  <a href="<?= Url::to(['/news/train','level_id' => 2])?>">培训风采 </a> | <a href="<?= Url::to('/user/register-coach')?>"> 教练员注册</a>  | <a href="<?= Url::to('/user/index')?>"> 教练员专栏</a>  | <a href="<?= Url::to(['/news/list', 'id' => 10])?>"> 政策法规</a>  | <a href="http://www.bj-fa.org.cn/" target="_blank"> 足协官网</a>  | <a href="<?= Url::to(['/pages/view', 'id' => 2])?>"> 帮助中心</a> | <a href="<?= Url::to(['/pages/view', 'id' => 6])?>"> 关于本站</a></p>
    版权所有：北京足球协会   地址：北京市宣武区先农坛体育场内2号楼 客服及报障电话：4008888888 <br />客服邮箱：beijingzuxie@beijingzuxie.org  ICP经营许可证：京ICP证888888 <br />本网站由北京我家科技发展有限公司提供制作及技术支持

</div>
<!--foooter-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
