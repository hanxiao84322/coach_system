<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">登录信息</h3>
                        <div class="safe_box">
                            <p class="p_boxset"><span>安全级别：</span><span class="prgess"></span><span class="green">高级</span></p>
                            <div class="three_box">
                                <ul class="three_list">
                                    <li><span><img src="/images/user/dui.jpg" /></span><span class="font18">登录密码</span><span class="span_line red"> 互联网账户存在被盗风险，建议您定期更改密码以保护账户安全。</span><a href="<?= \yii\helpers\Url::to(['/user-center/change-password', 'step'=>1])?>">修改</a></li>
                                    <?php if (Yii::$app->user->identity->email_auth == 1) {?>
                                    <li><span><img src="/images/user/dui.jpg" /></span><span class="font18">邮箱验证 <img src="/images/user/dui1.jpg" /></span><span class="span_line">您验证的邮箱：<?= $data['emailHidden']?></span><a href="<?= \yii\helpers\Url::to(['/user-center/change-email', 'step'=>1])?>">修改</a></li>
                                <?php } else {?>
                                    <li><span><img src="/images/user/wor.jpg" /></span><span class="font18">邮箱验证 <img src="/images/user/dui2.jpg" /></span><span class="span_line">您验证的邮箱：<?= $data['emailHidden']?></span><a href="<?= \yii\helpers\Url::to('/user-center/check-email')?>"><img src="/images/user/ljyz.jpg" /></a></li>

                                <?php }?>

                                    <?php if (Yii::$app->user->identity->phone_auth == 1) {?>
                                        <li><span><img src="/images/user/dui.jpg" /></span><span class="font18">手机验证 <img src="/images/user/dui1.jpg" /></span><span class="span_line">您验证的手机：<?= $data['phoneHidden']?> 若已丢失或者停用，请立即更换，<b>避免账户被盗</b></span><a href="<?= \yii\helpers\Url::to(['/user-center/change-phone', 'step'=>1])?>">修改</a></li>
                                    <?php } else {?>
                                        <li><span><img src="/images/user/wor.jpg" /></span><span class="font18">手机验证 <img src="/images/user/dui2.jpg" /></span><span class="span_line">您验证的手机：<?= $data['phoneHidden']?> 若已丢失或者停用，请立即更换，<b>避免账户被盗</b></span><a href="<?= \yii\helpers\Url::to('/user-center/check-phone')?>"><img src="/images/user/ljyz.jpg" /></a></li>
                                    <?php }?>
                                </ul>
                            </div>
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