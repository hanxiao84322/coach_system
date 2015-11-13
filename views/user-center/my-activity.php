<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
<?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">活动项目</h3>
                        <div class="conbox_set">
                            <div class="h196">
                                <img src="/images/user/pic2.jpg" />
                                <p><span>教练员互动规则！</span>1、热爱教练事业有限<br />2、大专以上学历（体育专业优先）<br />3、年龄在25-45岁<br />4、提交报名表后会在7-14个工作日以短信形式通知滤去信息以及培训信息，请您务必准确填写每项信息<br /><b>注意：如有虚假报名申请请教列入教练员黑名单！！</b></p>
                            </div>
                            <div class="tabs martop">
                                <h3 class="title_h43"><a href="javascript:;">市级班</a><a href="javascript:;">D级班</a><a href="javascript:;">C级班</a><a href="javascript:;">B级班</a><a href="javascript:;">A级班</a><a href="javascript:;">职业级班</a><span class="pxbxi_Set1">活动项目</span></h3>
                                <?php if (!empty($data['activityListA'])) { ?>
                                <!--市级教练员-->
                                <div class="tab_son box_table1" style="margin-top:10px;">
                                    <table cellpadding="0" cellspacing="0" class="h31">
                                        <tr>
                                            <td width="50" class="pxset">排序</td>
                                            <td colspan="4">&nbsp;</td>
                                            <td width="100">等级 <img src="/images/user/sj.jpg" /></td>
                                            <td width="100">类别 <img src="/images/user/sj.jpg" /></td>
                                            <td width="100">状态 <img src="/images/user/sj.jpg" /></td>
                                        </tr>
                                    </table>
                                    <div class="table_box">
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
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                    <?php foreach ($data['activityListA'] as $key => $val) :?>
                                            <tr>
                                                <td><?= $key+1?></td>
                                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/my-activity-view', 'activityUserId' => $val['id']])?>"><?= $val['name']?></a></td>
                                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                                <td><?= $val['begin_time']?></td>
                                                <td><?= $val['address']?></td>
                                                <td><?= $val['lesson']?></td>
                                                <td><?= $val['score']?></td>
                                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                                <td><b class="<?php if ($val['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($val['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$val['user_status']]?></b></td>
                                                <td>
                                                    <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                        <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                    <?php }?>
                                                    <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                        <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                    <?php }?>
                                                    <?php if ($val['user_status'] == \app\models\ActivityUsers::NO_PASS) {?>
                                                        <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                    <?php endforeach;?>
                                        </table>
                                        <!--number-->
<!--                                        <div class="number_box">-->
<!--                                            <ul>-->
<!--                                                <li><a href="javascript:;" class="w50">上一页</a></li>-->
<!--                                                <li><a href="javascript:;">1</a></li>-->
<!--                                                <li><a href="javascript:;">2</a></li>-->
<!--                                                <li><a href="javascript:;">3</a></li>-->
<!--                                                <li><a href="javascript:;">4</a></li>-->
<!--                                                <li><a href="javascript:;">5</a></li>-->
<!--                                                <li><a href="javascript:;" class="w50">下一页</a></li>-->
<!--                                                <li><span>倒数</span></li>-->
<!--                                                <li><span><input type="text" class="w50" /></span></li>-->
<!--                                                <li><span class="ye">页</span></li>-->
<!--                                                <li><span><input type="submmit" value="确定" class="w50" /></span></li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
                                        <!--number-->
                                    </div>
                                </div>
                                <!--市级教练员-->
                                <?php } else { ?>
                                <div class="tab_son box_table1 ClearFix">
                                    <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
                                </div>
                                <?php }?>
                                <!--D级教练员-->
                                <?php if (!empty($data['activityListB'])) { ?>
                                    <!--市级教练员-->
                                    <div class="tab_son box_table1" style="margin-top:10px;">
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td width="50" class="pxset">排序</td>
                                                <td colspan="4">&nbsp;</td>
                                                <td width="100">等级 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">类别 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">状态 <img src="/images/user/sj.jpg" /></td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
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
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php foreach ($data['activityListB'] as $key => $val) :?>
                                                    <tr>
                                                        <td><?= $key+1?></td>
                                                        <td><a href="<?= \yii\helpers\Url::to(['/user-center/my-activity-view', 'activityUserId' => $val['id']])?>"><?= $val['name']?></a></td>
                                                        <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                                        <td><?= $val['begin_time']?></td>
                                                        <td><?= $val['address']?></td>
                                                        <td><?= $val['lesson']?></td>
                                                        <td><?= $val['score']?></td>
                                                        <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                                        <td><b class="<?php if ($val['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($val['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$val['user_status']]?></b></td>
                                                        <td>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                            <?php }?>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                            <?php }?>
                                                            <?php if ($val['user_status'] == \app\models\ActivityUsers::NO_PASS) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </table>
                                            <!--number-->

                                            <!--number-->
                                        </div>
                                    </div>
                                    <!--市级教练员-->
                                <?php } else { ?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
                                    </div>
                                <?php }?>
                                <!--D级教练员-->
                                <!--C级教练员-->
                                <?php if (!empty($data['activityListC'])) { ?>
                                    <!--市级教练员-->
                                    <div class="tab_son box_table1" style="margin-top:10px;">
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td width="50" class="pxset">排序</td>
                                                <td colspan="4">&nbsp;</td>
                                                <td width="100">等级 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">类别 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">状态 <img src="/images/user/sj.jpg" /></td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
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
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php foreach ($data['activityListC'] as $key => $val) :?>
                                                    <tr>
                                                        <td><?= $key+1?></td>
                                                        <td><a href="<?= \yii\helpers\Url::to(['/user-center/my-activity-view', 'activityUserId' => $val['id']])?>"><?= $val['name']?></a></td>
                                                        <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                                        <td><?= $val['begin_time']?></td>
                                                        <td><?= $val['address']?></td>
                                                        <td><?= $val['lesson']?></td>
                                                        <td><?= $val['score']?></td>
                                                        <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                                        <td><b class="<?php if ($val['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($val['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$val['user_status']]?></b></td>

                                                        <td>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                            <?php }?>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                            <?php }?>
                                                            <?php if ($val['user_status'] == \app\models\ActivityUsers::NO_PASS) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </table>
                                            <!--number-->
                                            <!--                                        <div class="number_box">-->
                                            <!--                                            <ul>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">上一页</a></li>-->
                                            <!--                                                <li><a href="javascript:;">1</a></li>-->
                                            <!--                                                <li><a href="javascript:;">2</a></li>-->
                                            <!--                                                <li><a href="javascript:;">3</a></li>-->
                                            <!--                                                <li><a href="javascript:;">4</a></li>-->
                                            <!--                                                <li><a href="javascript:;">5</a></li>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">下一页</a></li>-->
                                            <!--                                                <li><span>倒数</span></li>-->
                                            <!--                                                <li><span><input type="text" class="w50" /></span></li>-->
                                            <!--                                                <li><span class="ye">页</span></li>-->
                                            <!--                                                <li><span><input type="submmit" value="确定" class="w50" /></span></li>-->
                                            <!--                                            </ul>-->
                                            <!--                                        </div>-->
                                            <!--number-->
                                        </div>
                                    </div>
                                    <!--市级教练员-->
                                <?php } else { ?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
                                    </div>
                                <?php }?>
                                <!--C级教练员-->
                                <!--B级教练-->
                                <?php if (!empty($data['activityListD'])) { ?>
                                    <!--市级教练员-->
                                    <div class="tab_son box_table1" style="margin-top:10px;">
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td width="50" class="pxset">排序</td>
                                                <td colspan="4">&nbsp;</td>
                                                <td width="100">等级 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">类别 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">状态 <img src="/images/user/sj.jpg" /></td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
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
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php foreach ($data['activityListD'] as $key => $val) :?>
                                                    <tr>
                                                        <td><?= $key+1?></td>
                                                        <td><a href="<?= \yii\helpers\Url::to(['/user-center/my-activity-view', 'activityUserId' => $val['id']])?>"><?= $val['name']?></a></td>
                                                        <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                                        <td><?= $val['begin_time']?></td>
                                                        <td><?= $val['address']?></td>
                                                        <td><?= $val['lesson']?></td>
                                                        <td><?= $val['score']?></td>
                                                        <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                                        <td><b class="<?php if ($val['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($val['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$val['user_status']]?></b></td>

                                                        <td>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                            <?php }?>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                            <?php }?>
                                                            <?php if ($val['user_status'] == \app\models\ActivityUsers::NO_PASS) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </table>
                                            <!--number-->
                                            <!--                                        <div class="number_box">-->
                                            <!--                                            <ul>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">上一页</a></li>-->
                                            <!--                                                <li><a href="javascript:;">1</a></li>-->
                                            <!--                                                <li><a href="javascript:;">2</a></li>-->
                                            <!--                                                <li><a href="javascript:;">3</a></li>-->
                                            <!--                                                <li><a href="javascript:;">4</a></li>-->
                                            <!--                                                <li><a href="javascript:;">5</a></li>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">下一页</a></li>-->
                                            <!--                                                <li><span>倒数</span></li>-->
                                            <!--                                                <li><span><input type="text" class="w50" /></span></li>-->
                                            <!--                                                <li><span class="ye">页</span></li>-->
                                            <!--                                                <li><span><input type="submmit" value="确定" class="w50" /></span></li>-->
                                            <!--                                            </ul>-->
                                            <!--                                        </div>-->
                                            <!--number-->
                                        </div>
                                    </div>
                                    <!--市级教练员-->
                                <?php } else { ?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
                                    </div>
                                <?php }?>
                                <!--B级教练-->
                                <!--A级教练员-->
                                <?php if (!empty($data['activityListE'])) { ?>
                                    <!--市级教练员-->
                                    <div class="tab_son box_table1" style="margin-top:10px;">
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td width="50" class="pxset">排序</td>
                                                <td colspan="4">&nbsp;</td>
                                                <td width="100">等级 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">类别 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">状态 <img src="/images/user/sj.jpg" /></td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
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
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php foreach ($data['activityListE'] as $key => $val) :?>
                                                    <tr>
                                                        <td><?= $key+1?></td>
                                                        <td><a href="<?= \yii\helpers\Url::to(['/user-center/my-activity-view', 'activityUserId' => $val['id']])?>"><?= $val['name']?></a></td>
                                                        <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                                        <td><?= $val['begin_time']?></td>
                                                        <td><?= $val['address']?></td>
                                                        <td><?= $val['lesson']?></td>
                                                        <td><?= $val['score']?></td>
                                                        <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                                        <td><b class="<?php if ($val['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($val['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$val['user_status']]?></b></td>
                                                        <td>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                            <?php }?>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                            <?php }?>
                                                            <?php if ($val['user_status'] == \app\models\ActivityUsers::NO_PASS) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                            <?php }?>
                                                        </td>>
                                                    </tr>
                                                <?php endforeach;?>
                                            </table>
                                            <!--number-->
                                            <!--                                        <div class="number_box">-->
                                            <!--                                            <ul>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">上一页</a></li>-->
                                            <!--                                                <li><a href="javascript:;">1</a></li>-->
                                            <!--                                                <li><a href="javascript:;">2</a></li>-->
                                            <!--                                                <li><a href="javascript:;">3</a></li>-->
                                            <!--                                                <li><a href="javascript:;">4</a></li>-->
                                            <!--                                                <li><a href="javascript:;">5</a></li>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">下一页</a></li>-->
                                            <!--                                                <li><span>倒数</span></li>-->
                                            <!--                                                <li><span><input type="text" class="w50" /></span></li>-->
                                            <!--                                                <li><span class="ye">页</span></li>-->
                                            <!--                                                <li><span><input type="submmit" value="确定" class="w50" /></span></li>-->
                                            <!--                                            </ul>-->
                                            <!--                                        </div>-->
                                            <!--number-->
                                        </div>
                                    </div>
                                    <!--市级教练员-->
                                <?php } else { ?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
                                    </div>
                                <?php }?>
                                <!--A级教练员--
                                <!--职业级教练员-->
                                <?php if (!empty($data['activityListF'])) { ?>
                                    <!--市级教练员-->
                                    <div class="tab_son box_table1" style="margin-top:10px;">
                                        <table cellpadding="0" cellspacing="0" class="h31">
                                            <tr>
                                                <td width="50" class="pxset">排序</td>
                                                <td colspan="4">&nbsp;</td>
                                                <td width="100">等级 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">类别 <img src="/images/user/sj.jpg" /></td>
                                                <td width="100">状态 <img src="/images/user/sj.jpg" /></td>
                                            </tr>
                                        </table>
                                        <div class="table_box">
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
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php foreach ($data['activityListF'] as $key => $val) :?>
                                                    <tr>
                                                        <td><?= $key+1?></td>
                                                        <td><a href="<?= \yii\helpers\Url::to(['/user-center/my-activity-view', 'activityUserId' => $val['id']])?>"><?= $val['name']?></a></td>
                                                        <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                                        <td><?= $val['begin_time']?></td>
                                                        <td><?= $val['address']?></td>
                                                        <td><?= $val['lesson']?></td>
                                                        <td><?= $val['score']?></td>
                                                        <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                                        <td><b class="<?php if ($val['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($val['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$val['user_status']]?></b></td>
                                                        <td>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                            <?php }?>
                                                            <?php if (in_array($val['user_status'], [\app\models\ActivityUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                                <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                            <?php }?>
                                                            <?php if ($val['user_status'] == \app\models\ActivityUsers::NO_PASS) {?>
                                                                <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                            <?php }?>
                                                        </td>

                                                    </tr>
                                                <?php endforeach;?>
                                            </table>
                                            <!--number-->
                                            <!--                                        <div class="number_box">-->
                                            <!--                                            <ul>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">上一页</a></li>-->
                                            <!--                                                <li><a href="javascript:;">1</a></li>-->
                                            <!--                                                <li><a href="javascript:;">2</a></li>-->
                                            <!--                                                <li><a href="javascript:;">3</a></li>-->
                                            <!--                                                <li><a href="javascript:;">4</a></li>-->
                                            <!--                                                <li><a href="javascript:;">5</a></li>-->
                                            <!--                                                <li><a href="javascript:;" class="w50">下一页</a></li>-->
                                            <!--                                                <li><span>倒数</span></li>-->
                                            <!--                                                <li><span><input type="text" class="w50" /></span></li>-->
                                            <!--                                                <li><span class="ye">页</span></li>-->
                                            <!--                                                <li><span><input type="submmit" value="确定" class="w50" /></span></li>-->
                                            <!--                                            </ul>-->
                                            <!--                                        </div>-->
                                            <!--number-->
                                        </div>
                                    </div>
                                    <!--市级教练员-->
                                <?php } else { ?>
                                    <div class="tab_son box_table1 ClearFix">
                                        <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
                                    </div>
                                <?php }?>
                                <!--职业级教练员-->
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
