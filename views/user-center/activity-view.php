<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
<?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">望京小学执教</h3>
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
                                    <td>招<b class="blue"><?= $data['activityModel']['recruit_count']?></b>人 | 录取<b class="blue"><?= $data['enrollCount']?></b>人 | 结业<b class="blue"><?= $data['passCount']?></b>人</td>
                                    <td><?= $data['activityModel']['sign_up_end_time']?></td>
                                    <td><?= \app\models\Activity::$categoryList[$data['activityModel']['category']]?></td>
                                    <td><?= $data['activityModel']['begin_time']?></td>
                                    <td><b class="red">
                                            <?php
                                            if ($data['activityModel']['status'] < \app\models\Activity::DOING) {
                                                echo \app\models\Activity::$statusList[$data['activityModel']['status']];
                                            } else {
                                                echo "报名结束";
                                            }
                                            ?></b>
                                    </td>
                                    <td><b class="blue"><?= \app\models\Activity::$statusList[$data['activityModel']['status']]?></b></td>
                                </tr>
                            </table>
                            <div class="martop">
                                <h3 class="title_h42"><span class="pxke_Set1">讲师团队</span></h3>
                                <?php if (!empty($data['activityUsersModel'])) {?>

                                <!--讲师团队-->
                                <div class="box_table">
                                    <div class="adva">
                                        <div class="adva0">
                                            <div class="leftLoop1">
                                                <div class="bd">
                                                    <ul class="picList">
                                                            <?php foreach ($data['activityUsersModel'] as $key => $val) :?>
                                                                <li>
                                                            <div class="pic">
                                                                <a href="<?= \yii\helpers\Url::to(['users/view', 'id' => $val['activity_id']])?>">
                                                                    <span><img src="/upload/images/users/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                                                    <p>
                                                                        姓名：<?= $val['username']?><br />年龄：<?= $val['age']?><br />职称：<?= app\models\Level::getOneLevelNameById($val['level_id'])?><br />评分：<img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" /><img src="images/xx.jpg" />
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <p class="p_pingfen">给教练评分：<img src="images/xx4.jpg" /> <img src="images/xx4.jpg" /> <img src="images/xx4.jpg" /> <img src="images/xx4.jpg" /> <img src="images/xx4.jpg" /></p>
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
                                    <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
                                </div>
                                <!--讲师团队-->
                                <?php }?>

                                <!--培训地点-->
                                <div class="tab_son box_table2 ClearFix">
                                    <div class="map fl">
                                        <div id="allmap" style="width: 552px; height: 300px;"></div>
                                    </div>
                                    <p class="adress">
                                        <span>公交路线</span>
                                        <?= $data['activityModel']['bus']?>
                                        <span>周边站点</span>
                                        <?= $data['activityModel']['near_site']?>
                                        <span>提示</span>
                                        <?= $data['activityModel']['address']?>
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
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(116.331398,39.897445);
    map.centerAndZoom(point,12);
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint("<?= $data['activityModel']['address']?>", function(point){
        if (point) {
            map.centerAndZoom(point, 16);
            map.addOverlay(new BMap.Marker(point));
        }else{
            alert("您选择地址没有解析到结果!");
        }
    }, "北京市");
</script>