<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left', ['data' => $data]); ?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40"><span class="fl">您好：<b><?= Yii::$app->user->identity->username ?></b>　　欢迎光临北京足协教练员管理系统！</span><span
                                class="fr">您的级别：<b><?= $data['levelName'] ?></b></span></h3>

                        <div class="h196">
                            <img src="/images/user/pic2.jpg"/>

                            <p><span>站内公告</span>1、热爱教练事业有限<br/>2、大专以上学历（体育专业优先）<br/>3、年龄在25-45岁<br/>4、提交报名表后会在7-14个工作日以短信形式通知滤去信息以及培训信息，请您务必准确填写每项信息<br/><b>注意：如有虚假报名申请请教列入教练员黑名单！！</b>
                            </p>
                        </div>
                        <div class="tabs martop">
                            <h3 class="title_h42"><a href="javascript:;">我的课程</a><a href="javascript:;">我的活动</a><span
                                    class="pxbxi_Set">我的互动管理</span></h3>
                            <!--我的课程-->
                            <div class="tab_son box_table1 ClearFix">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">培训课排期</th>
                                        <th>类别</th>
                                        <th>开课时间</th>
                                        <th>培训地点</th>
                                        <th>报名人数</th>
                                        <th>报名状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php if (!empty($data['trainModel'])) { ?>
                                        <?php foreach ($data['trainModel'] as $key => $val) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['id']]) ?>"><?= $val['name'] ?> 第<?= $val['period_num'] ?>期</a>
                                                </td>
                                                <td><?= \app\models\TrainCategory::getNameById($val['category']) ?></td>
                                                <td><?= date('Y年m月d日', strtotime($val['begin_time'])) ?></td>
                                                <td><?= \app\models\TrainLand::getNameById($val['train_land_id']) ?></td>
                                                <td>招<?= $val['recruit_count'] ?>人 ( <b
                                                        class="red">已录取 <?= \app\models\TrainUsers::getRecruitCount($val['train_id']) ?>
                                                        人</b> )
                                                </td>
                                                <td>
                                                    <b class="<?php if ($val['status'] == \app\models\TrainUsers::NO_APPROVED || $val['status'] == \app\models\TrainUsers::SIGN) { ?>red<?php } elseif ($val['status'] == '5') { ?>gray<?php } else { ?>green<?php } ?>"><?= \app\models\TrainUsers::$statusList[$val['status']] ?></b>
                                                </td>
                                                <td>
                                                    <?php if (in_array($val['status'], [\app\models\TrainUsers::NO_APPROVED,  \app\models\TrainUsers::APPROVED])) { ?>
                                                        <a href="<?= \yii\helpers\Url::to('/user-center/user-info') ?>">修改信息</a>
                                                        <?php if ($val['status'] == \app\models\TrainUsers::NO_APPROVED) { ?>
                                                            <a href="<?= \yii\helpers\Url::to(['/user-center/resign', 'train_user_id' => $val['id']]) ?>">重新报名</a>
                                                        <?php } ?>
                                                        <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['id'], 'status' => \app\models\TrainUsers::CANCEL]) ?>">取消</a>
                                                    <?php } elseif ($val['status'] == \app\models\TrainUsers::NO_PASS) { ?>
                                                        <a href="<?= \yii\helpers\Url::to('/train/index') ?>">继续培训</a>
                                                    <?php } elseif ($val['status'] == \app\models\TrainUsers::PASS) { ?>
                                                        <?php if (!empty($val['userLevel'])) {?>
                                                            <a href="<?= \yii\helpers\Url::to(['/user/register-coach', 'register' => 1]) ?>">教练员注册</a>
                                                        <?php } else {?>
                                                            已注册
                                                        <?php } ?>
                                                    <?php } elseif ($val['status'] == \app\models\TrainUsers::SIGN) { ?>
                                                        <?php if (empty($val['userInfo'])) {?>
                                                            <a href="<?= \yii\helpers\Url::to(['/user/register-info', 'train_id' => $val['train_id']]) ?>">完善信息</a><a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['id'], 'status' => \app\models\TrainUsers::CANCEL]) ?>">取消</a>
                                                        <?php } else {?>
                                                            <?php if (empty($val['userEducation'])) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user/register-education', 'train_id' => $val['train_id']]) ?>">完善信息</a><a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['id'], 'status' => \app\models\TrainUsers::CANCEL]) ?>">取消</a>
                                                            <?php } else {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user/register-train', 'train_id' => $val['train_id']]) ?>">完善信息</a><a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['id'], 'status' => \app\models\TrainUsers::CANCEL]) ?>">取消</a>

                                                            <?php } ?>

                                                    <?php } ?>

                                                    <?php } else {?>
                                                        无
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } else { ?>
                                        <td colspan="8">目前没有数据</td>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="8" class="bg_set"><a
                                                href="<?= \yii\helpers\Url::to(['/user-center/index', 'isPage' => 'false']) ?>">查看全部</a>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="tab_sedtb">
                                    <tr>
                                        <th colspan="2">综合信息统计</th>
                                    </tr>
                                    <tr>
                                        <?php if (empty($data['currentTrain'])) { ?>
                                            <td>您目前没有参与的培训课程</td>
                                        <?php } else { ?>
                                            <td>您最近申请报名的培训课程是：<?= $data['currentTrain']['name'] ?>
                                                状态：<b> <?= \app\models\TrainUsers::$statusList[$data['currentTrain']['status']] ?></b>
                                            </td>
                                        <?php } ?>
                                        <td>您申请报名了：（<?= $data['countActivity'] ?>）个继续教育活动，（<?= $data['countActivity'] ?>
                                            ）个执教活动
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>初次注册时间： <?= Yii::$app->user->identity->create_time ?></td>
                                        <td>最近登录时间： 2015-12-24 11:32:54</td>
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
                                    <?php if (!empty($data['activityModel'])) { ?>
                                        <?php foreach ($data['activityModel'] as $key => $val) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']]) ?>"><?= $val['name'] ?></a>
                                                </td>
                                                <td><?= \app\models\ActivityCategory::getNameById($val['category']) ?></td>
                                                <td><?= date('Y年m月d日', strtotime($val['begin_time'])) ?></td>
                                                <td><?= $val['address'] ?></td>
                                                <td><?= $val['lesson'] ?></td>
                                                <td><?= $val['score'] ?></td>
                                                <td>招<?= $val['recruit_count'] ?>人 ( <b
                                                        class="green">已录取 <?= $val['enrollCount'] ?> 人</b> )
                                                </td>
                                                <td><?= \app\models\ActivityUsers::$statusList[$val['status']] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } else { ?>
                                        <td colspan="8">目前没有数据</td>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="9" class="bg_set"><a href="javascript:;">查看全部</a></td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="tab_sedtb">
                                    <tr>
                                        <th colspan="2">综合信息统计</th>
                                    </tr>
                                    <tr>
                                        <?php if (empty($data['currentTrain'])) { ?>
                                            <td>您目前没有参与的培训课程</td>
                                        <?php } else { ?>
                                            <td>您最近申请报名的培训课程是：<?= $data['currentTrain']['name'] ?>
                                                状态：<b> <?= \app\models\TrainUsers::$statusList[$data['currentTrain']['status']] ?></b>
                                            </td>
                                        <?php } ?>
                                        <td>您申请报名了：（<?= $data['countActivity'] ?>）个继续教育活动，（<?= $data['countActivity'] ?>
                                            ）个执教活动
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>初次注册时间： <?= Yii::$app->user->identity->create_time ?></td>
                                        <td>最近登录时间： 2015-04-24 11:32:54</td>
                                    </tr>
                                </table>
                            </div>
                            <!--我的活动-->
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