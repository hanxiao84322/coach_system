<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

?>
<!--content-->
<style>
    .rgsd_box_set{padding:30px 0 0;height:67px;}
    .reg_mark{float:left;}
    .reg_lc{float:right;width:774px;background:url(/images/xian.png) no-repeat center 5px;margin-top:10px;}
    .reg_lc ul li{float:left;width:129px;text-align:center;font-size:16px;color:#666;}
    .reg_lc ul li span{display:block;width:13px;height:13px;background:url(/images/wxz.png) no-repeat center top;margin:0 auto;padding-bottom:10px;}
    .reg_lc ul li span.hover{display:block;width:13px;height:13px;background:url(/images/xz.png) no-repeat center top;margin:0 auto;padding-bottom:10px;}
    .reg_lc ul li.hover{color:#438C0C;}
</style>
<div class="content_box">
    <div class="con_set">
        <div class="rgsd_box_set">
            <div class="reg_mark">
                <img src="/images/reg.png">
            </div>
            <div class="reg_lc">
                <ul>
                    <li class="hover"><span class="hover"></span>基本信息</li>
                    <li><span></span>教育经历</li>
                    <li><span></span>培训经历</li>
                    <li><span></span>执教经历</li>
                    <li><span></span>运动经历</li>
                    <li><span></span>提交成功</li>
                </ul>
            </div>
        </div>
        <p class="p_jbinfor">基本信息</p>

        <div class="informatioin_self">

            <ul class="nrset_set">
                <li>
                    <h1><span>执教经历</span></h1>

                    <div class="form_input">
                        <div class="divp_pt">
                            <table cellpadding="0" cellspacing="0" class="wans_content">
                                <tr>
                                    <th>序</th>
                                    <th>执教球队</th>
                                    <th>时间</th>
                                    <th>任职</th>
                                    <th>操作</th>
                                </tr>
                                <?php if (!empty($model)) {?>
                                    <?php foreach ($model as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><?= $val['team'] ?></td>
                                            <td><?= date('Y-m-d',strtotime($val['begin_time']))?> - <?= date('Y-m-d',strtotime($val['end_time']))?></td>
                                            <td><?= ($val['post'] == 1) ? '市级' : '国家级'?></td>
                                            <td><a href="javascript:;">删除</a></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php } else {?>
                                    <tr>
                                        <td colspan="5">请添加教育经历</td>
                                    </tr>
                                <?php }?>
                            </table>
                            <?php $form = ActiveForm::begin([
                                'id' => 'registerInfo',
                                'enableAjaxValidation' => false,
                                'action' => \yii\helpers\Url::to('/user/register-vocational')
                            ]); ?>
                            <table cellpadding="0" cellspacing="0" class="fixed_information">
                                <tr>
                                    <td colspan="2" style="color:#E4393D;">（未有执教经历的学员可不填写！）</td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>时间：</td>
                                    <td><?= DatePicker::widget([
                                            'attribute' => 'birthday',
                                            'name' => 'UsersVocational[begin_time]',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ],
                                        ]);?> 至 <?= DatePicker::widget([
                                            'attribute' => 'birthday',
                                            'name' => 'UsersVocational[end_time]',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ],
                                        ]);?>（不填表示至今）
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>地点：</td>
                                    <td><input type="text" value="" class="w400" name="UsersVocational[address]"/><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>执教球队：</td>
                                    <td><input type="text" value="" class="w400" name="UsersVocational[team]"/><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>任职：</td>
                                    <td><select class="w78" name="UsersVocational[post]">
                                            <option value="1">市级</option>
                                            <option value="2">国家级</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>证明人：</td>
                                    <td><input type="text" value="" class="w189" name="UsersVocational[witness]"/> <span class='state1'></span>证明人电话：<input name="UsersVocational[witness_phone]" type="text" value="" class="w189"/></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top"><em>*</em>描述：</td>
                                    <td><textarea class="w480" name="UsersVocational[description]"></textarea><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input name="train_id" type="hidden" value="<?= $train_id?>"><input type="submit" value="保 存" class="fixe_btn"/><a href="<?= \yii\helpers\Url::to(['/user/register-players','train_id' => $train_id])?>">添加运动信息</a><a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $train_id])?>">填写完成</a></td>
                                </tr>
                            </table>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </li>

            </ul>

        </div>
    </div>
</div>
<!--content-->