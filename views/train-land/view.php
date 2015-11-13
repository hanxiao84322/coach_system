<!--banner-->
<div class="pxfc_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('/home/index')?>">首页</a><b>></b><a href="<?= \yii\helpers\Url::to(['/news/train', 'id' => 2])?>">培训风采</a><b>></b><a href="<?= \yii\helpers\Url::to('/train-land/index')?>">培训地点</a><b>></b>绿荫阳光足球公园
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
    <div class="con_set">
        <div class="news_con1">
            <div class="city_title">
                <?= $trainLandInfo['name']?>
            </div>
            <div class="">
                <table cellpadding="0" cellspacing="0" class="table_set">
                    <tr>
                        <th>详细地址</th>
                        <th>联系人</th>
                        <th>联系方式</th>
                        <th>场地类型</th>
                    </tr>
                    <tr>
                        <td><?= $trainLandInfo['address']?></td>
                        <td><?= $trainLandInfo['contacts']?></td>
                        <td><?= $trainLandInfo['contact_phone']?></td>
                        <td><?= \app\models\TrainLand::$typeList[$trainLandInfo['site_type']]?></td>
                    </tr>
                </table>
            </div>
            <h3 class="jjfc_set2"><span class="fl">地理位置</span></h3>
            <div class="box_table2 ClearFix">
                <div class="map fl">
                    <div id="allmap" style="width: 552px; height: 300px;"></div>
                </div>
                <p class="adress">
                    <span>公交路线</span>
                    <?= $trainLandInfo['bus']?>
                    <span>周边站点</span>
                    <?= $trainLandInfo['site']?>
                    <span>提示</span>
                    <?= $trainLandInfo['content']?>
                </p>
            </div>
            <h3 class="jjfc_set1" style="border-bottom:solid 2px #438E0F;margin-bottom:20px;position:inherit;">培训地实景</h3>
            <div class="hud_box">
                <div class="adva0">
                    <div class="leftLoop1">
                        <div class="bd">
                            <ul class="picList">
                                <li>
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li style="margin-right:0;">
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                                <li style="margin-right:0;">
                                    <div class="pic">
                                        <p><a href="javascript:;"><img src="/images/pic1.jpg"/></a></p>
                                        <p class="three_title"><a href="javascript:;">李立三 高级分析师</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="hd">
                            <a class="next"></a>
                            <a class="prev"></a>
                            <ul><li>1</li><li>2</li><li>3</li><li>4</li></ul>

                        </div>
                    </div>
                    <script type="text/javascript">
                        for(var i=0;i<=1000;i++)
                        {
                            $('.picList li').slice(8*i,8*i+8).wrapAll('<div class="yyy"></div>');
                        }
                        jQuery(".leftLoop1").slide({ mainCell:".bd ul",effect:"leftLoop",vis:1,scroll:1,autoPlay:true});
                    </script>
                </div>
            </div>
        </div>
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
    myGeo.getPoint("<?= $trainLandInfo['address']?>", function(point){
        if (point) {
            map.centerAndZoom(point, 16);
            map.addOverlay(new BMap.Marker(point));
        }else{
            alert("您选择地址没有解析到结果!");
        }
    }, "北京市");
</script>