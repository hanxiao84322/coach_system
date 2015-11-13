<?php
use yii\widgets\ActiveForm;
?>

<link rel="stylesheet" href="/css/jquery.jcrop.css" type="text/css"/>
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery.ajaxfileupload.js" type="text/javascript"></script>
<script src="/js/jquery.jcrop.js" type="text/javascript"></script>
<script src="/js/avatarCutter.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {

        function getFileSize(fileName) {
            var byteSize = 0;
            //console.log($("#" + fileName).val());
            if($("#" + fileName)[0].files) {
                var byteSize  = $("#" + fileName)[0].files[0].size;
            }else {

            }
            //alert(byteSize);
            byteSize = Math.ceil(byteSize / 1024) //KB
            return byteSize;//KB
        }
        $("#btnUpload").click(function () {
            $("#btnCrop").show();
            var allowImgageType = ['jpg', 'jpeg', 'png', 'gif'];
            var file = $("#photo").val();
            //获取大小
            var byteSize = getFileSize('photo');
            //获取后缀
            if (file.length > 0) {
                if(byteSize > 2048) {
                    alert("上传的附件文件不能超过2M");
                    return;
                }
                var pos = file.lastIndexOf(".");
                //截取点之后的字符串
                var ext = file.substring(pos + 1).toLowerCase();
//                console.log(ext);
                if($.inArray(ext, allowImgageType) != -1) {
                    ajaxFileUpload();
                }else {
                    alert("请选择jpg,jpeg,png,gif类型的图片");
                }
            }
            else {
                alert("请选择jpg,jpeg,png,gif类型的图片");
            }
        });
        function ajaxFileUpload(){
            $.ajaxFileUpload()({
                url: '/user-center/user-level-info', //用于文件上传的服务器端请求地址
                secureuri: false, //一般设置为false
                fileElementId: 'photo', //文件上传空间的id属性  <input type="file" id="file" name="file" />
                dataType: 'json', //返回值类型 一般设置为json
                success: function (data, status)  //服务器成功响应处理函数
                {

                    $("#picture_original>img").attr({src: data.src, width: data.width, height: data.height});
                    $('#imgsrc').val(data.path);
                    //alert(data.msg);

                    //同时启动裁剪操作，触发裁剪框显示，让用户选择图片区域
                    var cutter = new jQuery.UtrialAvatarCutter({
                            //主图片所在容器ID
                            content : "picture_original",
                            //缩略图配置,ID:所在容器ID;width,height:缩略图大小
                            purviews : [{id:"picture_200",width:200,height:200},{id:"picture_50",width:100,height:100},{id:"picture_30",width:50,height:50}],
                            //选择器默认大小
                            selector : {width:430,height:600},
                            showCoords : function(c) { //当裁剪框变动时，将左上角相对图片的X坐标与Y坐标 宽度以及高度
                                $("#x1").val(c.x);
                                $("#y1").val(c.y);
                                $("#cw").val(c.w);
                                $("#ch").val(c.h);
                            },
                            cropattrs : {boxWidth: 430, boxHeight: 600}
                        }
                    );
                    cutter.reload(data.src);

                    $('#div_avatar').show();
                },
                error: function (data, status, e)//服务器响应失败处理函数
                {
                    alert(e);
                }
            })
            return false;
        }

        $('#btnCrop').click(function() {
            $.getJSON('avatar_upload2.php', {x: $('#x1').val(), y: $('#y1').val(), w: $('#cw').val(), h: $('#ch').val(), src: $('#imgsrc').val()}, function(data) {

                if(data.msg=='1'){
                    alert('上传头像成功');
                    location.href='user.php?act=profile';
                }else{
                    alert('上传头像失败，请重新上传');
                    location.reload();
                }

            });
            return false;
        });
    });

