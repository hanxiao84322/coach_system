<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--top-->
<div class="top">
    <div class="time_login">
        <p class="fl" id="time">
            <script language=JavaScript>
                var d, s = "";
                var x = new Array("星期日", "星期一", "星期二","星期三","星期四", "星期五","星期六");
                d = new Date();
                s+=d.getFullYear()+"年"+(d.getMonth() + 1)+"月"+d.getDate()+"日　";
                s+=x[d.getDay()];
                document.writeln(s);
            </script>
        </p>
        <p class="fr login_box"><?php if (Yii::$app->user->isGuest) {?><a href="<?= Url::to('/login/login')?>">登录</a><?php } else { ?><a href="<?= Url::to('/user-center/index')?>">会员中心</a> | <a href="<?= Url::to('/user/logout')?>">登出</a><?php }?> | <a href="javascript:;">加入收藏</a></p>
    </div>
</div>
<!--top-->
<!--logo search-->
<div class="logo_search">
    <h1 class="fl"><a href="javascript:;"><img src="/images/logo.jpg" /></a></h1>
    <div class="fr search_system">
        教练员注册管理系统<span>培训报名申请</span>
    </div>
</div>
<!--logo search-->
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
    'options'=>['enctype'=>'multipart/form-data'],
    'action' => \yii\helpers\Url::to('/user/register')
]); ?>
<div class="bjsj_register">
    <div class="div_register">
        <p class="login_infro"><span>登录信息</span>【 第<?= $data['maxCount']?>位  报名申请 】<?= $data['trainName']?> </p>
        <p class="dl_check"><a href="<?= \yii\helpers\Url::to(['/user/register', 'type' => 'mobile_phone', 'train_id' => $data['train_id']])?>" class="hover">用手机号码注册</a><a href="<?= \yii\helpers\Url::to(['/user/register', 'type' => 'email', 'train_id' => $data['train_id']])?>">用邮箱注册</a></p>

        <table cellpadding="0" cellspacing="0" class="table_login">
            <?php if ($type == 'email') {?>
            <script>
            $('.dl_check a:eq(1)').addClass('hover').siblings().removeClass('hover');
			 </script>
            <tr>
                <td width="145" align="right"><b>*</b>邮箱地址：</td>
                <td><input type="text" name="email" class="phone"><span class='state1'></span></td>
            </tr>
            <?php } else {?>
            <script>
            $('.dl_check a:eq(0)').addClass('hover').siblings().removeClass('hover');
			 </script>
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
                <td><input name="train_id" type="hidden" value="<?=$data['train_id']?>"><input type="submit" value="提交报名申请" class="button_btn" name="submit" id="submit"/> <span></span></td>
            </tr>
        </table>
    </div>
</div>

