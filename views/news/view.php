<!--banner-->
<div class="news_banner">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b><?= \app\models\NewsCategory::getOneCategoryNameById($newInfo['category_id'])?>
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con">
            <h1 class="cont_h1title"><?= $newInfo['title']?></h1>
            <p class="time_date"><?= $newInfo['create_time']?> <?= $newInfo['create_user']?></p>
            <div class="fx_Set"><div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script></div>
            <div class="con_picset">
                <?php if (!empty($newInfo['thumb'])) {?>
                <img src="/upload/images/news/thumb/<?= $newInfo['thumb']?>" />
                <?php }?>
            </div>
            <div class="xiangguan_set">
                <h3 class="xgnews">相关新闻</h3>
                <ul class="ul_list2">
                    <?php if (!empty($aboutNewsList)) {?>
                        <?php foreach ($aboutNewsList as $key => $val) :?>
                            <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></li>
                        <?php endforeach;?>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--content-->