</script>
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
<h3 class="title_h44">
    <a href="<?= \yii\helpers\Url::to(['user-center/user-level-info', 'level_id' => '2']) ?>" <?php if ($data['level_id'] == 2):?> class="hover" <?php endif;?>>市级</a><a href="<?= \yii\helpers\Url::to(['user-center/user-level-info', 'level_id' => '3']) ?>" <?php if ($data['level_id'] == 3):?> class="hover" <?php endif;?>>D级</a><a href="<?= \yii\helpers\Url::to(['user-center/user-level-info', 'level_id' => '4']) ?>" <?php if ($data['level_id'] == 4):?> class="hover" <?php endif;?>>C级</a><a href="<?= \yii\helpers\Url::to(['user-center/user-level-info', 'level_id' => '5']) ?>" <?php if ($data['level_id'] == 5):?> class="hover" <?php endif;?>>B级</a><a href="<?= \yii\helpers\Url::to(['user-center/user-level-info', 'level_id' => '6']) ?>" <?php if ($data['level_id'] == 6):?> class="hover" <?php endif;?>>A级</a><a href="<?= \yii\helpers\Url::to(['user-center/user-level-info', 'level_id' => '7']) ?>" <?php if ($data['level_id'] == 7):?> class="hover" <?php endif;?>>职业级</a> <span class="pxbxi_Set2">我的注册信息</span></h3>
