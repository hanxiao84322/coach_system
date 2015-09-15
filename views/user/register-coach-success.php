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
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b>教练员注册
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con3">
            <div class="dib_boxet">
                <div class="w330 fl">
                    <p>教练员注册<span>公告</span></p>
                    <?= $data['regComment']?>
                </div>
                <div class="fr w320">
                    <h3 class="wh3_set"><span>最新注册</span><a href="<?= \yii\helpers\Url::to(['/news/list', 'category_id' => 8])?>">更多>></a></h3>
                    <ul class="ul_list1">
                        <?php if (!empty($data['newRegNews'])) {?>
                            <?php foreach ($data['newRegNews'] as $key => $val) :?>
                                <li><a href="<?= \yii\helpers\Url::to(['/news/view/', 'id' => $val['id']])?>"><?= $val['title']?></a><span><?= date('Y-m-d', strtotime($val['create_time']))?></span></li>
                            <?php endforeach;?>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="zhuce_set" style="margin-bottom:20px;">
                <table cellpadding="0" cellspacing="0" class="table_he10">
                    <tr>
                        <td>身份证号：</td>
                        <td><input type="text" value="<?= $data['userLevelInfo']['credentials_number']?>" class="w218_dg" /></td>
                    </tr>
                    <tr>
                        <td>教练证号：</td>
                        <td><input type="text" value="<?= $data['userLevelInfo']['certificate_number']?>" class="w218_dg" /></td>
                    </tr>
                </table>
            </div>
            <p class="p_success"><img src="/images/success.jpg" /><br /><span>验证成功！</span><br />恭喜-<?= $data['userName']?> 获得<?= $data['levelName']?>教练员资格，请获取证书，完成晋升，开始真正体验<?= $data['levelName']?>教练员的权益。<br><a href="<?= \yii\helpers\Url::to('/user-center/index')?>">如系统20秒之内未完成跳转，请（点击这里）完成注册。</a></p>
            <div class="input_btn">
                <input type="submit" value="" class="submit_btn1" />
            </div>
            <p class="attention"><b>（注）</b>如果您获得了教练员资格，请输入个人准确的身份证号、教练员证号，进行教练员验证，并完成注册！</p>
        </div>
    </div>
</div>
<!--content-->