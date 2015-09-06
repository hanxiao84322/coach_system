<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

?>
<script>
    $(function(){
        var ok1=false;
        var ok2=false;
        var ok3=false;
        var ok4=false;
        var ok5=false;
        var ok6=false;
        var ok7=false;
        var ok8=false;
        var ok9=false;
        var ok10=false;
        var ok11=false;
        var ok12=false;
        var ok13=false;

        //验证密码
        $('input[name="username"]').focus(function(){
            $(this).next().text('填写姓名').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 2 && $(this).val().length <=8 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok1=true;
            }else{
                $(this).next().text('姓名格式错误').removeClass('state1').addClass('state3');
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
                $('registerInfo').submit();
            }else{
                return false;
            }
        });

    });
</script>
<?php $form = ActiveForm::begin([
    'id'=>'registerInfo',
    'enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/user/register-education')
]); ?>
<!--content-->
<div class="content_box">
<div class="con_set">
<p class="p_jbinfor">基本信息（<span>未填写完整</span>）</p>
<div class="informatioin_self">

<ul class="nrset_set">
<li>
    <h1 class="hover"><span>个人信息</span>已完善（1条）</h1>
    <div class="form_input" style="display:block;">
        <table cellpadding="0" cellspacing="0" class="fixed_information">
            <tr>
                <td align="right"><em>*</em><b>姓</b>名：</td>
                <td><span><input type="text" value="" class="w189" name="username" /></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>上传照片：</td>
                <td><span><a href="javascript:;"><img src="/images/up1.jpg" /></a></span><span class="green">(请提交2寸白底标准免冠照片，300KB以内)</span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>性</b>别：</td></span>
                <td><input type="radio" name="sex" checked="checked" /> 男 <input type="radio" name="sex" /> 女</td>
            </tr>
            <tr>
                <td align="right"><em>*</em>出生日期：</td><span class='state1'></span>
                <td><?= DatePicker::widget([
                        'attribute' => 'birthday',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-M-yyyy'
                        ],
                    ]);?></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>证</b>件：</td><span class='state1'></span>
                <td><span><select class="w78" name="credentials_type"><option>身份证</option></select></span><span><input type="text" value="" name="credentials_number" class="w189" /></span><span><a href="javascript:;"><img src="images/up.jpg" /></a></span><span class="green">(通过审核,500KG)</span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>户口所在地：</td><span class='state1'></span>
                <td><select class="w78" name="account_location"><option>北京</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>联系电话：</td><span class='state1'></span>
                <td><input type="text" value="" class="w189" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>联系手机：</td><span class='state1'></span>
                <td><input type="text" value="" class="w189" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>电子邮箱：</td><span class='state1'></span>
                <td><input type="text" value="" class="w189" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>身</b>高：</td><span class='state1'></span>
                <td><input type="text" value="" class="w60" /> 厘米</td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>体</b>重：</td><span class='state1'></span>
                <td><input type="text" value="" class="w60" /> 公斤</td>
            </tr>
            <tr>
                <td align="right"><em>*</em>既往伤病：</td><span class='state1'></span>
                <td><select class="w78"><option>无伤病</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>通信地址：</td><span class='state1'></span>
                <td><input type="text" value="" class="w400" /> 邮编：<input type="text" value="" class="w189" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位名称：</td><span class='state1'></span>
                <td><input type="text" value="" class="w400" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位地址：</td><span class='state1'></span>
                <td><input type="text" value="" class="w400" /> 邮编：<input type="text" value="" class="w189" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位电话：</td><span class='state1'></span>
                <td><input type="text" value="" class="w189" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>装备尺码：</td>
                <td>训练套服 <select><option>S</option></select> 训练T恤 <select><option>S</option></select> 训练短裤 <select><option>S</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>外语情况：</td>
                <td><select class="w78"><option>英语</option></select>&nbsp;&nbsp;&nbsp;口语&nbsp;&nbsp;&nbsp;<select class="w78"><option>精通</option></select>&nbsp;&nbsp;&nbsp;书写&nbsp;&nbsp;&nbsp;<select class="w78"><option>精通</option></select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="保 存" class="fixe_btn" /></td>
            </tr>
        </table>
    </div>
</li>

</ul>

</div>
</div>
</div>
<?php ActiveForm::end(); ?>
<!--content-->