<?php if (!empty($data['model'])) { ?>

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
                    （<?= \app\models\Level::getOneLevelNameById($data['model']['level_id'] + 1) ?>
                    ）教练员
                </td>
            </tr>
        </table>
        <div class="table_box">
            <table cellpadding="0" cellspacing="0" class="table_set1">
                <tr>
                    <td></td>
                    <td>
                        <?php if (!empty($data['model']['photo'])) { ?>


                            <div class="crop">
                                <div id="cropzoom_container"></div>
                                <div id="preview"><img
                                        src="/upload/images/users_info/photo/<?= $data['model']['photo'] ?>"
                                        width="157" height="210"/></div>
                            </div>


                            <input name="old_photo" type="hidden" value="<?= $data['model']['photo'] ?>">

                        <?php } ?>
                    </td>
                </tr>
                <?php if ($data['model']['status'] == \app\models\UsersLevel::REG) { ?>

                <tr>
                    <td>形象照片：</td>


<!--                        <input name="UsersLevel[photo]" id="photo" type="file">-->
<!--                        <div style="float:none;"><input type="button" value="点击上传图片" id="btnUpload"/></div>-->
<!--                        <div style="width:100%;overflow:hidden">-->
<!--                            <div style="display:none;overflow:hidden;float:left;" id="div_avatar">-->
<!--                                <div style="overflow:hidden;" id="picture_original"><img alt="" src="" /></div>-->
<!--                            </div>-->
<!--                            <div style="float:left;width:250px;">-->
<!--                                <div id="picture_200" style="margin-top:0px;margin-left:20px;"></div>-->
<!--                                <div id="picture_50" style="margin-top:20px;margin-left:20px;"></div>-->
<!--                                <div id="picture_30" style="margin-top:20px;margin-left:20px;"></div>-->
<!--                                <input type="hidden" id="x1" name="x1" value="0" />-->
<!--                                <input type="hidden" id="y1" name="y1" value="0" />-->
<!--                                <input type="hidden" id="cw" name="cw" value="0" />-->
<!--                                <input type="hidden" id="ch" name="ch" value="0" />-->
<!--                                <input type="hidden" id="imgsrc" name="imgsrc" />-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div style="float:none;">-->
<!--                            <input type="button" value="裁剪上传" id="btnCrop" style="float:left;margin-top:20px;display:none"/>-->
<!--                        </div>-->
                    <td><input name="UsersLevel[photo]" type="file"><span><b>(注：请上传1MB以内高清白底免冠照片，以便制作教练员证书、教练员上岗证等)</b></span>
                    </td>
                </tr>
                <?php }?>
                <tr>
                    <td>考试成绩：</td>
                    <td><span>实践</span><span><input type="text" readonly class="w70"
                                                    value="<?= $data['model']['practice_score'] ?>分"/></span><span>理论</span><span><input
                                type="text" readonly class="w70"
                                value="<?= $data['model']['theory_score'] ?>分"/></span><span>规则</span><span><input
                                type="text" readonly class="w70"
                                value="<?= $data['model']['rule_score'] ?>分"/></span><span>总评</span><span><input
                                type="text" readonly class="w70"
                                value="<?= $data['model']['score_appraise'] ?>分"/></span>
                    </td>
                </tr>
                <tr>
                    <td>教练等级：</td>
                    <td><input type="text" readonly class="w70"
                               value="<?= \app\models\Level::getOneLevelNameById($data['model']['level_id'] + 1) ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>证书编号：</td>
                    <td><span><input type="text" readonly class="w228"
                                     value="<?= $data['model']['certificate_number'] ?>"/></span>
                        <?php if (($data['model']['status'] == \app\models\UsersLevel::SEND_CARD) || ($data['model']['status'] == \app\models\UsersLevel::LEVEL_UP)) { ?>
                            <p class=""><span>查看证书</span><span><img
                                        src="/images/user/zs.jpg" width="33" height="22"/> </span>

                                <a href="<?= \yii\helpers\Url::to(['/search-certificate-number/view', 'certificate_number' => $data['model']['certificate_number'], 'credentials_number' => $data['model']['credentials_number']]) ?>"
                                   target="_blank"><img src="/images/user/zoom.jpg"/></a></p>
                        <?php } else { ?>
                            <p class="opactiy_set"><span>查看证书</span><span><img
                                        src="/images/user/zs.jpg" width="33" height="22"/> </span>

                                <a href="javascript:;"><img src="/images/user/zoom.jpg"/></a></p>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <td>所属区域：</td>
                    <td><?= $data['model']['account_location'] ?></td>
                </tr>
                <tr>
                    <td>收证地址：</td>
                    <td>
                        <span><?= $data['model']['contact_address'] ?></span><span>邮编：<?= $data['model']['contact_postcode'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>注册费：</td>
                    <td><span><input type="text" readonly class="w70"
                                     value="<?= \app\models\Level::getRegisterFeeById($data['model']['level_id'] + 1) ?>"/> 元 (注册费用包含：教练员证书、教练员装备、教练员年费)</span><span
                            class="pay"><b class="fl">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><b>注：</b>您可以选择线下缴纳注册费，线下缴费需要在7个工作日内到指定地点完成缴费</td>
                </tr>
                <tr>
                    <td>状态：</td>
                    <td><span><?= \app\models\UsersLevel::$statusList[$data['model']['status']] ?></span></td>
                </tr>
                <?php if ($data['model']['status'] == \app\models\UsersLevel::REG) { ?>

                    <tr>
                        <td>支付方式：</td>
                        <td><select name="pay_type">
                                <option value="2">线下支付</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name="id" value="<?= $data['model']['id'] ?>" type="hidden"><input type="submit"
                                                                                                       value="提交教练员注册审核"
                                                                                                       class="tj_btn"/>
                        </td>
                    </tr>
                <?php } elseif ($data['model']['status'] == \app\models\UsersLevel::PAY) { ?>

                    <tr>
                        <td>支付方式：</td>
                        <td><?= \app\models\UsersLevel::$payTypeList[$data['model']['pay_type']] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name="id" value="<?= $data['model']['id'] ?>" type="hidden"><input disabled
                                                                                                       type="submit"
                                                                                                       value="审核中"
                                                                                                       class="tj_btn2"/>
                        </td>
                    </tr>
                <?php }  else {?>
                    <tr>
                        <td>支付方式：</td>
                        <td><?= \app\models\UsersLevel::$payTypeList[$data['model']['pay_type']] ?></td>
                    </tr>
                    <tr>
                        <td>距离到期时间还有：</td>
                        <td><?= round((strtotime($data['model']['end_date']) - time()) / (3600 * 24), 0) ?>天</td>
                    </tr>
                <?php }?>

            </table>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php } else { ?>
    <div class="tab_son box_table1 ClearFix">
        <p class="sorry_p"><span>对不起，您不是该级别教练员，未有相关注册信息</span></p>
    </div>
<?php } ?>
<!--市级教练员-->
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