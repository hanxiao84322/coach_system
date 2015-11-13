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

<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="rgsd_box_set">
            <p class="registStep" style="text-align:center;margin-top:25px;"><img src="/images/registStep2.jpg" /></p>
            <ul class="nrset_set">
                <li>
                    <h2 style="height:40px;background:#438e0d;color:#fff;font-size:16px;line-height:40px;text-align:center;margin:0px 0px 20px 0px;"><?= $trainName?></h2>

                    <h1><span>教育经历</span></h1>
                    <div class="form_input" style="display: block;">
                        <div class="divp_pt">
                            <table cellpadding="0" cellspacing="0" class="wans_content">
                                <tr>
                                    <th>序</th>
                                    <th>学校名称</th>
                                    <th>时间</th>
                                    <th>学历/学位</th>
                                    <th>操作</th>
                                </tr>
                                <?php if (!empty($model)) {?>
                                <?php foreach ($model as $key => $val) :?>
                                <tr>
                                    <td><?= $key+1?></td>
                                    <td><?= $val['school']?></td>
                                    <td><?= date('Y-m-d',strtotime($val['begin_time']))?> - <?= date('Y-m-d',strtotime($val['end_time']))?></td>
                                    <td><?= $val['educational_background']?></td>
                                    <td><a href="<?= \yii\helpers\Url::to(['/user/register-education', 'id' => $val['id'], 'train_id' => $train_id])?>">删除</a></td>
                                </tr>
                                <?php endforeach;?>
                                <?php } else {?>
                                <tr>
                                    <td colspan="5">请添加教育经历</td>
                                </tr>
                                <?php }?>
                            </table>
                            <?php $form = ActiveForm::begin([
                                'id' => 'registerInfo',
                                'enableAjaxValidation' => false,
                                'action' => \yii\helpers\Url::to('/user/register-education')
                            ]); ?>
                            <table cellpadding="0" cellspacing="0" class="fixed_information">
                                <tr>
                                    <td align="right"><em>*</em>时间：</td>
                                    <td><input type="text" id="d221" name="UsersEducation[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})" /> 至 <input type="text" id="d221" name="UsersEducation[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）</td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>地点：</td>
                                    <td><input type="text" value="" class="w400" name="UsersEducation[address]"/><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>学校名称：</td>
                                    <td><input type="text" value="" class="w400" name="UsersEducation[school]"/><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>学历/学位：</td>
                                    <td><select class="w78" name="UsersEducation[educational_background]">
                                            <option value="博士">博士</option>
                                            <option value="硕士">硕士</option>
                                            <option value="本科">本科</option>
                                            <option value="专科">专科</option>
                                            <option value="高中">高中</option>
                                            <option value="初中">初中</option>
                                            <option value="小学">小学</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td align="right"><em>*</em>证明人：</td>
                                    <td><input type="text" value="" class="w189" name="UsersEducation[witness]"/> <span class='state1'></span>证明人电话：<input name="UsersEducation[witness_phone]" type="text" value="" class="w189"/></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top"><em>*</em>描述：</td>
                                    <td><textarea class="w480" name="UsersEducation[description]"></textarea><span class='state1'></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input name="train_id" type="hidden" value="<?= $train_id?>"><input type="submit" value="保 存" class="fixe_btn"/><a href="<?= \yii\helpers\Url::to(['/user/register-train', 'train_id' => $train_id])?>">下一步，添加培训信息</a></td>
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