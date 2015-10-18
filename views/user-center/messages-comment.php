<script type="text/javascript">
    $(document).ready(function () {

        $("#checkedAll").click(function () {

//            alert("aa");

            if ($(this).attr("checked")) { // 全选
                $(':checkbox').attr('checked','checked');
            }
            else { // 取消全选
                $(':checkbox').attr('checked','');
            }
        });
    });

</script>
<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
<?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <div class="conbox_set">
                            <h3 class="news_title"><span>最新公告</span></h3>
                            <div class="all_check">
                                <input type="checkbox" style="float:left;margin-top:8px;margin-right:5px;" id="checkedAll"  /> 全选 <input type="button" value="删除" class="delet" />
                            </div>
                            <table cellpadding="0" cellspacing="0" class="news_notice">
                                <tr>
                                    <th>序号</th>
                                    <th>发件人</th>
                                    <th align="left">标题</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                <?php if(!empty($data['model']['models'])) {?>
                                    <?php foreach ($data['model']['models'] as $key => $val) :?>
                                <tr>
                                    <td><input type="checkbox" />&nbsp;&nbsp;<?= $key+1?></td>
                                        <td><?= $val['create_user']?></td>
                                    <td style="text-align:left;"><a href="<?= \yii\helpers\Url::to(['/user-center/messages-view', 'id' => $val['id']])?>" class="blue"><?= $val['title']?></a></td>
                                    <td><?= $val['create_time']?></td>
                                    <td><?php if ($val['status'] == 1) {?>已读<?php } else { ?>未读<?php } ?></td>
                                    <td><a href="javascript:;">删除</a></td>
                                </tr>
                                    <?php endforeach?>
                                <?php }?>
                            </table>
                            <!--number-->
                            <div class="number_box">
                                <?php
                                echo \yii\widgets\LinkPager::widget(['pagination' => $data['model']['pages']])
                                ?>
                            </div>
                            <!--number-->
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
