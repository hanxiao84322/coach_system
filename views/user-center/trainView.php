<div class="content_user">
<div class="max_width">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<?= $this->render('left',['result' => $result]);?>
<td valign="top">
<div class="content_box">
<h3 class="h3_h40s"><?= $result['trainModel']['name']?></h3>
<div class="conbox_set">
<table cellpadding="0" cellspacing="0" class="table_set">
    <tr>
        <th>报名情况</th>
        <th>报名截止</th>
        <th>类别</th>
        <th>培训开始时间</th>
        <th>课程状态</th>
        <th>我的状态</th>
    </tr>
    <tr>
        <td>招<b class="blue"><?= $result['trainModel']['recruit_count']?></b>人 | 录取<b class="blue"><?= \app\models\TrainUsers::getRecruitCount($result['trainModel']['train_id'])?></b>人 | 结业<b class="blue"><?= \app\models\TrainUsers::getPassCount($result['trainModel']['train_id'])?></b>人</td>
        <td><?= date('Y-d-m', strtotime($result['trainModel']['sign_up_begin_time']))?></td>
        <td><?= \app\models\Train::getCategoryName($result['trainModel']['category'])?></td>
        <td><?= date('Y-d-m', strtotime($result['trainModel']['begin_time']))?></td>
        <td><b class="blue"><?= \app\models\Train::$statusList[$result['trainModel']['status']]?></b></td>
        <td><b class="blue"><?= \app\models\TrainUsers::$statusList[$result['trainModel']['user_status']]?></b></td>
    </tr>
</table>
<div class="tabs martop">
    <h3 class="title_h42"><a href="javascript:;">我的成绩</a><a href="javascript:;">我的考勤</a><a href="javascript:;">我的评估</a><span class="pxke_Set">我的培训信息</span></h3>
    <!--我的成绩-->
    <div class="tab_son">
        <div class="sj_six">
            <ul>
                <li><p class="shen_blue">实 践</p><span><?= $result['trainModel']['practice_score']?><b>分</b></span></li>
                <li><p class="qian_blue">理 论</p><span><?= $result['trainModel']['theory_score']?><b>分</b></span></li>
                <li><p class="qian1_blue">规 则</p><span><?= $result['trainModel']['rule_score']?><b>分</b></span></li>
                <li><p class="green">总 评</p><span><?= $result['trainModel']['score_appraise']?></span></li>
                <li><p class="yellow">评价结果</p><span class="fz20"><?= $result['trainModel']['appraise_result']?></span></li>
            </ul>
        </div>
    </div>
    <!--我的成绩-->
    <!--我的考勤-->
    <div class="tab_son">
        <div class="sj_six1">
            <ul class="fl ul_box">
                <?php if (!empty($result['attendanceModel'])) {?>
                    <?php foreach ($result['attendanceModel'] as $key => $val):?>
                        <li><a href="javascript:;" <?php if ($val['status'] == \app\models\Attendance::LATER) {?>class="pink"<?php } elseif ($val['status'] == \app\models\Attendance::EARLY) {?>class="blue"<?php } elseif ($val['status'] == \app\models\Attendance::ABSENCES) { ?>class="yellow"<?php } elseif ($val['status'] == \app\models\Attendance::EARLY) { ?>class="green"<?php }?>><?= date('Y-m-d', strtotime($val['day']))?></a></li>

                    <?php endforeach; ?>
                <?php }?>

            </ul>
            <ul class="cds_ul">
                <li><span class="pink">迟 到</span><?= $result['laterCount'] ?></li>
                <li><span class="blue">早 退</span><?= $result['arlyCount'] ?></li>
                <li><span class="yellow">旷 课</span><?= $result['absencesCount'] ?></li>
                <li><span class="green">请 假</span><?= $result['leaveCount'] ?></li>
            </ul>
            <p class="all_yellow"><span>考勤结果</span><?= $result['attendanceAppraise'] ?></p>
        </div>
    </div>
    <!--我的考勤-->
    <!--我的评估-->
    <div class="tab_son">
        <div class="sj_six">
            <ul>
                <li><p class="shen_blue">实 践</p><span><?= $result['trainModel']['practice_comment']?></span></li>
                <li><p class="qian_blue">理 论</p><span><?= $result['trainModel']['theory_comment']?></span></li>
                <li><p class="qian1_blue">规 则</p><span><?= $result['trainModel']['rule_comment']?></span></li>
                <li><p class="green">总 评</p><span class="green"><?= $result['trainModel']['total_comment']?></span></li>
                <li><p class="yellow">评价结果</p><span class="fz20">
                <?php for ($i=1; $i<=($result['trainModel']['score_appraise']/20); $i++) {?>
                    <img src="/images/user/xx1.jpg" />
                <?php }?>
                        <?php if ($result['trainModel']['score_appraise']%20 > 0) {?><img src="/images/user/xx2.jpg" /><?php }?>
                         </span>

                </li>
            </ul>
        </div>
    </div>
    <!--我的评估-->
