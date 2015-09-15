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
            <?php $form = ActiveForm::begin([
                'id'=>'register',
                'enableAjaxValidation' => false,
                'action' => \yii\helpers\Url::to('/user/register-coach')
            ]); ?>
            <div class="zhuce_set">

                <table cellpadding="0" cellspacing="0" class="table_he10">
                    <tr>
                        <td>身份证号：</td>
                        <td><input type="text" value="请输入身份证号码" class="w218"  name="credentials_number"/></td>
                    </tr>
                    <tr>
                        <td>教练证号：</td>
                        <td><input type="text" value="请输入教练员证书编码" class="w218" name="certificate_number" /></td>
                    </tr>
                </table>
            </div>
            <div class="input_btn">
                <input type="submit" value="" class="submit_btn" />
            </div>
            <?php ActiveForm::end(); ?>
            <p class="attention"><b>（注）</b>如果您获得了教练员资格，请输入个人准确的身份证号、教练员证号，进行教练员验证，并完成注册！</p>
        </div>
    </div>
</div>
<!--content-->