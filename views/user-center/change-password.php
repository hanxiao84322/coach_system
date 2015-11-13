<?php
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

?>
<script>
    $(document).ready(function () {
        $("#get_check_num").click(function () {
            $.get("/user-center/get-check-num?phone=" +<?= $data['phone']?>, function (data) {
                alert(data);
            });
        });

        var test = {
            node: null,
            count: 60,
            start: function () {
                //console.log(this.count);
                if (this.count > 0) {
                    this.node.innerHTML = this.count--;
                    var _this = this;
                    setTimeout(function () {
                        _this.start();
                    }, 1000);
                } else {
                    this.node.removeAttribute("disabled");
                    this.node.innerHTML = "再次发送";
                    this.count = 60;
                }
            },
            //初始化
            init: function (node) {
                this.node = node;
                this.node.setAttribute("disabled", true);
                this.start();
            }
        };
    });
</script>
<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left', ['data' => $data]); ?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">登录信息</h3>

                        <div class="safe_box">
                            <p class="p_boxset"><span>修改密码</span></p>
                            <?php if ($data['step'] == 1) { ?>
                                <?php $form = ActiveForm::begin(); ?>
                                <div class="three_box">
                                    <p class="lc_set"><img src="/images/user/x1.jpg"/></p>
                                    <table cellpadding="0" cellspacing="0" class="tas_s">
                                        <tr>
                                            <td align="right">已验证手机：</td>
                                            <td><b><?= $data['phoneHidden'] ?></b></td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="120" valign="top" style="line-height:26px;">请填写手机校验码：</td>
                                            <td><input type="text" class="w188" name="check_num"/><input type="button"
                                                                                                         value="获取短信校验码"
                                                                                                         id="get_check_num"
                                                                                                         name="get_check_num"
                                                                                                         class="w215se"><span
                                                    style="font-size:12px;margin-top:5px;color:#999;">校验码已发出，请注意查收短信，如果没有收到，你可以在<b>49</b>秒后要求系统重新发送</span>
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" value="提交" class="srsq"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php ActiveForm::end(); ?>
                            <?php } elseif ($data['step'] == 2) { ?>
                                <div class="three_box">
                                    <p class="lc_set"><img src="/images/user/x2.jpg"/></p>

                                    <?php $form = ActiveForm::begin(); ?>
                                    <table cellpadding="0" cellspacing="0" class="tas_s">
                                        <tr>
                                            <td align="right" width="120"><b style="color:#E3393C;">*</b>新的登录密码：</td>
                                            <td><input type="password" name="password" class="w188"/></td>
                                        </tr>
                                        <tr>
                                            <td align="right" width="120"><b style="color:#E3393C;">*</b>请再输入一次密码：</td>
                                            <td><input type="password" name="password_confirm" class="w188"/></td>
                                        </tr>
                                        <tr>
                                            <?= $form->field($model, 'verifyCode', [
                                                'options' => ['class' => 'form-group form-group-lg'],
                                            ])->widget(Captcha::className(), [
                                                'template' => '<td align="right">验证码：</td><td><input type="text" class="w188" name="verifyCode" /><div class="col-lg-3">{image}</div></td>',
                                                'imageOptions' => ['alt' => '验证码'],
                                            ]); ?>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" value="提交" class="w215se_set"></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php ActiveForm::end(); ?>
                            <?php } elseif ($data['step'] == 3) { ?>
                                <div class="three_box">
                                    <p class="lc_set"><img src="/images/user/x3.jpg"/></p>

                                    <div class="email_success">
                                        <p class="fl"><img src="/images/user/dui.jpg"/></p>

                                        <p class="fl cong_get"><span>恭喜您，修改密码成功！</span><span
                                                style="font-size:12px;color:#666;">最新安全评级：<b
                                                    class="prgess"></b> 高级</span>您的账户安全级还能提升哦，快去<a href="<?= \yii\helpers\Url::to('/user-center/login-info')?>">安全中心</a>完善其他安全设置提高评级吧！
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="attention">
                            安全服务提示<br/>1. 验证邮箱可加强账户安全，您可以使用已验证邮箱快速找回密码或支付密码；<br/>2. 已验证邮箱可用于账户余额变动提醒。<br/>
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