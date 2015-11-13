<?php
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

?>
<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">登录信息</h3>
                        <div class="safe_box">
                            <p class="p_boxset"><span>验证手机</span></p>
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="three_box">
                                <p class="lc_set"><img src="/images/user/x1.jpg"/></p>
                                <table cellpadding="0" cellspacing="0" class="tas_s">
                                    <tr>
                                        <td align="right">已验证手机：</td>
                                        <td><b><?= $data['phoneHidden'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td align="right" width="120">请填写手机校验码：</td>
                                        <td><input type="text" class="w188" name="check_num"/><input type="button"
                                                                                                     value="获取短信校验码"
                                                                                                     id="get_check_num"
                                                                                                     name="get_check_num"
                                                                                                     class="w215se"><span
                                                style="font-size:12px;margin-top:5px;color:#999;">校验码已发出，请注意查收短信，如果没有收到，你可以在<b>49</b>秒后要求系统重新发送</span>
                                        </td>
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
                                        <td><input type="submit" value="提交" class="srsq"/></td>
                                    </tr>
                                </table>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="attention">
                            安全服务提示<br />1. 验证邮箱可加强账户安全，您可以使用已验证邮箱快速找回密码或支付密码；<br />2. 已验证邮箱可用于账户余额变动提醒。<br />
                        </div>
                    </div>
                    <!--footer-->
                    <p class="copyright_Set">Copyright © 2015   版权所有</p>
                    <!--footer-->
                </td>
            </tr>
        </table>
    </div>
</div>