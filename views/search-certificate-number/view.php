<body style="background:#efefef;">
<div class="zs_top">
    <div class="zstop_box">
        <span class="fl zsjl_name"><?= \app\models\Users::getOneUserNameById($data['user_id'])?> 北京市 <?= \app\models\Level::getOneLevelNameById($data['level_id']+1)?> 教练员证书</span>
        <p class="fr"><a href="javascript:window.print();" class="pre">打印证书</a><a href="javascript:window.close();" class="close">关闭</a></p>
    </div>
</div>
<div class="content_box">
    <div class="zs_img">
        <div class="zsBox">
            <p class="pimg80"><img src="/upload/images/users_info/photo/<?= \app\models\UsersInfo::getPhotoByUserId($data['user_id'])?>" /></p>
            <p class="puName">北京<?= \app\models\Level::getOneLevelNameById($data['level_id']+1)?>足球教练证书</p>
            <p class="pName"><?= \app\models\Users::getOneUserNameById($data['user_id'])?></p>
            <p class="psucessBox">成功完成"北京市<?= \app\models\Level::getOneLevelNameById($data['level_id']+1)?>足球教练员"全部培训课程<span>日期：<?= date('Y年m月d日', strtotime($data['end_date'])-(3600*24*365))?> ~ <?= date('Y年m月d日', strtotime($data['end_date']))?></span></p>
            <p class="bhBset">编号：<?= $data['certificate_number']?></p>
        </div>
    </div>
    <div class="bobj"></div>
</div>
</body>