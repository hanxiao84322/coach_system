<!--banner-->
<div class="pxfc_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b>培训风采
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
<div class="con_set">
<div class="news_con1">
<!--adv-->
<div class="adv0">
    <div class="adv_s">
        <div class="leftLoop">
            <div class="bd">
                <ul class="picList">
                    <?php if (!empty($data['imgNews'])) {?>
                        <?php foreach ($data['imgNews'] as $key => $val) :?>
                            <li>
                                <div class="pic">
                                    <a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="<?= '/upload/images/news/thumb/'.$val['thumb']?>" width="890" height="285" /></a>
                                </div>
                                <div class="content_pic">
                                    <?= $val['title']?>
                                </div>
                            </li>
                        <?php endforeach;?>
                    <?php }?>
                </ul>
            </div>
            <div class="hd">
                <div class="sj_mark">
                    <a class="next"></a>
                    <a class="prev"></a>
                </div>
                <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

            </div>
        </div>
    </div>
    <script type="text/javascript">jQuery(".leftLoop").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});</script>
</div>
<!--adv-->
<!--讲师团队-->
<h3 class="jjfc_set"><span class="fl">讲师团队</span><span class="fr span_set">截止到<?= date('Y年m月d日', time())?>,共有（<b><?= $data['teachersCount']?></b>）位讲师<a href="<?= \yii\helpers\Url::to('/teachers/index')?>">查看全部>></a></span></h3>
<div class="box_table">
    <div class="adva">
        <div class="adva0">
            <div class="leftLoop1">
                <div class="bd">
                    <ul class="picList">
                        <?php foreach ($data['trainTeachers'] as $key => $val) :?>
                            <li>
                                <div class="pic">
                                    <a href="<?= \yii\helpers\Url::to(['teachers/view', 'id' => $val['id']])?>">
                                        <span><img src="/upload/images/teachers/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                        <p>
                                            姓名：<?= $val['name']?><br />年龄：<?= $val['age']?><br />职称：<?= app\models\Teachers::getLevelName($val['level'])?><br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                        </p>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="hd">
                    <a class="next"></a>
                    <a class="prev"></a>
                    <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                </div>
            </div>
            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
        </div>
    </div>
</div>
<!--讲师团队-->
<!--培训风采-->
<div class="tabs martop">
<h3 class="title_h42"><a href="<?= \yii\helpers\Url::to(['/news/train','level_id' => '2'])?>" <?php if ($data['levelId'] == 2) {?>class="hover"<?php }?>>北京市市级教练员培训</a><a href="<?= \yii\helpers\Url::to(['/news/train','level_id' => '3'])?>" <?php if ($data['levelId'] == 3) {?>class="hover"<?php }?>>D级教练员培训</a><a href="<?= \yii\helpers\Url::to(['/news/train','level_id' => '4'])?>" <?php if ($data['levelId'] == 4) {?>class="hover"<?php }?>>C级教练员培训</a><span class="pxke_Set">培训风采</span></h3>
<!--北京市市级教练员培训-->
<div class="tab_son">
    <p class="sjbtn_p"><span class="fl">截止到<?= date('Y年m月d日', time())?>,共有（<b><?= $data['trainCount']?></b>）期 市级 教练员培训班</span><a href="javascript:;">查看全部>></a></p>
    <ul class="ClearFix h390">
        <?php foreach ($data['trainWind'] as $key => $val) :?>
            <?php if ((($key+1)%4 == 0)) {?>
                <li class="mro"><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="219" height="146" /></a><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></li>
            <?php } else  {?>
                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="219" height="146" /></a><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></li>
            <?php }?>
        <?php endforeach;?>
    </ul>
    <h3 class="jjfc_set1"><span class="fl">培训地点</span><span class="fr span_set"><a href="<?= \yii\helpers\Url::to(['/news/list', 'category_id' => 9])?>">查看全部>></a></span></h3>
    <ul class="ClearFix h200">
        <?php foreach ($data['newsPlace'] as $key => $val) :?>
        <?php if ((($key+1)%4 == 0)) {?>
                <li class="mro"><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="219" height="146" /></a><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></li>
            <?php } else  {?>
                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><img src="/upload/images/news/thumb/<?= $val['thumb']?>" width="219" height="146" /></a><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a></li>

            <?php }?>


        <?php endforeach;?>
    </ul>
</div>
<!--北京市市级教练员培训-->
</div>
<!--培训风采-->
</div>
</div>
</div>
<!--content-->