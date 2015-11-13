<script type="text/javascript">
    $(function(){
        //tab
        $(".tabs .title_h42 a:first-child").addClass("hover");
        $(".tabs").each(function(){
            $(".tab_son",this).eq(0).addClass("nodis");
        });
        $(".tabs .title_h42 a").click(function(){
            var nnum = $(this).index();
            $(this).siblings().removeClass("hover");
            $(this).addClass("hover");
            var nnum = $(this).index();
            $(this).parent().siblings(".tab_son").removeClass("nodis");
            $(this).parent().siblings(".tab_son").eq(nnum).addClass("nodis");

        });
    })
</script>
<!--banner-->
<div class="pxbm_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>" style="color:#008000;">首页</a><b>></b><a href="<?= \yii\helpers\Url::to('/train/index')?>">培训报名</a><b>></b><?= $data['trainModel']['name']?> 第<?= $data['trainModel']['period_num']?>期
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con1">
            <div class="city_title">
                <?= $data['trainModel']['name']?> 第<?= $data['trainModel']['period_num']?>期
            </div>
            <div class="">
                <table cellpadding="0" cellspacing="0" class="table_set">
                    <tr>
                        <th>报名情况</th>
                        <th>报名截止</th>
                        <th>类别</th>
                        <th>培训时间</th>
                        <th>培训地点</th>
                        <th>报名状态</th>
                    </tr>
                    <tr>
                        <td>招<b class="blue"><?= $data['trainModel']['recruit_count']?></b>人 | 录取<b class="blue"><?= \app\models\TrainUsers::getRecruitCount($data['trainModel']['id'])?></b>人 | 结业<b class="blue"><?= \app\models\TrainUsers::getPassCount($data['trainModel']['id'])?></b>人</td>
                        <td><?= date('Y-d-m', strtotime($data['trainModel']['sign_up_begin_time']))?></td>
                        <td><?= \app\models\Train::getCategoryName($data['trainModel']['category'])?></td>
                        <td><?= date('Y-d-m', strtotime($data['trainModel']['begin_time']))?></td>
                        <td><b class="blue"><?= $data['trainModel']['address']?></b></td>
                        <td><b class="blue"><?= \app\models\Train::$statusList[$data['trainModel']['status']]?></b></td>
                    </tr>
                </table>
            </div>
            <div class="tabs martop">
            	<h3 style="border-bottom:solid 2px #438E0F;margin-bottom:20px;position:inherit;" class="jjfc_set6">讲师团队</h3>
               <!-- <h3 class="title_h42"><a href="javascript:;">讲师团队</a><a href="javascript:;">培训学员</a><a href="javascript:;">培训地点</a><span class="pxbxi_Set">培训班信息</span></h3>-->
                <!--讲师团队-->
                <div class="tab_son box_table">
                    <div class="adva">
                        <div class="adva0">
                            <div class="leftLoop1">
                                <div class="bd">
                                    <ul class="picList">
                                        <?php foreach ($data['trainTeachersModel'] as $key => $val) :?>
                                            <li>
                                                <div class="pic">
                                                    <a href="<?= \yii\helpers\Url::to(['teachers/view', 'id' => $val['teachers_id']])?>">
                                                        <span><img src="/upload/images/teachers/photo/<?= $val['photo']?>" width="71" height="99"/></span>
                                                        <p>
                                                            姓名：<?= $val['name']?><br />年龄：<?= $val['age']?><br />职称：<?= app\models\Teachers::getLevelName($val['level'])?><br />评分：<img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" /><img src="/images/user/xx.jpg" />
                                                        </p>
                                                    </a>
                                                </div>
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
                            <script type="text/javascript">jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:3,scroll:3,autoPlay:true});</script>
                        </div>
                    </div>
                </div>
                <!--讲师团队-->
                <!--培训学员-->
                <h3 class="title_h42" style="margin-top:15px;"><span class="pxbxi_Set">培训学员</span></h3>
                <div class="box_table1 ClearFix" style="float:left;width:100%;">
                    <ul class="list_uls ClearFix">
                        <?php foreach ($data['trainUsers'] as $key => $val) :?>
                            <?php if (empty($val['userId'])) {?>
                                <li><a href="javascript:;" class="red"><span><?= $key?></span><?= $val['status']?></a></li>
                            <?php } else {?>
                                <li><a href="<?= \yii\helpers\Url::to(['/user/view', 'id'=>$val['userId']])?>" class="<?= $val['class']?>"><span><?= $key?></span><?= $val['status']?></a></li>
                            <?php }?>
                        <?php endforeach;?>
                    </ul>
                </div>
                <!--培训学员-->
                <div style="clear:both;"></div>
                <!--培训地点-->
                <h3 class="jjfc_set2"><span class="fl">培训地点</span></h3>
                <div class="box_table2 ClearFix">
                    <div class="map fl">
                        <div id="allmap" style="width: 552px; height: 300px;"></div>
                    </div>
                    <p class="adress">
                        <span>公交路线</span>
                        <?= $data['trainModel']['bus']?>
                        <span>周边站点</span>
                        <?= $data['trainModel']['near_site']?>
                        <span>提示</span>
                        <?= $data['trainModel']['address']?>
                    </p>
                </div>

                <!--培训地点-->
            </div>
        </div>
    </div>
</div>
<!--content-->
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(116.331398,39.897445);
    map.centerAndZoom(point,12);
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint("<?= $data['trainModel']['address']?>", function(point){
        if (point) {
            map.centerAndZoom(point, 16);
            map.addOverlay(new BMap.Marker(point));
        }else{
            alert("您选择地址没有解析到结果!");
        }
    }, "北京市");
</script>