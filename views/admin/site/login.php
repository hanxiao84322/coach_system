<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<style>
body{background:#062100;}
#w0,.footer,.pull-left,.pull-right{display:none;}
.control-label{display:none;}
.yzmI p{float:left;margin-left:5px;}
.yzmI{overflow:hidden;}
.yzmI input{float:left;line-height:38px;}
.form-horizontal .form-group{float:left;margin-left:0px;margin-right:0px;}
.field-adminloginform-rememberme{line-height:20px;margin-top: -15px;}
#adminloginform-verifycode-image{float:left; margin-top: -5px;}
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '登陆';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="boxloginSet">
    <div class="loginBox">
    	<div class="loginSet">
        	<div class="loginLeft fl">
            	<img src="/images/logo2.jpg" />
                <img src="/images/ls.jpg" />
            </div>
            <div class="loginRight fr">
            	<p class="loginTitle">教练员管理系统 - 登陆</p>

		
				 <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ]); ?>
 <div class="yzmI">
        <?= $form->field($model, 'username')->textInput([
		    'class' => 'userBox','placeholder' => '用户名',
            'template' => "{input}<span>{error}</span>",
        ])  ?>
		</div>
 <div class="yzmI">
        <?= $form->field($model, 'password')->passwordInput([
		    'class' => 'pwBox','placeholder' => '密码',
            'template' => "{input}<span>{error}</span>",
        ]) ?>
		</div>
   <div class="yzmI">
        <?= $form->field($model, 'verifyCode')->textInput([
		    'class' => 'yzmSet','placeholder' => '验证码',
            'template' => "{input}",
        ]) ?>

        <?=$form->field($model, 'verifyCode', [
            'options' => ['class' => 'form-group form-group-lg'],
        ])->widget(Captcha::className(),[
            'template' => "{image}",
            'imageOptions' => ['alt' => '验证码'],
            'captchaAction' => '/site/captcha',
        ]); ?>
		</div>
		 <div class="yzmI">
        <?= $form->field($model, 'rememberMe')->checkbox([
		'class' => 'checkBox','checked' => 'checked',
            'template' => "<div class=\"yzmI\">{input}<b>记住我</b></div>",
        ]) ?>
		</div>

                <?= Html::submitButton('登陆', ['class' => 'lgoBox', 'name' => 'login-button']) ?>
  

    <?php ActiveForm::end(); ?>
				
				
				
	<script>
	$('#adminloginform-verifycode').next('p').hide();
	</script>			
				
				
				
				
				
            </div>
        </div>
        <p class="pgwSet"><span class="fl">建议使用IE7及以上版本浏览器访问！</span><span class="fr">Powered by 5JKJ.CN 1.0</span></p>
    </div>
</div> 