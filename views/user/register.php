<?php
use yii\widgets\ActiveForm;
?>
<script>
    $(document).ready(function(){
        $("#get_check_num").click(function (){
            $.get("/user/get-check-num?phone="+$("#phone").val(),function(data){
            alert(data);
            });
        });

        var test = {
            node:null,
            count:60,
            start:function(){
                //console.log(this.count);
                if(this.count > 0){
                    this.node.innerHTML = this.count--;
                    var _this = this;
                    setTimeout(function(){
                        _this.start();
                    },1000);
                }else{
                    this.node.removeAttribute("disabled");
                    this.node.innerHTML = "再次发送";
                    this.count = 60;
                }
            },
            //初始化
            init:function(node){
                this.node = node;
                this.node.setAttribute("disabled",true);
                this.start();
            }
        };
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
        <table cellpadding="0" cellspacing="0" class="table_login">
            <?php if ($type == 'email') {?>
            <tr>
                <td width="145" align="right"><b>*</b>邮箱地址：</td>
                <td><input type="text" name="email" class="phone"><span class='state1'></span></td>
            </tr>
            <?php } else {?>
            <tr>
                <td width="145" align="right"><b>*</b>手机号码：</td>
                <td><input type="text" value="" name="phone" class="phone" id="phone"><span class='state1'></span></td>
            </tr>
            <tr>
                <td align="right"><b>*</b>验证码：</td>
                <td><input type="text" value="" class="w130" name="check_num"><input type="button" name="get_check_num" value="获取短信验证码" class="button_hq" id="get_check_num" /> 请输入手机收到的验证码。如果一段时间没收到，请重新获取</td>
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
                <td><input name="train_id" type="hidden" value="<?=$train_id?>"><input type="submit" value="提交报名申请" class="button_btn" name="submit" id="submit"/> <span></span></td>
            </tr>
        </table>
    </div>
</div>
<?php ActiveForm::end(); ?>

