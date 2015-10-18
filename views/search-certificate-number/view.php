<body style="background:#efefef;">
<div class="zs_top">
    <div class="zstop_box">
        <span class="fl zsjl_name"><?= \app\models\Users::getOneUserNameById($data['user_id'])?> 北京市<?= \app\models\Level::getOneLevelNameById($data['level_id'])?>教练员证书</span>
        <p class="fr"><a href="javascript:;" class="pre">打印证书</a><a href="javascript:;" class="close">关闭</a></p>
    </div>
</div>
<div class="zs_img">
    <img src="/upload/images/users_level/credentials_photo/<?= $data['credentials_photo']?>" width="951" height="649" />
</div>
<div class="bobj"></div>