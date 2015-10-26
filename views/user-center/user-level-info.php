<script language="javascript">
    // JavaScript Document
    $(function(){
        //tab
        $(".tabs .title_h43 a:first-child").addClass("hover");
        $(".tabs").each(function(){
            $(".tab_son",this).eq(0).addClass("nodis");
        });
        $(".tabs .title_h43 a").click(function(){
            var nnum = $(this).index();
            $(this).siblings().removeClass("hover");
            $(this).addClass("hover");
            var nnum = $(this).index();
            $(this).parent().siblings(".tab_son").removeClass("nodis");
            $(this).parent().siblings(".tab_son").eq(nnum).addClass("nodis");

        });

    })
</script>
<?php
use yii\widgets\ActiveForm;
?>
<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left', ['data' => $data]); ?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">教练员注册信息</h3>

                        <div class="conbox_set">
                            <div class="tabs martop">
                                <h3 class="title_h43"><a href="javascript:;">市级</a><a href="javascript:;">D级</a><a
                                        href="javascript:;">C级</a><a href="javascript:;">B级</a><a
                                        href="javascript:;">A级</a><a href="javascript:;">职业级</a><span
                                        class="pxbxi_Set2">我的注册信息</span></h3>
                                <?php if (!empty($data['modelA'])) { ?>

                                    <!--市级教练员-->
                                    <div class="tab_son box_table1">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'registerInfo',
                                            'enableAjaxValidation' => false,
                                            'options' => ['enctype' => 'multipart/form-data'],
                                            'action' => \yii\helpers\Url::to('/user-center/user-level-info')
                                        ]); ?>
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td style="font-size:16px;"><?= Yii::$app->user->identity->username ?>
                                                    （<?= \app\models\Level::getOneLevelNameById($data['modelA']['level_id']) ?>
                                                    ）教练员
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
                                            <table cellpadding="0" cellspacing="0" class="table_set1">
                                                <tr>
                                                    <td></td>
                                                    <td><?php if (!empty($data['modelA']['photo'])) {?><img src="/upload/images/users_level/photo/<?= $data['modelA']['photo']?>" width="157" height="210" /><?php }?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>形象照片：</td>
                                                    <td><input name="UsersLevel[photo]" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>考试成绩：</td>
                                                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                                                    value="<?= $data['modelA']['practice_score']?>分"/></span><span>理论</span><span><input type="text" readonly class="w70"
                                                                value="<?= $data['modelA']['theory_score']?>分"/></span><span>规则</span><span><input
                                                                type="text" readonly class="w70"
                                                                value="<?= $data['modelA']['rule_score']?>分"/></span><span>总评</span><span><input
                                                                type="text" readonly class="w70" value="<?= $data['modelA']['score_appraise']?>分"/></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>教练等级：</td>
                                                    <td><input type="text" readonly class="w70" value="<?= \app\models\Level::getOneLevelNameById($data['modelA']['level_id'])?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>证书编号：</td>
                                                    <td><span><input type="text" readonly class="w228"
                                                                     value="<?= $data['modelA']['certificate_number']?>"/></span>
                                                        <?php if (!empty($data['modelA']['credentials_photo'])) {?>
                                                        <p class="opactiy_set"><span>查看证书</span><span><img
                                                                    src="/images/user/zs.jpg" width="33" height="22"/> </span><a
                                                                href="/upload/images/users_level/credentials_photo/<?= $data['modelA']['credentials_photo']?>" target="_blank"><img src="/images/user/zoom.jpg"/></a></p>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>所属区域：</td>
                                                    <td><select>
                                                            <?php foreach (\app\models\Train::$districtList as $key => $val) :?>
                                                                <option value="<?= $key?>" <?php if ($data['modelA']['district'] == $key){?>selected<?php }?>><?= $val?></option>
                                                            <?php endforeach;?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>收证地址：</td>
                                                    <td><span><input type="text" name="UsersLevel[receive_address]" class="w398" value="<?= $data['modelA']['receive_address']?>"/></span><span>邮编：<input type="text" name="UsersLevel[postcode]" class="w200" value="<?= $data['modelA']['postcode']?>"/></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>注册费：</td>
                                                    <td><span><input type="text" readonly class="w70" value="<?= \app\models\Level::getRegisterFeeById($data['modelA']['level_id'])?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span class="pay"><b class="fl">
                                                                <?php if ($data['modelA']['status'] <3) {?>
                                                                未支付！</b><a href="<?= \yii\helpers\Url::to(['/user-center/pay', 'id' => $data['modelA']['id']])?>"><img src="/images/user/onlinepay.jpg"/></a><a href="javascript:;"><img src="/images/user/downlinepay.jpg"/></a></span><span class="green" style="display:none;">已支付</span>
                                                                <?php  } else {?>
                                                                已支付
                                                                <?php }?>
                                                            </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input name="id" value="<?= $data['modelA']['id']?>" type="hidden"><input type="submit" value="提交教练员注册信息" class="tj_btn"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                <?php }  else {?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
                                    </div>
                                <?php }?>
                                <!--市级教练员-->
                                <!--D级教练员-->
                                <?php if (!empty($data['modelB'])) { ?>

                                    <!--市级教练员-->
                                    <div class="tab_son box_table1">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'registerInfo',
                                            'enableAjaxValidation' => false,
                                            'options' => ['enctype' => 'multipart/form-data'],
                                            'action' => \yii\helpers\Url::to('/user-center/user-level-info')
                                        ]); ?>
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td style="font-size:16px;"><?= Yii::$app->user->identity->username ?>
                                                    （<?= \app\models\Level::getOneLevelNameById($data['modelB']['level_id']) ?>
                                                    ）教练员
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
                                            <table cellpadding="0" cellspacing="0" class="table_set1">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php if (!empty($data['modelB']['photo'])) {?><img src="/upload/images/user_level/photo/<?= $data['modelA']['photo']?>"/><?php }?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>形象照片：</td>
                                                    <td><input name="photo" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>考试成绩：</td>
                                                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                                                    value="<?= $data['modelB']['practice_score']?>分"/></span><span>理论</span><span><input type="text" readonly class="w70"
                                                                                                                                                                         value="<?= $data['modelB']['theory_score']?>分"/></span><span>规则</span><span><input
                                                                type="text" readonly clBss="w70"
                                                                value="<?= $data['modelB']['rule_score']?>分"/></span><span>总评</span><span><input
                                                                type="text" readonly class="w70" value="<?= $data['modelB']['score_appraise']?>分"/></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>教练等级：</td>
                                                    <td><input type="text" readonly class="w70" value="<?= \app\models\Level::getOneLevelNameById($data['modelB']['level_id'])?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>证书编号：</td>
                                                    <td><span><input type="text" readonly class="w228"
                                                                     value="<?= $data['modelB']['certificate_number']?>"/></span>

                                                        <p class="opactiy_set"><span>查看证书</span><span><img
                                                                    src="/images/zs.jpg" width="33" height="22"/> </span><a
                                                                href="javascript:;"><img src="/images/zoom.jpg"/></a></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>所属区域：</td>
                                                    <td><select>
                                                            <?php foreach (\app\models\Train::$districtList as $key => $val) :?>
                                                                <option value="<?= $key?>" <?php if ($data['modelB']['district'] == $key){?>selected<?php }?>><?= $val?></option>
                                                            <?php endforeach;?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>收证地址：</td>
                                                    <td><span><input type="text" name="receive_address" class="w398"
                                                                     value=""/></span><span>邮编：<input
                                                                type="text" name="postcode" class="w200"
                                                                value=""/></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>注册费：</td>
                                                    <td><span><input type="text" readonly class="w70" value="<?= \app\models\Level::getRegisterFeeById($data['modelB']['level_id'])?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span class="pay"><b class="fl">未支付！</b><a href="javascript:;"><img src="/images/onlinepay.jpg"/></a><a href="javascript:;"><img src="/images/downlinepay.jpg"/></a></span><span class="green" style="display:none;">已支付</span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input name="id" value="<?= $data['modelB']['id']?>" type="hidden"><input type="submit" value="提交教练员注册信息" class="tj_btn"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                <?php }  else {?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
                                    </div>
                                <?php }?>
                                <!--D级教练员-->
                                <!--C级教练员-->
                                <?php if (!empty($data['modelC'])) { ?>

                                    <!--市级教练员-->
                                    <div class="tab_son box_table1">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'registerInfo',
                                            'enableAjaxValidation' => false,
                                            'options' => ['enctype' => 'multipart/form-data'],
                                            'action' => \yii\helpers\Url::to('/user-center/user-level-info')
                                        ]); ?>
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td style="font-size:16px;"><?= Yii::$app->user->identity->username ?>
                                                    （<?= \app\models\Level::getOneLevelNameById($data['modelC']['level_id']) ?>
                                                    ）教练员
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
                                            <table cellpadding="0" cellspacing="0" class="table_set1">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php if (!empty($data['modelC']['photo'])) {?><img src="/upload/images/user_level/photo/<?= $data['modelA']['photo']?>"/><?php }?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>形象照片：</td>
                                                    <td><input name="photo" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>考试成绩：</td>
                                                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                                                    value="<?= $data['modelC']['practice_score']?>分"/></span><span>理论</span><span><input type="text" readonly class="w70"
                                                                                                                                                                         value="<?= $data['modelC']['theory_score']?>分"/></span><span>规则</span><span><input
                                                                type="text" readonly clBss="w70"
                                                                value="<?= $data['modelC']['rule_score']?>分"/></span><span>总评</span><span><input
                                                                type="text" readonly class="w70" value="<?= $data['modelC']['score_appraise']?>分"/></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>教练等级：</td>
                                                    <td><input type="text" readonly class="w70" value="<?= \app\models\Level::getOneLevelNameById($data['modelC']['level_id'])?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>证书编号：</td>
                                                    <td><span><input type="text" readonly class="w228"
                                                                     value="<?= $data['modelC']['certificate_number']?>"/></span>

                                                        <p class="opactiy_set"><span>查看证书</span><span><img
                                                                    src="/images/zs.jpg" width="33" height="22"/> </span><a
                                                                href="javascript:;"><img src="/images/zoom.jpg"/></a></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>所属区域：</td>
                                                    <td><select>
                                                            <?php foreach (\app\models\Train::$districtList as $key => $val) :?>
                                                                <option value="<?= $key?>" <?php if ($data['modelC']['district'] == $key){?>selected<?php }?>><?= $val?></option>
                                                            <?php endforeach;?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>收证地址：</td>
                                                    <td><span><input type="text" name="receive_address" class="w398"
                                                                     value=""/></span><span>邮编：<input
                                                                type="text" name="postcode" class="w200"
                                                                value=""/></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>注册费：</td>
                                                    <td><span><input type="text" readonly class="w70" value="<?= \app\models\Level::getRegisterFeeById($data['modelC']['level_id'])?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span class="pay"><b class="fl">未支付！</b><a href="javascript:;"><img src="/images/onlinepay.jpg"/></a><a href="javascript:;"><img src="/images/downlinepay.jpg"/></a></span><span class="green" style="display:none;">已支付</span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input name="id" value="<?= $data['modelC']['id']?>" type="hidden"><input type="submit" value="提交教练员注册信息" class="tj_btn"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php ActiveForm::end(); ?>

                                    </div>
                                <?php }  else {?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
                                    </div>
                                <?php }?>
                                <!--C级教练员-->
                                <!--B级教练-->
                                <?php if (!empty($data['modelD'])) { ?>

                                    <!--市级教练员-->
                                    <div class="tab_son box_table1">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'registerInfo',
                                            'enableAjaxValidation' => false,
                                            'options' => ['enctype' => 'multipart/form-data'],
                                            'action' => \yii\helpers\Url::to('/user-center/user-level-info')
                                        ]); ?>
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td style="font-size:16px;"><?= Yii::$app->user->identity->username ?>
                                                    （<?= \app\models\Level::getOneLevelNameById($data['modelD']['level_id']) ?>
                                                    ）教练员
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
                                            <table cellpadding="0" cellspacing="0" class="table_set1">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php if (!empty($data['modelD']['photo'])) {?><img src="/upload/images/user_level/photo/<?= $data['modelA']['photo']?>"/><?php }?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>形象照片：</td>
                                                    <td><input name="photo" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>考试成绩：</td>
                                                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                                                    value="<?= $data['modelD']['practice_score']?>分"/></span><span>理论</span><span><input type="text" readonly class="w70"
                                                                                                                                                                         value="<?= $data['modelD']['theory_score']?>分"/></span><span>规则</span><span><input
                                                                type="text" readonly clBss="w70"
                                                                value="<?= $data['modelD']['rule_score']?>分"/></span><span>总评</span><span><input
                                                                type="text" readonly class="w70" value="<?= $data['modelD']['score_appraise']?>分"/></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>教练等级：</td>
                                                    <td><input type="text" readonly class="w70" value="<?= \app\models\Level::getOneLevelNameById($data['modelD']['level_id'])?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>证书编号：</td>
                                                    <td><span><input type="text" readonly class="w228"
                                                                     value="<?= $data['modelD']['certificate_number']?>"/></span>

                                                        <p class="opactiy_set"><span>查看证书</span><span><img
                                                                    src="/images/zs.jpg" width="33" height="22"/> </span><a
                                                                href="javascript:;"><img src="/images/zoom.jpg"/></a></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>所属区域：</td>
                                                    <td><select>
                                                            <?php foreach (\app\models\Train::$districtList as $key => $val) :?>
                                                                <option value="<?= $key?>" <?php if ($data['modelD']['district'] == $key){?>selected<?php }?>><?= $val?></option>
                                                            <?php endforeach;?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>收证地址：</td>
                                                    <td><span><input type="text" name="receive_address" class="w398"
                                                                     value=""/></span><span>邮编：<input
                                                                type="text" name="postcode" class="w200"
                                                                value=""/></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>注册费：</td>
                                                    <td><span><input type="text" readonly class="w70" value="<?= \app\models\Level::getRegisterFeeById($data['modelD']['level_id'])?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span class="pay"><b class="fl">未支付！</b><a href="javascript:;"><img src="/images/onlinepay.jpg"/></a><a href="javascript:;"><img src="/images/downlinepay.jpg"/></a></span><span class="green" style="display:none;">已支付</span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input name="id" value="<?= $data['modelD']['id']?>" type="hidden"><input type="submit" value="提交教练员注册信息" class="tj_btn"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php ActiveForm::end(); ?>

                                    </div>
                                <?php }  else {?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
                                    </div>
                                <?php }?>
                                <!--B级教练-->
                                <!--A级教练员-->
                                <?php if (!empty($data['modelE'])) { ?>

                                    <!--市级教练员-->
                                    <div class="tab_son box_table1">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'registerInfo',
                                            'enableAjaxValidation' => false,
                                            'options' => ['enctype' => 'multipart/form-data'],
                                            'action' => \yii\helpers\Url::to('/user-center/user-level-info')
                                        ]); ?>
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td style="font-size:16px;"><?= Yii::$app->user->identity->username ?>
                                                    （<?= \app\models\Level::getOneLevelNameById($data['modelE']['level_id']) ?>
                                                    ）教练员
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
                                            <table cellpadding="0" cellspacing="0" class="table_set1">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php if (!empty($data['modelE']['photo'])) {?><img src="/upload/images/user_level/photo/<?= $data['modelA']['photo']?>"/><?php }?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>形象照片：</td>
                                                    <td><input name="photo" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>考试成绩：</td>
                                                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                                                    value="<?= $data['modelE']['practice_score']?>分"/></span><span>理论</span><span><input type="text" readonly class="w70"
                                                                                                                                                                         value="<?= $data['modelE']['theory_score']?>分"/></span><span>规则</span><span><input
                                                                type="text" readonly clBss="w70"
                                                                value="<?= $data['modelE']['rule_score']?>分"/></span><span>总评</span><span><input
                                                                type="text" readonly class="w70" value="<?= $data['modelE']['score_appraise']?>分"/></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>教练等级：</td>
                                                    <td><input type="text" readonly class="w70" value="<?= \app\models\Level::getOneLevelNameById($data['modelE']['level_id'])?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>证书编号：</td>
                                                    <td><span><input type="text" readonly class="w228"
                                                                     value="<?= $data['modelE']['certificate_number']?>"/></span>

                                                        <p class="opactiy_set"><span>查看证书</span><span><img
                                                                    src="/images/zs.jpg" width="33" height="22"/> </span><a
                                                                href="javascript:;"><img src="/images/zoom.jpg"/></a></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>所属区域：</td>
                                                    <td><select>
                                                            <?php foreach (\app\models\Train::$districtList as $key => $val) :?>
                                                                <option value="<?= $key?>" <?php if ($data['modelE']['district'] == $key){?>selected<?php }?>><?= $val?></option>
                                                            <?php endforeach;?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>收证地址：</td>
                                                    <td><span><input type="text" name="receive_address" class="w398"
                                                                     value=""/></span><span>邮编：<input
                                                                type="text" name="postcode" class="w200"
                                                                value=""/></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>注册费：</td>
                                                    <td><span><input type="text" readonly class="w70" value="<?= \app\models\Level::getRegisterFeeById($data['modelE']['level_id'])?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span class="pay"><b class="fl">未支付！</b><a href="javascript:;"><img src="/images/onlinepay.jpg"/></a><a href="javascript:;"><img src="/images/downlinepay.jpg"/></a></span><span class="green" style="display:none;">已支付</span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input name="id" value="<?= $data['modelE']['id']?>" type="hidden"><input type="submit" value="提交教练员注册信息" class="tj_btn"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php ActiveForm::end(); ?>

                                    </div>
                                <?php }  else {?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
                                    </div>
                                <?php }?>
                                <!--A级教练员--
                                <!--职业级教练员-->
                                <?php if (!empty($data['modelF'])) { ?>

                                    <!--市级教练员-->
                                    <div class="tab_son box_table1">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'registerInfo',
                                            'enableAjaxValidation' => false,
                                            'options' => ['enctype' => 'multipart/form-data'],
                                            'action' => \yii\helpers\Url::to('/user-center/user-level-info')
                                        ]); ?>
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td style="font-size:16px;"><?= Yii::$app->user->identity->username ?>
                                                    （<?= \app\models\Level::getOneLevelNameById($data['modelF']['level_id']) ?>
                                                    ）教练员
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
                                            <table cellpadding="0" cellspacing="0" class="table_set1">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php if (!empty($data['modelF']['photo'])) {?><img src="/upload/images/user_level/photo/<?= $data['modelA']['photo']?>"/><?php }?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>形象照片：</td>
                                                    <td><input name="photo" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>考试成绩：</td>
                                                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                                                    value="<?= $data['modelF']['practice_score']?>分"/></span><span>理论</span><span><input type="text" readonly class="w70"
                                                                                                                                                                         value="<?= $data['modelF']['theory_score']?>分"/></span><span>规则</span><span><input
                                                                type="text" readonly clBss="w70"
                                                                value="<?= $data['modelF']['rule_score']?>分"/></span><span>总评</span><span><input
                                                                type="text" readonly class="w70" value="<?= $data['modelF']['score_appraise']?>分"/></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>教练等级：</td>
                                                    <td><input type="text" readonly class="w70" value="<?= \app\models\Level::getOneLevelNameById($data['modelF']['level_id'])?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>证书编号：</td>
                                                    <td><span><input type="text" readonly class="w228"
                                                                     value="<?= $data['modelF']['certificate_number']?>"/></span>

                                                        <p class="opactiy_set"><span>查看证书</span><span><img
                                                                    src="/images/zs.jpg" width="33" height="22"/> </span><a
                                                                href="javascript:;"><img src="/images/zoom.jpg"/></a></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>所属区域：</td>
                                                    <td><select>
                                                            <?php foreach (\app\models\Train::$districtList as $key => $val) :?>
                                                                <option value="<?= $key?>" <?php if ($data['modelF']['district'] == $key){?>selected<?php }?>><?= $val?></option>
                                                            <?php endforeach;?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>收证地址：</td>
                                                    <td><span><input type="text" name="receive_address" class="w398"
                                                                     value=""/></span><span>邮编：<input
                                                                type="text" name="postcode" class="w200"
                                                                value=""/></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>*</b>注册费：</td>
                                                    <td><span><input type="text" readonly class="w70" value="<?= \app\models\Level::getRegisterFeeById($data['modelF']['level_id'])?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span class="pay"><b class="fl">未支付！</b><a href="javascript:;"><img src="/images/onlinepay.jpg"/></a><a href="javascript:;"><img src="/images/downlinepay.jpg"/></a></span><span class="green" style="display:none;">已支付</span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input name="id" value="<?= $data['modelF']['id']?>" type="hidden"><input type="submit" value="提交教练员注册信息" class="tj_btn"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php ActiveForm::end(); ?>

                                    </div>
                                <?php }  else {?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
                                    </div>
                                <?php }?>
                                <!--职业级教练员-->
                            </div>
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