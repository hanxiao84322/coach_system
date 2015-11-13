<script language="javascript" type="text/javascript" src="/js/My97DatePicker/WdatePicker.js"></script>
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<?php $this->beginBody() ?>

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
        教练员管理系统
    </div>
</div>
<!--logo search-->
<div class="pxmobSet" style="background:url(/images/Npxbm.jpg) no-repeat center top;height:119px;"></div>

<div class="content_box">
    <div class="con_set">
        <div class="rgsd_box_set">
            <p class="registStep" style="text-align:center;margin-top:25px;"><img src="/images/registStep4.jpg" /></p>
            <ul class="nrset_set">
                <li>
                    <h2 style="height:40px;background:#438e0d;color:#fff;font-size:16px;line-height:40px;text-align:center;margin:0px 0px 20px 0px;"><?= $trainName?></h2>

                    <h1><span>执教经历</span></h1>
                    <div class="form_input" style="display: block;">
                        <div class="divp_pt">
                            <table cellpadding="0" cellspacing="0" class="wans_content">
                                <tr>
                                    <th>序</th>
                                    <th>执教球队</th>
                                    <th>时间</th>
                                    <th>任职</th>
                                    <th>操作</th>
                                </tr>
                                <?php if (!empty($model)) {?>
                                    <?php foreach ($model as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><?= $val['team'] ?></td>
                                            <td><?= date('Y-m-d',strtotime('2012-10-30 06:46:12'))?> - <?= date('Y-m-d',strtotime('2015-10-30 06:46:12'))?></td>
                                            <td><?= $val['post']?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user/register-vocational', 'id' => $val['id'], 'train_id' => $train_id])?>">删除</a></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php } else {?>
                                    <tr>
                                        <td colspan="5">请添加执教经历</td>
                                    </tr>
                                <?php }?>
                            </table>
                            <?php $form = ActiveForm::begin([
                                'id' => 'registerInfo',
                                'enableAjaxValidation' => false,
                                'action' => \yii\helpers\Url::to('/user/register-vocational')
                            ]); ?>
                            <table cellpadding="0" cellspacing="0" class="fixed_information">
                                <tr>
                                    <td colspan="2" style="color:#E4393D;">（未有执教经历的学员可不填写！）</td>
                                </tr>
                                <tr>
                                    <td align="right">时间：</td>
                                    <td><input type="text" id="d221" name="UsersVocational[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})"/> 至 <input type="text" id="d221" name="UsersVocational[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）</td>
                                </tr>
                                <tr>
                                    <td align="right">地点：</td>
                                    <td><input type="text" value="" class="w400" name="UsersVocational[address]"/><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td align="right">执教球队：</td>
                                    <td><input type="text" value="" class="w400" name="UsersVocational[team]"/><span class='state1'></span></td>
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
                                    <td align="right">证明人：</td>
                                    <td><input type="text" value="" class="w189" name="UsersVocational[witness]"/> <span class='state1'></span>证明人电话：<input name="UsersVocational[witness_phone]" type="text" value="" class="w189"/></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top">描述：</td>
                                    <td><textarea class="w480" name="UsersVocational[description]"></textarea><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input name="train_id" type="hidden" value="<?= $train_id?>"><input type="submit" value="保 存" class="fixe_btn"/><a href="<?= \yii\helpers\Url::to(['/user/register-players','train_id' => $train_id])?>">添加运动信息</a><a href="<?= \yii\helpers\Url::to(['/user/apply', 'train_id' => $train_id])?>">填写完成</a></td>
                                </tr>
                            </table>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </li>

            </ul>

        </div>
    </div>
</div>
<!--content-->