<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<script>
    $(function(){
        var ok1=false;
        var ok3=false;
        var ok5=false;
        var ok7=false;
        var ok8=false;
        var ok9=false;
        var ok10=false;
        var ok11=false;
        var ok12=false;

        //验证姓名
        $('input[name="UsersInfo[name]"]').focus(function(){
            $(this).next().text('填写姓名').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 2 && $(this).val().length <=8 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok1=true;
            }else{
                $(this).next().text('姓名格式错误').removeClass('state1').addClass('state3');
            }

        });

        //验证身份证
        $('input[name="UsersInfo[credentials_number]"]').focus(function(){
            $(this).next().text('填写证件号码').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 18 && $(this).val().length <=19 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok3=true;
            }else{
                $(this).next().text('证件格式错误').removeClass('state1').addClass('state3');
            }

        })

        //验证座机
        $('input[name="UsersInfo[telephone]"]').focus(function(){
            $(this).next().text('填写座机号码').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 6 && $(this).val().length <=12 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok5=true;
            }else{
                $(this).next().text('座机号码格式错误').removeClass('state1').addClass('state3');
            }

        })

        //验证身高
        $('input[name="UsersInfo[height]"]').focus(function(){
            $(this).next().text('填写身高').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok7=true;
            }else{
                $(this).next().text('身高格式错误').removeClass('state1').addClass('state3');
            }

        })


        //验证体重
        $('input[name="UsersInfo[weight]"]').focus(function(){
            $(this).next().text('填写体重').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok8=true;
            }else{
                $(this).next().text('体重格式错误').removeClass('state1').addClass('state3');
            }

        })

        //验证通信地址
        $('input[name="UsersInfo[contact_address]"]').focus(function(){
            $(this).next().text('填写通信地址').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 2 && $(this).val().length <=30 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok9=true;
            }else{
                $(this).next().text('通信地址格式错误').removeClass('state1').addClass('state3');
            }

        })

        //验证公司名称
        $('input[name="UsersInfo[company_name]"]').focus(function(){
            $(this).next().text('填写公司名称').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 1 && $(this).val().length <=30 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok10=true;
            }else{
                $(this).next().text('公司名称格式错误').removeClass('state1').addClass('state3');
            }

        })

        //验证公司地址
        $('input[name="UsersInfo[company_address]"]').focus(function(){
            $(this).next().text('填写公司地址').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 2 && $(this).val().length <=30 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok11=true;
            }else{
                $(this).next().text('公司地址格式错误').removeClass('state1').addClass('state3');
            }
        })



        //验证公司电话
        $('input[name="UsersInfo[company_contact_phone]"]').focus(function(){
            $(this).next().text('填写公司联系电话').removeClass('state1').addClass('state2');
        }).blur(function(){
            if($(this).val().length >= 6 && $(this).val().length <=12 && $(this).val()!=''){
                $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                ok12=true;
            }else{
                $(this).next().text('公司联系电话格式错误').removeClass('state1').addClass('state3');
            }
        })

        //提交按钮,所有验证通过方可提交

        $('input[name="submit"]').click(function(){
            if(ok1 && ok3 && ok5 && ok7 && ok8 && ok9 && ok10 && ok11 && ok12){
                return true;
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
    'action' => \yii\helpers\Url::to('/user/register-info')
]); ?>
<!--content-->
<div class="content_box">
<div class="con_set">
<p class="p_jbinfor">基本信息</p>
<div class="informatioin_self">

<ul class="nrset_set">
<li>
    <h1 class="hover"><span>个人信息</span></h1>
    <div class="form_input" style="display:block;">
        <table cellpadding="0" cellspacing="0" class="fixed_information">
            <tr>
                <td align="right"><em>*</em><b>姓</b>名：</td>
                <td><span><input type="text" value="<?= $model->name?>" class="w189" name="UsersInfo[name]" /><span class='state1'></span></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>上传照片：</td>
                    <td><span><input name="UsersInfo[photo]" type="file" value="上传2寸照片"></span><span class="green">(请提交2寸白底标准免冠照片，300KB以内，格式JPG,GIF)</span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>性</b>别：</td></span>
                <td><input type="radio" name="UsersInfo[sex]" checked="checked" value="1" /> 男 <input type="radio" name="UsersInfo[sex]"  value="2"/> 女</td>
            </tr>
            <tr>
                <td align="right"><em>*</em>出生日期：</td>
                <td><?= DatePicker::widget([
                        'attribute' => 'birthday',
                        'name' => 'UsersInfo[birthday]',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-M-yyyy',
                        ],
                    ]);?><span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>证</b>件：</td>
                <td><span><select class="w78" name="UsersInfo[credentials_type]"><option value="1">身份证</option></select></span><span><input type="text" value="<?= $model->credentials_number?>" name="UsersInfo[credentials_number]" class="w189" /><span class='state1'></span></span><span><input name="UsersInfo[credentials_photo]" type="file""></span><span class="green">(500KB以内，格式JPG,GIF)</span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>户口所在地：</td>
                <td><select class="w78" name="UsersInfo[account_location]"><option>北京</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>联系电话：</td>
                <td><input type="text" value="<?= $model->telephone?>" class="w189" name="UsersInfo[telephone]" /><span class='state1'></span></td>
            </tr>
            <?php if (!empty($userModel->mobile_phone)) {?>
            <tr>
                <td align="right"><em>*</em>联系手机：</td>
                <td><input type="text" value="<?= $userModel->mobile_phone?>" disabled="disabled" class="w189" name="UsersInfo[mobile_phone]" /><span class='state1'></span></td>
            </tr>
            <?php } else {?>
                <td align="right"><em>*</em>联系手机：</td>
                <td><input type="text" value="" class="w189" name="UsersInfo[mobile_phone]" /><span class='state1'></span></td>
            <?php }?>
            <?php if (!empty($userModel->email)) {?>
            <tr>
                <td align="right"><em>*</em>电子邮箱：</td>
                <td><input type="text" value="<?= $userModel->email?>" disabled="disabled" class="w189" name="UsersInfo[email]" /><span class='state1'></span></td>
            </tr>
            <?php } else {?>
                <td align="right"><em>*</em>联系手机：</td>
                <td><input type="text" value="" class="w189" name="UsersInfo[email]" /><span class='state1'></span></td>
            <?php }?>
            <tr>
                <td align="right"><em>*</em><b>身</b>高：</td>
                <td><input type="text" value="<?= $model->height?>" class="w60" name="UsersInfo[height]" /> 厘米<span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>体</b>重：</td>
                <td><input type="text" value="<?= $model->weight?>" class="w60" name="UsersInfo[weight]" /> 公斤<span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>既往伤病：</td>
                <td><select class="w78" name="UsersInfo[disease_history]"><option value="0">无伤病</option><option value="1">有伤病</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>通信地址：</td>
                <td><input type="text" value="<?= $model->contact_address?>" class="w400" name="UsersInfo[contact_address]" /> <span class='state1'></span>邮编：<input type="text" value="" class="w189" name="UsersInfo[contact_postcode]" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位名称：</td>
                <td><input type="text" value="<?= $model->company_name?>" class="w400" name="UsersInfo[company_name]" /><span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位地址：</td>
                <td><input type="text" value="<?= $model->company_address?>" class="w400" name="UsersInfo[company_address]" /> 邮编：<span class='state1'></span><input type="text" value="<?= $model->company_postcode?>" class="w189" name="UsersInfo[company_postcode]" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位电话：</td>
                <td><input type="text" value="<?= $model->company_contact_phone?>" class="w189" name="UsersInfo[company_contact_phone]" /><span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>装备尺码：</td>
                <td>训练套服
                    <select name="UsersInfo[clothes_size]">
                        <?php foreach(\app\models\UsersInfo::$sizeList as $key => $val) :?>
                        <option value="<?= $key?>"><?= $val?></option>
                        <?php endforeach;?>
                    </select>
                    训练T恤
                    <select name="UsersInfo[t_shirt_size]">
                        <?php foreach(\app\models\UsersInfo::$sizeList as $key => $val) :?>
                            <option value="<?= $key?>"><?= $val?></option>
                        <?php endforeach;?>
                    </select>
                    训练短裤
                    <select name="UsersInfo[shorts_size]">
                        <?php foreach(\app\models\UsersInfo::$sizeList as $key => $val) :?>
                            <option value="<?= $key?>"><?= $val?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><em>*</em>外语情况：</td>
                <td><select class="w78" name="UsersInfo[language]"><option value="1">英语</option></select>&nbsp;&nbsp;&nbsp;口语&nbsp;&nbsp;&nbsp;<select class="w78" name="UsersInfo[spoken_language]"><option value="1">精通</option></select>&nbsp;&nbsp;&nbsp;书写&nbsp;&nbsp;&nbsp;<select class="w78" name="UsersInfo[write_language]"><option value="1">精通</option></select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="保 存" name="submit" class="fixe_btn" /><a href="<?= \yii\helpers\Url::to('/user/register-education')?>">下一步，填写教育信息</a></td>
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