<script language="javascript" type="text/javascript" src="/js/My97DatePicker/WdatePicker.js"></script>
<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

?>

<div class="content_user">
<div class="max_width">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<?= $this->render('left', ['data' => $data]); ?>
<td valign="top">
<div class="content_box">
<?php if ($data['content']) {?>
    <h2 style="text-align: center;">您好,请先完善信息！后台审核通过后才能报名！</h2>
<?php }?>
<h3 class="h3_h40s">个人信息</h3>

<div class="boxset_content">
<ul class="nrset_set">
<li>
<style>
.tam{color:#ff2323; padding-top: 10px;margin-left:10px;padding-right:0px;}
#ddd2{float:left;margin-left:10px;padding-right:0px;}
#ddd1{}
#ddd9{float:left;}
</style>
<h1 class="hover"><span>个人信息</span>已完善</h1>

<div class="form_input" style="display:block;">
<?php $form = ActiveForm::begin([
    'id' => 'registerInfo',
    'enableAjaxValidation' => false,
    'options' => ['enctype' => 'multipart/form-data','onsubmit'=>'return checkSubmit();'],
    'action' => \yii\helpers\Url::to('/user-center/user-info')
]); ?>
<table cellpadding="0" cellspacing="0" class="fixed_information">
<tr>
    <td align="right"><em>*</em><b>姓</b>名：</td>
    <td><span><input type="text" value="<?= $model->name ?>" id="dd1" class="w189" name="UsersInfo[name]"/></span><b class="tam" id="ddd1"></b></td>
</tr>
<?php if (!empty($model->photo)) { ?>
    <tr>
        <td align="right"><em>*</em>上传照片：</td>
        <td><span><input name="UsersInfo[photo]" type="file" value="上传2寸照片"></span><input type="hidden"
                                                                                          name="UsersInfo[old_photo]" id="dd10"
                                                                                          value="<?= $model->photo ?>"><b class="tam" id="ddd10"></b><span
                class="green">(请提交2寸白底标准免冠照片，300KB以内，格式JPG,GIF)</span></td>
    </tr>
<?php } else { ?>
    <tr>
        <td align="right"><em>*</em>上传照片：</td>
        <td><span><input name="UsersInfo[photo]" id="dd8" type="file" value="上传2寸照片"></span><b class="tam" id="ddd8"></b><span class="green">(请提交2寸白底标准免冠照片，300KB以内，格式JPG,GIF)</span>
        </td>
    </tr>
<?php } ?>
<tr>
    <td align="right"><em>*</em><b>性</b>别：</td>
    </span>
    <td><input type="radio" name="UsersInfo[sex]"
               <?php if ($model->sex == 1 || empty($model->sex)) { ?>checked="checked" <?php } ?>value="1"/> 男 <input
            type="radio" name="UsersInfo[sex]" <?php if ($model->sex == 2) { ?>checked="checked" <?php } ?> value="2"/>
        女
    </td>
</tr>
<tr>
    <td align="right"><em>*</em>出生日期：</td>
    <td><select id="form_dob_year" name="year">
            <option value="">请选择</option>
            <option value="2011">2011</option>
            <option value="2010">2010</option>
            <option value="2009">2009</option>
            <option value="2008">2008</option>
            <option value="2007">2007</option>
            <option value="2006">2006</option>
            <option value="2005">2005</option>
            <option value="2004">2004</option>
            <option value="2003">2003</option>
            <option value="2002">2002</option>
            <option value="2001">2001</option>
            <option value="2000">2000</option>
            <option value="1999">1999</option>
            <option value="1998">1998</option>
            <option value="1997">1997</option>
            <option value="1996">1996</option>
            <option value="1995">1995</option>
            <option value="1994">1994</option>
            <option value="1993">1993</option>
            <option value="1992">1992</option>
            <option value="1991">1991</option>
            <option value="1990">1990</option>
            <option value="1989">1989</option>
            <option value="1988">1988</option>
            <option value="1987">1987</option>
            <option value="1986">1986</option>
            <option value="1985">1985</option>
            <option value="1984">1984</option>
            <option value="1983">1983</option>
            <option value="1982">1982</option>
            <option value="1981">1981</option>
            <option value="1980">1980</option>
            <option value="1979">1979</option>
            <option value="1978">1978</option>
            <option value="1977">1977</option>
            <option value="1976">1976</option>
            <option value="1975">1975</option>
            <option value="1974">1974</option>
            <option value="1973">1973</option>
            <option value="1972">1972</option>
            <option value="1971">1971</option>
            <option value="1970">1970</option>
            <option value="1969">1969</option>
            <option value="1968">1968</option>
            <option value="1967">1967</option>
            <option value="1966">1966</option>
            <option value="1965">1965</option>
            <option value="1964">1964</option>
            <option value="1963">1963</option>
            <option value="1962">1962</option>
            <option value="1961">1961</option>
            <option value="1960">1960</option>
            <option value="1959">1959</option>
        </select>年<select id="form_dob_month" name="month">
            <option value="">请选择</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>月
        <select id="form_dob_day" name="day">
            <option value="">请选择</option>
            <option value="01">1</option>
            <option value="02">2</option>
            <option value="03">3</option>
            <option value="04">4</option>
            <option value="05">5</option>
            <option value="06">6</option>
            <option value="07">7</option>
            <option value="08">8</option>
            <option value="09">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>日
    </td>
</tr>
<tr>
    <td align="right"><em>*</em><b>证</b>件：</td>
    <td><span><select class="w78" name="UsersInfo[credentials_type]">
                <option value="1">身份证</option><option value="1">身份证</option><option value="2">军官证</option><option value="3">学生证</option>
            </select></span><span><input type="text" value="<?= $model->credentials_number ?>"
                                         name="UsersInfo[credentials_number]"  id="dd2" class="w189"/></span><b class="tam" id="ddd2"></b><span><input
                name="UsersInfo[credentials_photo]"  id="dd9" type="file"></span><b class="tam" id="ddd9"></b><span
            class="green">(500KB以内，格式JPG,GIF)</span><?php if (!empty($model->credentials_photo)) { ?>
            <input type="hidden" name="UsersInfo[old_credentials_photo]"  id="dd11" value="<?= $model->credentials_photo ?>">
        <?php } ?>

    </td>
</tr>
<tr>
    <td align="right"><em>*</em>户口所在地：</td>
    <td><select class="w78" name="UsersInfo[account_location]"
        <?php foreach (\app\models\Train::$districtList as $key => $val) : ?>
            <option value="<?= $key ?>"
                    <?php if ($val == $model->account_location) { ?>selected <?php } ?>><?= $val ?></option>
        <?php endforeach; ?>
        </select></td>
</tr>
<tr>
    <td align="right">联系电话：</td>
    <td><input type="text" value="<?= $model->telephone ?>" class="w189" name="UsersInfo[telephone]"/></td>
</tr>
<?php if (empty($userModel->mobile_phone)) { ?>
    <tr>
        <td align="right"><em>*</em>联系手机：</td>
        <td><input type="text" class="w189"  id="dd3" name="Users[mobile_phone]" value="<?= $userModel->mobile_phone ?>"/><b class="tam" id="ddd3"></b></td>
    </tr>
<?php } else { ?>
    <tr>
        <td align="right"><em>*</em>联系手机：</td>
        <td><input type="text" class="w189"  id="dd3" name="Users[mobile_phone]" value="<?= $userModel->mobile_phone ?>"
                   disabled="disabled"/><b class="tam" id="ddd3"></b></td>
    </tr>
<?php } ?>
<?php if (empty($userModel->email)) { ?>
    <tr>
        <td align="right"><em>*</em>电子邮箱：</td>
        <td><input type="text" class="w189" name="Users[email]" value="<?= $userModel->email ?>"/></td>
    </tr>
<?php } else { ?>
    <tr>
        <td align="right"><em>*</em>电子邮箱：</td>
        <td><input type="text" class="w189" name="Users[email]" value="<?= $userModel->email ?>" disabled="disabled"/>
        </td>
    </tr>
<?php } ?>
<tr>
    <td align="right"><em>*</em><b>身</b>高：</td>
    <td><input type="text" value="<?= $model->height ?>" class="w60" id="dd4" name="UsersInfo[height]"/> 厘米<b class="tam" id="ddd4"></b></td>
</tr>
<tr>
    <td align="right"><em>*</em><b>体</b>重：</td>
    <td><input type="text" value="<?= $model->weight ?>" class="w60" id="dd5" name="UsersInfo[weight]"/> 公斤<b class="tam" id="ddd5"></b></td>
</tr>
<tr>
    <td align="right"><em>*</em>既往伤病：</td>
    <td><select class="w78" name="UsersInfo[disease_history]">
            <option value="1">无伤病</option>
            <option value="2">有伤病</option>
        </select></td>
</tr>
<tr>
    <td align="right"><em>*</em>通信地址：</td>
    <td><input type="text" value="<?= $model->contact_address ?>" id="dd6" class="w400" name="UsersInfo[contact_address]"/><b id="ddd6" class="tam"></b>
        邮编：<input type="text" class="w189" name="UsersInfo[contact_postcode]" value="<?= $model->contact_postcode ?>"/>
    </td>
</tr>
<tr>
    <td align="right">现工作单位名称：</td>
    <td><input type="text" value="<?php if (!empty($model->company_name)) { echo $model->company_name;} else {echo '无';} ?>" class="w400" name="UsersInfo[company_name]"/></td>
</tr>
<tr>
    <td align="right">现工作单位地址：</td>
    <td><input type="text" value="<?php if (!empty($model->company_address)) { echo $model->company_address;} else {echo '无';}?>" class="w400" name="UsersInfo[company_address]"/>
        邮编：<input type="text" class="w189" name="UsersInfo[company_postcode]" value="<?php if (!empty($model->company_postcode)) { echo $model->company_postcode;} else {echo '无';}?>"/>
    </td>
</tr>
<tr>
    <td align="right">现工作单位电话：</td>
    <td><input type="text" value="<?php if (!empty($model->company_contact_phone)) { echo $model->company_contact_phone;} else {echo '无';} ?>" class="w189"
               name="UsersInfo[company_contact_phone]"/></td>
</tr>
<tr>
    <td align="right"><em>*</em>装备尺码：</td>
    <td>训练套服
        <select name="UsersInfo[clothes_size]">
            <?php foreach (\app\models\UsersInfo::$sizeList as $key => $val) : ?>
                <option
                    value="<?= $key ?>"<?php if ($model->clothes_size == $key) { ?> selected <?php } ?>><?= $val ?></option>
            <?php endforeach; ?>
        </select>
        训练T恤
        <select name="UsersInfo[t_shirt_size]">
            <?php foreach (\app\models\UsersInfo::$sizeList as $key => $val) : ?>
                <option
                    value="<?= $key ?>" <?php if ($model->t_shirt_size == $key) { ?> selected <?php } ?>><?= $val ?></option>
            <?php endforeach; ?>
        </select>
        训练短裤
        <select name="UsersInfo[shorts_size]">
            <?php foreach (\app\models\UsersInfo::$sizeList as $key => $val) : ?>
                <option
                    value="<?= $key ?>" <?php if ($model->shorts_size == $key) { ?> selected <?php } ?>><?= $val ?></option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
<tr>
    <td align="right"><em>*</em>外语情况：</td>
    <td><select class="w78" name="UsersInfo[language]">
               <?php foreach(\app\models\UsersInfo::$languageList as $key => $val) :?>
                                            <option value="<?= $key?>"><?= $val?></option>
                                        <?php endforeach;?>
        </select>&nbsp;&nbsp;&nbsp;口语&nbsp;&nbsp;&nbsp;<select class="w78" name="UsersInfo[spoken_language]">
            <?php foreach(\app\models\UsersInfo::$abilityList as $key => $val) :?>
                                            <option value="<?= $key?>"><?= $val?></option>
                                        <?php endforeach;?>
        </select>&nbsp;&nbsp;&nbsp;书写&nbsp;&nbsp;&nbsp;<select class="w78" name="UsersInfo[write_language]">
            <?php foreach(\app\models\UsersInfo::$abilityList as $key => $val) :?>
                                            <option value="<?= $key?>"><?= $val?></option>
                                        <?php endforeach;?>
        </select></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" value="修 改" class="fixe_btn"/></td>
</tr>
</table>
<?php ActiveForm::end(); ?>

</div>
<script>
$('#dd1').blur(function(){
if($('#dd1').val()==''){
  $('#ddd1').html('姓名不能为空');
 $('#dd1').focus();
}else{
 $('#ddd1').html('');	
}
});

$('#dd2').blur(function(){
	var sfzh= $('#dd2').val().length;
if(sfzh!=18 && sfzh!=15){
  $('#ddd2').html('身份证号位数不对');
 $('#dd2').focus();
}else{
 $('#ddd2').html('');	
}
});

$('#dd3').blur(function(){
if($('#dd3').val()==''){
 $('#ddd3').html('联系手机不能为空');
 $('#dd3').focus();
}else{
 $('#ddd3').html('');	
}
});


$('#dd4').blur(function(){
if($('#dd4').val()==''){
  $('#ddd4').html('身高不能为空');
 $('#dd4').focus();
}else{
 $('#ddd4').html('');	
}
});

$('#dd5').blur(function(){
if($('#dd5').val()==''){
  $('#ddd5').html('体重不能为空');
 $('#dd5').focus();
}else{
 $('#ddd5').html('');	
}
});

$('#dd6').blur(function(){
if($('#dd6').val()==''){
  $('#ddd6').html('通信地址不能为空');
 $('#dd6').focus();
}else{
 $('#ddd6').html('');	
}
});


$('#dd8').blur(function(){
if($('#dd8').val()==''){
  $('#ddd8').html('免冠照片必须上传');
 $('#dd8').focus();
}else{
 $('#ddd8').html('');	
}
});
$('#dd9').blur(function(){
if($('#dd9').val()==''){
  $('#ddd9').html('身份证信息必须上传');
 $('#dd9').focus();
}else{
 $('#ddd9').html('');	
}
});

function checkSubmit(){
if($('#dd1').val()==''){
 $('#ddd1').html('姓名不能为空');
 $('#dd1').focus();
 return  false;
}
var sfzh= $('#dd2').val().length;
if(sfzh!=18 && sfzh!=15){
  $('#ddd2').html('身份证号位数不对');
 $('#dd2').focus();
 return  false;
}
if($('#dd3').val()==''){
 $('#ddd3').html('联系手机不能为空');
 $('#dd3').focus();
 return  false;
}
var tel= $('#dd3').val().length;
if(tel!=11){
  $('#ddd3').html('联系手机位数不对');
 $('#dd3').focus();
 return  false;
}




if($('#dd4').val()==''){
  $('#ddd4').html('身高不能为空');
 $('#dd4').focus();
 return  false;
}



if($('#dd5').val()==''){
  $('#ddd5').html('体重不能为空');
 $('#dd5').focus();
 return  false;
}



if($('#dd6').val()==''){
  $('#ddd6').html('通信地址不能为空');
 $('#dd6').focus();
 return  false;
}


if($('#dd8').val()=='' && $('#dd10').val()==''){
 $('#ddd8').html('免冠照片必须上传');
 $('#dd8').focus();
 return  false;
}

if($('#dd9').val()=='' && $('#dd11').val()==''){
 $('#ddd9').html('身份证信息必须上传');
 $('#dd9').focus();
 return  false;
}
}
</script>
</li>
<li>
    <h1><span>教育经历</span>已完善（<?= \app\models\UsersEducation::getCountByUserId(Yii::$app->user->id) ?> 条）</h1>

    <div style="display:none;" class="form_input">
        <div class="divp_pt">
            <table cellpadding="0" cellspacing="0" class="wans_content">
                <tr>
                    <th>序</th>
                    <th>学校名称</th>
                    <th>时间</th>
                    <th>学历/学位</th>
                    <th>操作</th>
                </tr>
                <?php if (!empty($userEducation)) { ?>
                    <?php foreach ($userEducation as $key => $val) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $val['school'] ?></td>
                            <td><?= date('Y-m-d',strtotime($val['begin_time']))?> - <?= date('Y-m-d',strtotime($val['end_time']))?></td>
                            <td><?= ($val['educational_background'] == 1) ? '专科' : '本科' ?></td>
                            <td><a href="<?= \yii\helpers\Url::to('/user-center/user-info') ?>">编辑</a> | <a
                                    href="<?= \yii\helpers\Url::to(['/user-center/user-education', 'id' => $val['id']]) ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">请添加教育经历</td>
                    </tr>
                <?php } ?>
            </table>
            <?php $form = ActiveForm::begin([
                'id' => 'registerInfo',
                'enableAjaxValidation' => false,
                'action' => \yii\helpers\Url::to('/user-center/user-education')
            ]); ?>
            <table cellpadding="0" cellspacing="0" class="fixed_information fixed_information1">
                <tr>
                    <td align="right"><em>*</em>时间：</td>
                    <td><input type="text" id="d221" name="UsersEducation[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})" /> 至 <input type="text" id="d221" name="UsersEducation[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）</td>

                </tr>
                <tr>
                    <td align="right"><em>*</em>地点：</td>
                    <td><input type="text" value="" class="w400" name="UsersEducation[address]"/></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>学校名称：</td>
                    <td><input type="text" value="" class="w400" name="UsersEducation[school]"/></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>学历/学位：</td>
                    <td><select class="w78" name="UsersEducation[educational_background]">
                            <option value="博士">博士</option>
                            <option value="硕士">硕士</option>
                            <option value="本科">本科</option>
                            <option value="专科">专科</option>
                            <option value="高中">高中</option>
                            <option value="初中">初中</option>
                            <option value="小学">小学</option>
                        </select></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>证明人：</td>
                    <td><input type="text" value="" class="w189" name="UsersEducation[witness]"/> 证明人电话：<input
                            name="UsersEducation[witness_phone]" type="text" value="" class="w189"/></td>
                </tr>
                <tr>
                    <td align="right" valign="top"><em>*</em>描述：</td>
                    <td><textarea class="w480" name="UsersEducation[description]"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="保 存" class="fixe_btn btnBoxset"/></td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            <p class="go_add"><a href="javascript:;">继续添加</a></p>
        </div>
    </div>
</li>
<li>
    <h1><span>教练员培训经历</span>已完善（<?= \app\models\UsersTrain::getCountByUserId(Yii::$app->user->id) ?> 条）</h1>

    <div style="display:none;" class="form_input">
        <div class="divp_pt">
            <table cellpadding="0" cellspacing="0" class="wans_content">
                <tr>
                    <th>序</th>
                    <th>证书编号</th>
                    <th>时间</th>
                    <th>等级</th>
                    <th>操作</th>
                </tr>
                <?php if (!empty($userTrain)) { ?>
                    <?php foreach ($userTrain as $key => $val) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $val['credentials_number'] ?></td>
                            <td><?= date('Y-m-d', strtotime($val['begin_time'])) ?>
                                - <?= date('Y-m-d', strtotime($val['end_time'])) ?></td>
                            <td><?= ($val['level'] == 1) ? '高级' : '中级' ?></td>
                            <td><a href="<?= \yii\helpers\Url::to('/user-center/user-info') ?>">编辑</a> | <a
                                    href="<?= \yii\helpers\Url::to(['/user-center/user-train', 'id' => $val['id']]) ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">请添加培训经历</td>
                    </tr>
                <?php } ?>
            </table>
            <?php $form = ActiveForm::begin([
                'id' => 'registerInfo',
                'enableAjaxValidation' => false,
                'action' => \yii\helpers\Url::to('/user-center/user-train')
            ]); ?>
            <table cellpadding="0" cellspacing="0" class="fixed_information fixed_information1">
                <tr>
                    <td colspan="2" style="color:#E4393D;">（未有教练员培训经历的学员可不填写，D级以上的学员必须填写）</td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>时间：</td>
                    <td><input type="text" id="d221" name="UsersTrain[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})"/> 至 <input type="text" id="d221" name="UsersTrain[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）

                </tr>
                <tr>
                    <td align="right"><em>*</em>地点：</td>
                    <td><input type="text" value="" class="w400" name="UsersTrain[address]"/></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>等级：</td>
                    <td><select class="w78" name="UsersTrain[level]">
                            <option value="无">无</option>
                            <option value="市级">市级</option>
                            <option value="D级">D级</option>
                            <option value="C级">C级</option>
                            <option value="B级">B级</option>
                            <option value="A级">A级</option>
                            <option value="职业级">职业级</option>
                        </select></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>证书编号：</td>
                    <td><input type="text" value="" class="w189" name="UsersTrain[credentials_number]"/> <span
                            class='state1'></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>证明人：</td>
                    <td><input type="text" value="" class="w189" name="UsersTrain[witness]"/> 证明人电话：<input
                            name="UsersTrain[witness_phone]" type="text" value="" class="w189"/></td>
                </tr>
                <tr>
                    <td align="right" valign="top"><em>*</em>描述：</td>
                    <td><textarea class="w480" name="UsersTrain[description]"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="保 存" class="fixe_btn btnBoxset"/></td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            <p class="go_add"><a href="javascript:;">继续添加</a></p>
        </div>
    </div>

</li>
<li>
    <h1><span>主要执教经历</span>已完善（<?= \app\models\UsersVocational::getCountByUserId(Yii::$app->user->id) ?> 条）</h1>

    <div style="display:none;" class="form_input">
        <div class="divp_pt">
            <table cellpadding="0" cellspacing="0" class="wans_content">
                <tr>
                    <th>序</th>
                    <th>执教球队</th>
                    <th>时间</th>
                    <th>任职</th>
                    <th>操作</th>
                </tr>
                <?php if (!empty($userVocational)) { ?>
                    <?php foreach ($userVocational as $key => $val) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $val['team'] ?></td>
                            <td><?= date('Y-m-d', strtotime($val['begin_time'])) ?>
                                - <?= date('Y-m-d', strtotime($val['end_time'])) ?></td>
                            <td><?= ($val['post'] == 1) ? '市级' : '国家级' ?></td>
                            <td>
                                <a href="<?= \yii\helpers\Url::to(['user/register-vocational', 'user_vocational_id' => $val['id']]) ?>">编辑</a>
                                | <a
                                    href="<?= \yii\helpers\Url::to(['user-center/user-vocational', 'id' => $val['id']]) ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">请添加执教经历</td>
                    </tr>
                <?php } ?>
            </table>
            <?php $form = ActiveForm::begin([
                'id' => 'registerInfo',
                'enableAjaxValidation' => false,
                'action' => \yii\helpers\Url::to('/user-center/user-vocational')
            ]); ?>
            <table cellpadding="0" cellspacing="0" class="fixed_information fixed_information1">
                <tr>
                <tr>
                    <td colspan="2" style="color:#E4393D;">（未有执教经历的学员可不填写！）</td>
                </tr>
                <td align="right"><em>*</em>时间：</td>
                <td><input type="text" id="d221" name="UsersVocational[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})"/> 至 <input type="text" id="d221" name="UsersVocational[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）</td>
                </tr>
                <tr>
                    <td align="right">地点：</td>
                    <td><input type="text" value="" class="w400" name="UsersVocational[address]"/></td>
                </tr>
                <tr>
                    <td align="right">任职：</td>
                    <td><select class="w78" name="UsersVocational[post]">
                            <option value="无">无</option>
                            <option value="主教练">主教练</option>
                            <option value="助理教练">助理教练</option>
                            <option value="技战术教练">技战术教练</option>
                            <option value="守门员教练">守门员教练</option>
                            <option value="力量体能教练">力量体能教练</option>
                            <option value="其它">其它</option>
                        </select></td>
                </tr>
                <tr>
                    <td align="right">执教球队：</td>
                    <td><input type="text" value="" class="w189" name="UsersVocational[team]"/> <span class='state1'>
                    </td>
                </tr>
                <tr>
                    <td align="right">证明人：</td>
                    <td><input type="text" value="" class="w189" name="UsersVocational[witness]"/> 证明人电话：<input
                            name="UsersVocational[witness_phone]" type="text" value="" class="w189"/></td>
                </tr>
                <tr>
                    <td align="right" valign="top">描述：</td>
                    <td><textarea class="w480" name="UsersVocational[description]"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="保 存" class="fixe_btn btnBoxset"/></td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            <p class="go_add"><a href="javascript:;">继续添加</a></p>
        </div>
    </div>

</li>
<li>
    <h1><span>运动经历</span>已完善（<?= \app\models\UsersPlayers::getCountByUserId(Yii::$app->user->id) ?> 条）</h1>

    <div style="display:none;" class="form_input">
        <div class="divp_pt">
            <table cellpadding="0" cellspacing="0" class="wans_content">
                <tr>
                    <th>序</th>
                    <th>效力球队</th>
                    <th>时间</th>
                    <th>任职</th>
                    <th>操作</th>
                </tr>
                <?php if (!empty($userPlayers)) { ?>
                    <?php foreach ($userPlayers as $key => $val) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $val['team'] ?></td>
                            <td><?= date('Y-m-d', strtotime($val['begin_time'])) ?>
                                - <?= date('Y-m-d', strtotime($val['end_time'])) ?></td>
                            <td><?= ($val['level'] == 1) ? '高级' : '中级' ?></td>
                            <td>
                                <a href="<?= \yii\helpers\Url::to(['user-center/user-players', 'user_players_id' => $val['id']]) ?>">编辑</a>
                                | <a
                                    href="<?= \yii\helpers\Url::to(['user-center/user-players', 'id' => $val['id']]) ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">请添加运动经历</td>
                    </tr>
                <?php } ?>
            </table>
            <?php $form = ActiveForm::begin([
                'id' => 'registerInfo',
                'enableAjaxValidation' => false,
                'action' => \yii\helpers\Url::to('/user-center/user-players')
            ]); ?>
            <table cellpadding="0" cellspacing="0" class="fixed_information fixed_information1">
                <tr>
                    <td colspan="2" style="color:#E4393D;">（未有运动经历的学员可不填写！）</td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>时间：</td>
                    <td><input type="text" id="d221" name="UsersPlayers[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})"/> 至 <input type="text" id="d221" name="UsersPlayers[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）</td>

                </tr>
                <tr>
                    <td align="right"><em>*</em>地点：</td>
                    <td><input type="text" value="" class="w400" name="UsersPlayers[address]"/></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>任职：</td>
                    <td><select class="w78" name="UsersPlayers[level]">
                            <option value="无">无</option>
                            <option value="中锋">中锋</option>
                            <option value="边锋">边锋</option>
                            <option value="前腰">前腰</option>
                            <option value="边前卫">边前卫</option>
                            <option value="中前卫">中前卫</option>
                            <option value="后腰">后腰</option>
                            <option value="边后卫">边后卫</option>
                            <option value="中后卫">中后卫</option>
                            <option value="清道夫">清道夫</option>
                            <option value="门将">门将</option>
                        </select></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>效力球队：</td>
                    <td><input type="text" value="" class="w189" name="UsersPlayers[team]"/> <span class='state1'></td>
                </tr>
                <tr>
                    <td align="right"><em>*</em>证明人：</td>
                    <td><input type="text" value="" class="w189" name="UsersPlayers[witness]"/> 证明人电话：<input
                            name="UsersPlayers[witness_phone]" type="text" value="" class="w189"/></td>
                </tr>
                <tr>
                    <td align="right" valign="top"><em>*</em>描述：</td>
                    <td><textarea class="w480" name="UsersPlayers[description]"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="保 存" class="fixe_btn btnBoxset"/></td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            <p class="go_add"><a href="javascript:;">继续添加</a></p>
        </div>
    </div>

</li>
</ul>
</div>
</div>
<!--footer-->
<p class="copyright_Set">Copyright © 2015 版权所有</p>
<!--footer-->
</td>
</tr>
</table>
</div>
</div>