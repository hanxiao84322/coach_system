<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

?>
<script>
    $(function () {
        var ok1 = false;
        var ok2 = false;
        var ok3 = false;
        var ok4 = false;

        //验证地点
        $('input[name="UsersEducation[address]"]').focus(function () {
            $(this).next().text('填写地点').removeClass('state1').addClass('state2');
        }).blur(function () {
            if ($(this).val().length >= 2 && $(this).val().length <= 8 && $(this).val() != '') {
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok1 = true;
            } else {
                $(this).next().text('地点格式错误').removeClass('state1').addClass('state3');
            }

        });

        //验证学校名称
        $('input[name="UsersEducation[school]"]').focus(function () {
            $(this).next().text('填写学校名称').removeClass('state1').addClass('state2');
        }).blur(function () {
            if ($(this).val().length >= 2 && $(this).val().length <= 40 && $(this).val() != '') {
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok2 = true;
            } else {
                $(this).next().text('学校名称错误').removeClass('state1').addClass('state3');
            }

        })

        //验证证明人
        $('input[name="UsersEducation[witness]"]').focus(function () {
            $(this).next().text('填写证明人').removeClass('state1').addClass('state2');
        }).blur(function () {
            if ($(this).val().length >= 2 && $(this).val().length <= 8 && $(this).val() != '') {
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok3 = true;
            } else {
                $(this).next().text('证明人格式错误').removeClass('state1').addClass('state3');
            }

        })

        //验证描述
        $('input[name="UsersEducation[description]"]').focus(function () {
            $(this).next().text('填写描述').removeClass('state1').addClass('state2');
        }).blur(function () {
            if ($(this).val() != '') {
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok4 = true;
            } else {
                $(this).next().text('描述格式错误').removeClass('state1').addClass('state3');
            }

        })


        //提交按钮,所有验证通过方可提交

        $('input[name="submit"]').click(function () {
            if (ok1 && ok2 && ok3 && ok4) {
                return true;
            } else {
                return false;
            }
        });

    });
</script>

<!--content-->
<div class="content_box">
    <div class="con_set">
        <p class="p_jbinfor">基本信息</p>

        <div class="informatioin_self">

            <ul class="nrset_set">
                <li>
                    <h1><span>教育经历</span></h1>

                    <div class="form_input">
                        <div class="divp_pt">
                            <table cellpadding="0" cellspacing="0" class="wans_content">
                                <tr>
                                    <th>序</th>
                                    <th>效力球队</th>
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
                                            <td><?= ($val['level'] == 1) ? '高级' : '中级'?></td>
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
                                'action' => \yii\helpers\Url::to('/user/register-players')
                            ]); ?>
                            <table cellpadding="0" cellspacing="0" class="fixed_information">
                                <tr>
                                    <td colspan="2" style="color:#E4393D;">（未有运动经历的学员可不填写！）</td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>时间：</td>
                                    <td><?= DatePicker::widget([
                                            'attribute' => 'birthday',
                                            'name' => 'UsersEducation[begin_time]',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ],
                                        ]);?> 至 <?= DatePicker::widget([
                                            'attribute' => 'birthday',
                                            'name' => 'UsersEducation[end_time]',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ],
                                        ]);?>（不填表示至今）
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>地点：</td>
                                    <td><input type="text" value="" class="w400" name="UsersEducation[address]"/><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>任职：</td>
                                    <td><select class="w78" name="UsersPlayers[level]">
                                            <option value="1">高级</option>
                                            <option value="2">中级</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>效力球队：</td>
                                    <td><input type="text" value="" class="w189" name="UsersPlayers[team]"/> <span class='state1'></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>证明人：</td>
                                    <td><input type="text" value="" class="w189" name="UsersEducation[witness]"/> <span class='state1'></span>证明人电话：<input name="UsersEducation[witness_phone]" type="text" value="" class="w189"/></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top"><em>*</em>描述：</td>
                                    <td><textarea class="w480" name="UsersEducation[description]"></textarea><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input name="user_id" type="hidden" value="<?= $user_id?>"><input type="submit" value="保 存" class="fixe_btn"/><a href="<?= \yii\helpers\Url::to('/user-center/index')?>">会员中心</a></td>
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