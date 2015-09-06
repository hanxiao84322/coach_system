<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left',['result' => $result]);?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40"><span class="fl">您好：<b><?= Yii::$app->user->identity->username?></b>　　欢迎光临北京足协教练员管理系统！</span><span class="fr">您的级别：<b><?= $result['levelName']?></b></span></h3>
                        <div class="h196">
                            <img src="/images/user/pic2.jpg" />
                            <p><span>站内公告</span>1、热爱教练事业有限<br />2、大专以上学历（体育专业优先）<br />3、年龄在25-45岁<br />4、提交报名表后会在7-14个工作日以短信形式通知滤去信息以及培训信息，请您务必准确填写每项信息<br /><b>注意：如有虚假报名申请请教列入教练员黑名单！！</b></p>
                        </div>
                        <div class="tabs martop">
                            <h3 class="title_h42"><a href="javascript:;">我的课程</a><a href="javascript:;">我的活动</a><span class="pxbxi_Set">我的互动管理</span></h3>
                            <!--我的课程-->
                            <div class="tab_son box_table1 ClearFix">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班名称</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>报名人数</th>
                                        <th>报名状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php if (!empty($result['trainModel'])) {?>
                                    <?php foreach ($result['trainModel'] as $key => $val) :?>
                                    <tr>
                                        <td><?= $key + 1?></td>
                                        <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['id']])?>"><?= $val['name']?></a></td>
                                        <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                        <td><?= $val['begin_time']?></td>
                                        <td><?= $val['address']?></td>
                                        <td>招<?= $val['recruit_count']?>人 ( <b class="red">已录取 <?= \app\models\TrainUsers::getRecruitCount($val['train_id'])?> 人</b> )</td>
                                        <td><b class="<?php if ($val['status'] == '6') {?>red<?php }elseif ($val['status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['status']]?></b></td>
                                        <td>
                                            <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                            <?php if (in_array($val['status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                            <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['id'], 'status' => 7])?>">取消</a>
                                            <?php }?>
                                            <?php if (in_array($val['status'], [\app\models\TrainUsers::END,\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                            <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['id']])?>">删除</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php endforeach?>
                                    <?php } else {?>
                                        <td colspan="8">目前没有数据</td>
                                    <?php }?>
                                    <tr>
                                        <td colspan="8" class="bg_set"><a href="<?= \yii\helpers\Url::to(['/user-center/index', 'isPage' => 'false'])?>">查看全部</a></td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="tab_sedtb">
                                    <tr>
                                        <th colspan="2">综合信息统计</th>
                                    </tr>
                                    <tr>
                                        <?php if (empty($result['currentTrain'])) {?>
                                            <td>您目前没有参与的培训课程</td>
                                        <?php } else {?>
                                            <td>您申请报名的培训课程是：<?= $result['currentTrain']['name']?>  状态：<b> <?= \app\models\TrainUsers::$statusList[$result['currentTrain']['status']]?></b> </td>
                                        <?php }?>
                                        <td>您申请报名了：（0）个继续教育活动，（0）个执教活动</td>
                                    </tr>
                                    <tr>
                                        <td>初次注册时间： <?= Yii::$app->user->identity->create_time?></td>
                                        <td>最近登录时间： 2015-04-24 11:32:54</td>
                                    </tr>
                                </table>
                            </div>
                            <!--我的课程-->
                            <!--我的活动-->
                            <div class="tab_son box_table1 ClearFix">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">互动项目名称</th>
                                        <th>类别</th>
                                        <th>活动时间</th>
                                        <th>活动地点</th>
                                        <th>课时</th>
                                        <th>积分</th>
                                        <th>参与人数</th>
                                        <th>报名状态</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>望京小学执教</td>
                                        <td>执教</td>
                                        <td>2015-05-10</td>
                                        <td>望京小学</td>
                                        <td>20课时</td>
                                        <td>00分</td>
                                        <td>招01人 ( <b class="green">已录取 00 人</b> )</td>
                                        <td><a href="javascript:;">审核中</a><a href="javascript:;" class="red">取消</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>校园足球活动</td>
                                        <td>继续考核</td>
                                        <td>2015-05-10</td>
                                        <td>八十一中学</td>
                                        <td>20课时</td>
                                        <td>00分</td>
                                        <td>招12人 ( <b class="green">已录取08 人</b> )</td>
                                        <td><b class="green">活动进行中</b> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="bg_set"><a href="javascript:;">查看全部</a></td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="tab_sedtb">
                                    <tr>
                                        <th colspan="2">综合信息统计</th>
                                    </tr>
                                    <tr>
                                        <?php if (!empty($result['currentTrain'])) {?>
                                        <td>您目前没有参与的培训课程</td>
                                        <?php } else {?>
                                        <td>您申请报名的培训课程是：<?= $result['currentTrain']['name']?>  状态：<b> <?= \app\models\TrainUsers::$statusList[$result['currentTrain']['status']]?></b> </td>
                                        <?php }?>
                                        <td>您申请报名了：（0）个继续教育活动，（0）个执教活动</td>
                                    </tr>
                                    <tr>
                                        <td>初次注册时间： 1970-01-01 08:00:00</td>
                                        <td>最近登录时间： 2015-04-24 11:32:54</td>
                                    </tr>
                                </table>
                            </div>
                            <!--我的活动-->
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