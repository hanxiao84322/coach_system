<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left', ['data' => $data]); ?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s"><?= $data['activityModel']['name']?></h3>

                        <div class="conbox_set">
                            <table cellpadding="0" cellspacing="0" class="table_set">
                                <tr>
                                    <th>报名情况</th>
                                    <th>报名截止</th>
                                    <th>类别</th>
                                    <th>活动时间</th>
                                    <th>报名状态</th>
                                    <th>活动状态</th>
                                </tr>
                                <tr>
                                    <td>招<b class="blue"><?= $data['activityModel']['recruit_count']?></b>人 | 录取<b class="blue"><?= \app\models\ActivityUsers::getRecruitCount($data['trainModel']['train_id'])?></b>人 | 结业<b class="blue"><?= \app\models\TrainUsers::getPassCount($data['trainModel']['train_id'])?></b>人</td>
                                    </td>
                                    <td><?= date('Y-m-d',strtotime($data['activityModel']['sign_up_end_time']))?></td>
                                    <td><?= \app\models\ActivityCategory::getNameById($data['activityModel']['category'])?></td>
                                    <td><?= date('Y-m-d',strtotime($data['activityModel']['begin_time']))?>至<?= date('Y-m-d',strtotime($data['activityModel']['end_time']))?></td>
                                    <td><b class="<?php if ($data['activityModel']['user_status'] == \app\models\ActivityUsers::NO_APPROVED) {?>red<?php }elseif ($data['activityModel']['user_status'] == \app\models\ActivityUsers::END){?>gray<?php } else {?>green<?php }?>"><?= \app\models\ActivityUsers::$statusList[$data['activityModel']['user_status']]?></b></td>
                                    <td><b class="blue">
                                            <?php
                                            if ($data['activityModel']['status'] < \app\models\Activity::DOING) {
                                                echo \app\models\Activity::$statusList[$data['activityModel']['status']];
                                            } else {
                                                echo "报名结束";
                                            }
                                            ?>
                                        </b></td>
                                </tr>
                            </table>
                            <div class="tabs martop">
                                <h3 class="title_h42"><a href="javascript:;">活动课时进程</a><a href="javascript:;">活动积分</a><a
                                        href="javascript:;">活动评分</a><span class="pxke_Set3">我的活动情况</span></h3>
                                <!--市级教练员-->
                                <div class="tab_son box_table1" style="margin-top:10px;">
                                    <div class="sj_six1">
                                        <ul class="fl ul_box1">
                                            <?php if (!empty($data['activityProcessModel'])) {?>
                                                <?php foreach ($data['activityProcessModel'] as $key => $val):?>
                                                    <li><a href="javascript:;" <?php if ($val['status'] == \app\models\ActivityProcess::NO_FINISH) {?>class="pink"<?php } elseif ($val['status'] == \app\models\ActivityProcess::FINISH) {?>class="blue"<?php }?>><?= date('Y-m-d', strtotime($val['day']))?></a></li>
                                                <?php endforeach; ?>
                                            <?php }?>
                                        </ul>
                                        <ul class="cds_ul">
                                            <li><span class="green">完 成</span><?= $data['finishCount']?></li>
                                            <li><span class="gray">未完成</span><?= $data['noFinishCount']?></li>
                                            <li class="w150"><span class="yellow">总计完成课时</span><?= $data['finishCount']?></li>
                                        </ul>
                                        <p class="all_yellow1"><span>活动进程</span><?= ($data['finishCount']/count($data['activityProcessModel'])*100)?>%</p>
                                    </div>
                                </div>
                                <!--市级教练员-->
                                <!--D级教练员-->
                                <div class="tab_son box_table1 ClearFix">
                                    <div class="sj_six">
                                        <ul>
                                            <li><p class="shen_blue">实 践</p><span><?= $data['activityModel']['practice_score']?><b>分</b></span></li>
                                            <li><p class="qian_blue">理 论</p><span><?= $data['activityModel']['theory_score']?><b>分</b></span></li>
                                            <li><p class="qian1_blue">规 则</p><span><?= $data['activityModel']['rule_score']?><b>分</b></span></li>
                                            <li><p class="green">活动积分</p><span><?= $data['activityModel']['score_appraise']?><b>分</b></span></li>
                                            <li><p class="yellow">获得积分</p><span><?= $data['activityModel']['appraise_result']?><b>分</b></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--D级教练员-->
                                <!--C级教练员-->
                                <div class="tab_son box_table1 ClearFix">
                                    <div class="sj_six">
                                        <ul>
                                            <li><p class="shen_blue">实 践</p><span><?= $data['activityModel']['practice_comment']?></span></li>
                                            <li><p class="qian_blue">理 论</p><span><?= $data['activityModel']['theory_comment']?></span></li>
                                            <li><p class="qian1_blue">规 则</p><span><?= $data['activityModel']['rule_comment']?></span></li>
                                            <li><p class="green">总 评</p><span class="green"><?= $data['activityModel']['total_comment']?></span></li>
                                            <li><p class="yellow">最终评分</p><span class="fz20"><img src="images/xx1.jpg"/> <img
                                                        src="images/xx1.jpg"/> <img src="images/xx1.jpg"/> <img
                                                        src="images/xx2.jpg"/> <img src="images/xx3.jpg"/></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--C级教练员-->
                            </div>

                            <div class="tabs martop">
                                <h3 class="title_h42"><a href="javascript:;">活动详情</a><a
                                        href="javascript:;">参与活动教练员</a><a href="javascript:;">活动地址</a><span
                                        class="pxke_Set1">活动信息</span></h3>
                                <!--市级教练员-->
                                <div class="tab_son box_table1">
                                    <div class="h155">
                                        <p class="fl line15">
                                            发起者：北京市足球协会<br/>主办方：望京小学<br/>参训者：望京小学四、五、六年级<br/>人数：30人<br/>时间：201-5-10至2015-5-17
                                        </p>

                                        <div class="w420 fl">
                                            <textarea class="textarea">请输入200字以内的活动总结，通过审核后会呈现在活动详情页！</textarea>

                                            <p class="pheigh30">
                                                <button class="button_img"><img src="images/upload.jpg"/></button>
                                                上传图片不超过4张，960宽x560高，300k以内
                                            </p>
                                        </div>
                                        <div class="fr w200">
                                            <div class="picset_th"><img src="images/th.jpg"/>说明：活动结束可发布图文信息，通过审核前台显示
                                            </div>
                                            <button class="button_img"><img src="images/tjsh.jpg"/></button>
                                        </div>
                                    </div>
                                </div>
                                <!--市级教练员-->
                                <!--D级教练员-->
                                <div class="tab_son box_table ClearFix">
                                    <div class="adva">
                                        <div class="adva0">
                                            <div class="leftLoop1">
                                                <div class="bd">
                                                    <ul class="picList">
                                                        <li>
                                                            <div class="pic">
                                                                <a href="javascript:;">
                                                                    <span><img src="images/pic17.jpg"/></span>

                                                                    <p>
                                                                        姓名：罗纳尔多<br/>年龄：39<br/>职称：国家A级教练员讲师<br/>评分：<img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/>
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <p class="p_pingfen">给教练评分：<img src="images/xx4.jpg"/> <img
                                                                    src="images/xx4.jpg"/> <img src="images/xx4.jpg"/>
                                                                <img src="images/xx4.jpg"/> <img src="images/xx4.jpg"/>
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <div class="pic">
                                                                <a href="javascript:;">
                                                                    <span><img src="images/pic17.jpg"/></span>

                                                                    <p>
                                                                        姓名：罗纳尔多<br/>年龄：39<br/>职称：国家A级教练员讲师<br/>评分：<img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/>
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <p class="p_pingfen">给教练评分：<img src="images/xx4.jpg"/> <img
                                                                    src="images/xx4.jpg"/> <img src="images/xx4.jpg"/>
                                                                <img src="images/xx4.jpg"/> <img src="images/xx4.jpg"/>
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <div class="pic">
                                                                <a href="javascript:;">
                                                                    <span><img src="images/pic17.jpg"/></span>

                                                                    <p>
                                                                        姓名：罗纳尔多<br/>年龄：39<br/>职称：国家A级教练员讲师<br/>评分：<img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/><img
                                                                            src="images/xx.jpg"/>
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <p class="p_pingfen">给教练评分：<img src="images/xx4.jpg"/> <img
                                                                    src="images/xx4.jpg"/> <img src="images/xx4.jpg"/>
                                                                <img src="images/xx4.jpg"/> <img src="images/xx4.jpg"/>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="hd">
                                                    <a class="next"></a>
                                                    <a class="prev"></a>
                                                    <ul>
                                                        <li>&nbsp;</li>
                                                        <li>&nbsp;</li>
                                                        <li>&nbsp;</li>
                                                        <li>&nbsp;</li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(".leftLoop1").slide({
                                            mainCell: ".bd ul",
                                            effect: "leftLoop",
                                            vis: 3,
                                            scroll: 3,
                                            autoPlay: true
                                        });</script>
                                </div>
                                <!--D级教练员-->
                                <!--C级教练员-->
                                <div class="tab_son box_table ClearFix" style="width:100%;float:left;">
                                    <div class="map fl">
                                        <img src="images/map.jpg"/>
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
                                <div style="clear:both;"></div>
                                <!--C级教练员-->
                            </div>
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