<div class="content_user">
<div class="max_width">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <?= $this->render('left',['data' => $data]);?>
<td valign="top">
    <div class="content_box">
        <h3 class="h3_h40s">活动项目</h3>
        <div class="conbox_set">
        <div class="tabs martop">
        <h3 class="title_h43"><a href="javascript:;">市级班</a><a href="javascript:;">D级班</a><a href="javascript:;">C级班</a><a href="javascript:;">B级班</a><a href="javascript:;">A级班</a><a href="javascript:;">职业级班</a><span class="pxbxi_Set1">培训课程</span></h3>
        <!--市级教练员-->
        <?php if (!empty($data['activityListA'])) { ?>
            <!--市级教练员-->
            <div class="tab_son box_table1">
                <div class="table_box">
                    <table cellpadding="0" cellspacing="0" class="table_set">
                        <tr>
                            <th width="50">序</th>
                            <th width="210">活动项目名称</th>
                            <th>类别</th>
                            <th>活动时间</th>
                            <th>活动地点</th>
                            <th>课时</th>
                            <th>积分</th>
                            <th>参与人数</th>
                            <th>报名状态</th>
                        </tr>
                        <?php foreach ($data['activityListA'] as $key => $val) :?>
                            <tr>
                                <td><?= $key+1?></td>
                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']])?>"><?= $val['name']?></a></td>
                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                <td><?= $val['begin_time']?></td>
                                <td><?= $val['address']?></td>
                                <td><?= $val['lesson']?></td>
                                <td><?= $val['score']?></td>
                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                <?php if ($val['status'] == \app\models\Activity::BEGIN_SIGN_UP) {?>
                                    <td><b><a href="<?= \yii\helpers\Url::to(['/user-center/activity-apply', 'id' => $val['id']])?>" style="color:green;">申请报名</a></b></td>
                                <?php } else {?>
                                    <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Activity::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Activity::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Activity::$statusList[$val->status]?></a></b></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
            <!--市级教练员-->
        <?php } else { ?>
            <div class="tab_son box_table1 ClearFix">
                <p class="sorry_p"><span>对不起，未有相关活动信息(不是该级别教练员，不具备参加该级别教练员互动项目！！！)</span></p>
            </div>
        <?php }?>
        <!--市级教练员-->
        <!--D级教练员-->
        <?php if (!empty($data['activityListB'])) { ?>
            <div class="tab_son box_table1">
                <div class="table_box">
                    <table cellpadding="0" cellspacing="0" class="table_set">
                        <tr>
                            <th width="50">序</th>
                            <th width="210">活动项目名称</th>
                            <th>类别</th>
                            <th>活动时间</th>
                            <th>活动地点</th>
                            <th>课时</th>
                            <th>积分</th>
                            <th>参与人数</th>
                            <th>报名状态</th>
                        </tr>
                        <?php foreach ($data['activityListB'] as $key => $val) :?>
                            <tr>
                                <td><?= $key+1?></td>
                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']])?>"><?= $val['name']?></a></td>
                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                <td><?= $val['begin_time']?></td>
                                <td><?= $val['address']?></td>
                                <td><?= $val['lesson']?></td>
                                <td><?= $val['score']?></td>
                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                <?php if ($val['status'] == \app\models\Activity::BEGIN_SIGN_UP) {?>
                                    <td><b><a href="<?= \yii\helpers\Url::to(['/user-center/activity-apply', 'id' => $val['id']])?>" style="color:green;">申请报名</a></b></td>
                                <?php } else {?>
                                    <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Activity::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Activity::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Activity::$statusList[$val->status]?></a></b></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
                    </table>
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
            <div class="tab_son box_table1">
                <div class="table_box">
                    <table cellpadding="0" cellspacing="0" class="table_set">
                        <tr>
                            <th width="50">序</th>
                            <th width="210">活动项目名称</th>
                            <th>类别</th>
                            <th>活动时间</th>
                            <th>活动地点</th>
                            <th>课时</th>
                            <th>积分</th>
                            <th>参与人数</th>
                            <th>报名状态</th>
                        </tr>
                        <?php foreach ($data['activityListC'] as $key => $val) :?>
                            <tr>
                                <td><?= $key+1?></td>
                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']])?>"><?= $val['name']?></a></td>
                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                <td><?= $val['begin_time']?></td>
                                <td><?= $val['address']?></td>
                                <td><?= $val['lesson']?></td>
                                <td><?= $val['score']?></td>
                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                <?php if ($val['status'] == \app\models\Activity::BEGIN_SIGN_UP) {?>
                                    <td><b><a href="<?= \yii\helpers\Url::to(['/user-center/activity-apply', 'id' => $val['id']])?>" style="color:green;">申请报名</a></b></td>
                                <?php } else {?>
                                    <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Activity::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Activity::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Activity::$statusList[$val->status]?></a></b></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
                    </table>
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
            <div class="tab_son box_table1">
                <div class="table_box">
                    <table cellpadding="0" cellspacing="0" class="table_set">
                        <tr>
                            <th width="50">序</th>
                            <th width="210">活动项目名称</th>
                            <th>类别</th>
                            <th>活动时间</th>
                            <th>活动地点</th>
                            <th>课时</th>
                            <th>积分</th>
                            <th>参与人数</th>
                            <th>报名状态</th>
                        </tr>
                        <?php foreach ($data['activityListD'] as $key => $val) :?>
                            <tr>
                                <td><?= $key+1?></td>
                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']])?>"><?= $val['name']?></a></td>
                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                <td><?= $val['begin_time']?></td>
                                <td><?= $val['address']?></td>
                                <td><?= $val['lesson']?></td>
                                <td><?= $val['score']?></td>
                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                <?php if ($val['status'] == \app\models\Activity::BEGIN_SIGN_UP) {?>
                                    <td><b><a href="<?= \yii\helpers\Url::to(['/user-center/activity-apply', 'id' => $val['id']])?>" style="color:green;">申请报名</a></b></td>
                                <?php } else {?>
                                    <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Activity::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Activity::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Activity::$statusList[$val->status]?></a></b></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
                    </table>
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
            <div class="tab_son box_table1">
                <div class="table_box">
                    <table cellpadding="0" cellspacing="0" class="table_set">
                        <tr>
                            <th width="50">序</th>
                            <th width="210">活动项目名称</th>
                            <th>类别</th>
                            <th>活动时间</th>
                            <th>活动地点</th>
                            <th>课时</th>
                            <th>积分</th>
                            <th>参与人数</th>
                            <th>报名状态</th>
                        </tr>
                        <?php foreach ($data['activityListE'] as $key => $val) :?>
                            <tr>
                                <td><?= $key+1?></td>
                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']])?>"><?= $val['name']?></a></td>
                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                <td><?= $val['begin_time']?></td>
                                <td><?= $val['address']?></td>
                                <td><?= $val['lesson']?></td>
                                <td><?= $val['score']?></td>
                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                <?php if ($val['status'] == \app\models\Activity::BEGIN_SIGN_UP) {?>
                                    <td><b><a href="<?= \yii\helpers\Url::to(['/user-center/activity-apply', 'id' => $val['id']])?>" style="color:green;">申请报名</a></b></td>
                                <?php } else {?>
                                    <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Activity::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Activity::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Activity::$statusList[$val->status]?></a></b></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
                    </table>
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
            <div class="tab_son box_table1">
                <div class="table_box">
                    <table cellpadding="0" cellspacing="0" class="table_set">
                        <tr>
                            <th width="50">序</th>
                            <th width="210">活动项目名称</th>
                            <th>类别</th>
                            <th>活动时间</th>
                            <th>活动地点</th>
                            <th>课时</th>
                            <th>积分</th>
                            <th>参与人数</th>
                            <th>报名状态</th>
                        </tr>
                        <?php foreach ($data['activityListF'] as $key => $val) :?>
                            <tr>
                                <td><?= $key+1?></td>
                                <td><a href="<?= \yii\helpers\Url::to(['/user-center/activity-view', 'activity_id' => $val['id']])?>"><?= $val['name']?></a></td>
                                <td><?= \app\models\ActivityCategory::getNameById($val['category'])?></td>
                                <td><?= $val['begin_time']?></td>
                                <td><?= $val['address']?></td>
                                <td><?= $val['lesson']?></td>
                                <td><?= $val['score']?></td>
                                <td>招<?= $val['recruit_count'] ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                                <?php if ($val['status'] == \app\models\Activity::BEGIN_SIGN_UP) {?>
                                    <td><b><a href="<?= \yii\helpers\Url::to(['/user-center/activity-apply', 'id' => $val['id']])?>" style="color:green;">申请报名</a></b></td>
                                <?php } else {?>
                                    <td><b><a href="javascript:;" style="color: <?php if ($val->status == \app\models\Activity::END_SIGN_UP) {?>gray<?php } elseif ($val->status == \app\models\Activity::END_SIGN_UP) { ?>red<?php } else {?>red<?php }?>;"><?= \app\models\Activity::$statusList[$val->status]?></a></b></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
                    </table>
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