</div>

<div class="tabs martop">
    <h3 class="title_h42"><a href="javascript:;">讲师团队</a><a href="javascript:;">培训班成员</a><a href="javascript:;">培训地点</a><span class="pxbxi_Set">培训班信息</span></h3>
    <!--讲师团队-->
    <div class="tab_son box_table">
        <div class="adva">
            <div class="adva0">
                <div class="leftLoop1">
                    <div class="bd">
                        <ul class="picList">
                            <?php foreach ($result['trainTeachersModel'] as $key => $val) :?>
                            <li>
                                <div class="pic">
                                    <a href="javascript:;">
                                        <span><img src="/images/user/pic17.jpg"/></span>
                                        <p>
                                            姓名：罗纳尔多<br />年龄：39<br />职称：国家A级教练员讲师<br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                        </p>
                                    </a>
                                </div>
                                <p class="p_pingfen">给教练评分：<img src="/images/user/xx4.jpg" /> <img src="/images/user/xx4.jpg" /> <img src="/images/user/xx4.jpg" /> <img src="/images/user/xx4.jpg" /> <img src="/images/user/xx4.jpg" /> <a href="javascript:;">提交</a></p>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <div class="hd">
                        <a class="next"></a>
                        <a class="prev"></a>
                        <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--讲师团队-->
    <!--培训学员-->
    <div class="tab_son box_table ClearFix">
        <div class="adva">
            <div class="adva0">
                <div class="leftLoop1">
                    <div class="bd">
                        <ul class="picList">
                            <li>
                                <div class="pic">
                                    <a href="javascript:;">
                                        <span><img src="/images/user/pic17.jpg"/></span>
                                        <p>
                                            姓名：罗纳尔多<br />年龄：39<br />职称：国家A级教练员讲师<br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                        </p>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="pic">
                                    <a href="javascript:;">
                                        <span><img src="/images/user/pic17.jpg"/></span>
                                        <p>
                                            姓名：罗纳尔多<br />年龄：39<br />职称：国家A级教练员讲师<br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                        </p>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="pic">
                                    <a href="javascript:;">
                                        <span><img src="/images/user/pic17.jpg"/></span>
                                        <p>
                                            姓名：罗纳尔多<br />年龄：39<br />职称：国家A级教练员讲师<br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                        </p>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="hd">
                        <a class="next"></a>
                        <a class="prev"></a>
                        <ul><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li></ul>

                    </div>
                </div>
                <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
            </div>
        </div>
    </div>
    <!--培训学员-->
    <!--培训地点-->
    <div class="tab_son box_table2 ClearFix">
        <div class="map fl">
            <img src="/images/user/map.jpg" />
        </div>
        <p class="adress">
            <span>公交路线</span>
            532路、690路、397路
            <span>周边站点</span>
            苏家屯、双桥南街东口、东旭花园小区...
            <span>提示</span>
            址：北京市宣武区先农坛体育场内2号楼 址：北京市宣武区先农坛体育场内2号楼
        </p>
    </div>
    <!--培训地点-->
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