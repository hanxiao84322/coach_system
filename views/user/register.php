<?php
use yii\widgets\ActiveForm;
?>
<script>
    $(function(){
        var ok1=false;
        var ok2=false;
        var ok3=false;
        //验证密码
        $('input[name="password"]').focus(function(){
            $(this).next().text('密码长多6~16位，数字、字母、字符至少包括两种').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 6 && $(this).val().length <=20 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok1=true;
            }else{
                $(this).next().text('密码长多6~16位，数字、字母、字符至少包括两种').removeClass('state1').addClass('state3');
            }

        });

        //验证确认密码
        $('input[name="password_repeat"]').focus(function(){
            $(this).next().text('输入的确认密码要和上面的密码一致,规则也要相同').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 6 && $(this).val().length <=20 && $(this).val()!='' && $(this).val() == $('input[name="password"]').val()){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok2=true;
            }else{
                $(this).next().text('输入的确认密码要和上面的密码一致,规则也要相同').removeClass('state1').addClass('state3');
            }

        });

        //验证邮箱
        $('input[name="email"]').focus(function(){
            $(this).next().text('请输入email').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().search(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/)==-1){
                $(this).next().text('请输入正确的EMAIL格式').removeClass('state1').addClass('state3');
            }else{
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok3=true;
            }

        });
        //提交按钮,所有验证通过方可提交

        $('input[name="submit"]').click(function(){
            if(ok1 && ok2 && ok3){
                return true;
            }else{
                return false;
            }
        });

    });
</script>
<?php $form = ActiveForm::begin([
    'id'=>'register',
    'enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/user/register')
]); ?>
<div class="bjsj_register">
    <div class="div_register">
        <p class="login_infro"><span>注册</span></p>
        <p class="dl_check"><a href="<?= \yii\helpers\Url::to(['/user/register', 'type' => 'email'])?>" class="hover">用邮箱注册</a><a href="<?= \yii\helpers\Url::to(['/user/register', 'type' => 'mobile_phone'])?>">用手机号码注册</a></p>
        <table cellpadding="0" cellspacing="0" class="table_login">
            <?php if ($type == 'email') {?>
            <tr>
                <td width="145" align="right"><b>*</b>邮箱地址：</td>
                <td><input type="text" name="email" class="phone"><span class='state1'></span></td>
            </tr>
            <?php } else {?>
            <tr>
                <td width="145" align="right"><b>*</b>手机号码：</td>
                <td><input type="text" value="" name="phone" class="phone"<span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><b>*</b>验证码：</td>
                <td><input type="text" value="" class="w130"><input type="button" name="check_num" value="获取短信验证码" class="button_hq" /> 请输入手机收到的验证码。如果一段时间没收到，请重新获取</td>
            </tr>
            <?php }?>
            <tr>
                <td align="right"><b>*</b>设置密码：</td>
                <td><input type="password" name="password" class="password"> <span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><b>*</b>确认密码：</td>
                <td><input type="password" name="password_repeat" class="password"><span class='state1'></span> </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="checkbox" checked value="1" name="is_agree" /><span class='state1'></span> &nbsp;我已阅读并同意<a href="<?= \yii\helpers\Url::to(['pages/view','id'=>'1'])?>" target="_blank">《北京足协教练员注册管理协议》</a></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="提交报名申请" class="button_btn" name="submit" id="submit"/> <span></span></td>
            </tr>
        </table>
    </div>
</div>
<?php ActiveForm::end(); ?>

