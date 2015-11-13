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
                            <h3 class="h3_h40s">晋升管理</h3>
                            <div class="conbox_set">
                                <div class="h196">
                                    <img src="/images/user/pic2.jpg" />
                                    <p><span>教练员晋升说明！</span>1、热爱教练事业有限<br />2、大专以上学历（体育专业优先）<br />3、年龄在25-45岁<br />4、提交报名表后会在7-14个工作日以短信形式通知滤去信息以及培训信息，请您务必准确填写每项信息<br /><b>注意：如有虚假报名申请请教列入教练员黑名单！！</b></p>
                                </div>
                                <h3 class="jjfc_set20"><span class="fl">我的活动分布</span><span class="fr span_set">您在（<b>7</b>）个地区,参与教练员活动,共获得（<b>50</b>）积分</span></h3>
                                <div class="box_table1 ClearFix" style="width:100%;float:left;">
                                    <ul class="list_uls4">
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;">东城区(8)课时</a></li>
                                        <li><a href="javascript:;" class="hover">东城区(<b>8</b>)课时</a></li>
                                    </ul>
                                </div>
                                <div style="clear:both;height:1px"></div>
                                <h3 class="jjfc_set21"><span class="fl">我的晋级概况</span><span class="fr span_set">我的晋级条件[<?= \app\models\TrainUsers::getAppraiseResultByUserIdAndLevelId(Yii::$app->user->id, Yii::$app->user->identity->level_id+1)?>]</span></h3>
                                <div class="sj_six2" style="height:288px;">
                                    <ul>
                                        <li><div class="div_box"><p class="shen_blue">注册状态</p><span><?= \app\models\UsersLevel::$statusList[$data['levelUpInfo']['usersLevelStatusCurrent']]?><b></b></span></div><div class="progres"><?php if($data['levelUpInfo']['usersLevelStatusCurrent'] != \app\models\UsersLevel::SEND_CARD) { echo "未注册"; } else { echo "已注册";}?><span></span></div></li>
                                        <li><div class="div_box"><p class="qian_blue">活动晋升积分</p><span><?= $data['levelUpInfo']['scoreCurrent']?><b>分</b></span></div><div class="progres"><?php if($data['levelUpInfo']['scoreDiff'] <=0) { echo "已达标"; } else { echo "距下一等级" . $data['levelUpInfo']['creditDiff'] . "积分";}?><span></span></div></li>
                                        <li><div class="div_box"><p class="qian1_blue">公益活动晋升积分</p><span><?= $data['levelUpInfo']['scoreCurrent']?><b>分</b></span></div><div class="progres"><?php if($data['levelUpInfo']['creditDiff'] <=0) { echo "已达标"; }  else { echo "下一等级要求" . $data['levelUpInfo']['creditDiff'];}?><span></span></div></li>
                                        <li><div class="div_box"><p class="green">注册时长</p><span><?= $data['levelUpInfo']['loginDurationCurrent']?><b>个月</b></span></div><div class="progres"><?php if($data['levelUpInfo']['loginDurationDiff'] <=0) { echo "已达标"; }  else { echo "距下一等级" . $data['levelUpInfo']['loginDurationDiff'] . "个月";}?><span></span></div></li>
                                        <li><div class="div_box"><p class="yellow">当前等级</p><span><b><?= $data['levelUpInfo']['levelCurrent']?></b></span></div><div class="progres">下一等级<b><?= $data['levelUpInfo']['levelNameNext']?></b><span></span></div></li>

                                    </ul>
                                    <p style="clear:both;"></p>
                                    <?php if ($data['levelUpInfo']['buttonStyle'] == 'true') {?>
                                        <a href="<?= \yii\helpers\Url::to('/user-center/level-up')?>" class="btnbj1">恭喜您获得教练员晋升资格,点击这里进行<?= $data['levelUpInfo']['levelNameNext']?>教练员培训报名</a>

                                    <?php } else {?>
                                        <a href="javascript:;" class="btnbj"><?= $data['levelUpInfo']['levelNameNext']?>教练员培训报名</a>
                                    <?php }?>
                                    </div>
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