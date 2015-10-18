<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<?php $form = ActiveForm::begin([
    'id'=>'registerInfo',
    'enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/user/register-info')
]); ?>
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
    <h1 class="hover"><span>个人信息</span></h1>
    <div class="form_input" style="display:block;">
        <table cellpadding="0" cellspacing="0" class="fixed_information">
            <tr>
                <td align="right"><em>*</em><b>姓</b>名：</td>
                <td><span><input type="text" value="<?php if (!empty($model->name)) { echo $model->name;}?>" class="w189" name="UsersInfo[name]" /><span class='state1'></span></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>上传照片：</td>
                    <td><span><input name="UsersInfo[photo]" type="file" value="上传2寸照片"></span><span class="green">(请提交2寸白底标准免冠照片，300KB以内，格式JPG,GIF)</span><?php if (!empty($model->photo)){?><img src="/upload/images/users_info/photo/<?= $model->photo?>" width="157" height="210" /><?php }?></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>性</b>别：</td></span>
                <td><input type="radio" name="UsersInfo[sex]" checked="checked" value="1" /> 男 <input type="radio" name="UsersInfo[sex]"  value="2"/> 女</td>
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
                        <option value="01">一月</option>
                        <option value="02">二月</option>
                        <option value="03">三月</option>
                        <option value="04">四月</option>
                        <option value="05">五月</option>
                        <option value="06">六月</option>
                        <option value="07">七月</option>
                        <option value="08">八月</option>
                        <option value="09">九月</option>
                        <option value="10">十月</option>
                        <option value="11">十一月</option>
                        <option value="12">十二月</option>
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
                    </select>日</td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>证</b>件：</td>
                <td><span><select class="w78" name="UsersInfo[credentials_type]"><option value="1">身份证</option></select></span><span><input type="text" value="<?php if (!empty($model->credentials_number)) { echo $model->credentials_number;}?>" name="UsersInfo[credentials_number]" class="w189" /><span class='state1'></span></span><span><input name="UsersInfo[credentials_photo]" type="file""></span><span class="green">(500KB以内，格式JPG,GIF)</span><?php if (!empty($model->credentials_photo)){?><a href="/upload/images/users_info/credentials_photo/<?= $model->credentials_photo?>" target="_blank"><img src="/upload/images/users_info/credentials_photo/<?= $model->credentials_photo?>" width="20" height="15" /></a><?php }?></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>户口所在地：</td>
                <td><select class="w78" name="UsersInfo[account_location]"><option>北京</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>联系电话：</td>
                <td><input type="text" value="<?php if (!empty($model->telephone)) { echo $model->telephone;}?>" class="w189" name="UsersInfo[telephone]" /><span class='state1'></span></td>
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
                <td><input type="text" value="<?php if (!empty($model->height)) { echo $model->height;}?>" class="w60" name="UsersInfo[height]" /> 厘米<span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em><b>体</b>重：</td>
                <td><input type="text" value="<?php if (!empty($model->weight)) { echo $model->weight;}?>" class="w60" name="UsersInfo[weight]" /> 公斤<span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>既往伤病：</td>
                <td><select class="w78" name="UsersInfo[disease_history]"><option value="0">无伤病</option><option value="1">有伤病</option></select></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>通信地址：</td>
                <td><input type="text" value="<?php if (!empty($model->contact_address)) { echo $model->contact_address;}?>" class="w400" name="UsersInfo[contact_address]" /> <span class='state1'></span>邮编：<input type="text" value="" class="w189" name="UsersInfo[contact_postcode]" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位名称：</td>
                <td><input type="text" value="<?php if (!empty($model->company_name)) { echo $model->company_name;}?>" class="w400" name="UsersInfo[company_name]" /><span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位地址：</td>
                <td><input type="text" value="<?php if (!empty($model->company_address)) { echo $model->company_address;}?>" class="w400" name="UsersInfo[company_address]" /> 邮编：<span class='state1'></span><input type="text" value="<?php if (!empty($model->company_postcode)) { echo $model->company_postcode;}?>" class="w189" name="UsersInfo[company_postcode]" /></td>
            </tr>
            <tr>
                <td align="right"><em>*</em>现工作单位电话：</td>
                <td><input type="text" value="<?php if (!empty($model->company_contact_phone)) { echo $model->company_contact_phone;}?>" class="w189" name="UsersInfo[company_contact_phone]" /><span class='state1'></span></td>
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
                <td><input name="train_id" type="hidden" value="<?= $train_id?>"><input type="submit" value="下一步，填写教育信息" name="submit" class="fixe_btn" /></td>
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