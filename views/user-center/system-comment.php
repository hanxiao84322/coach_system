<?php
use yii\widgets\ActiveForm;
?>
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
                        <?php $form = ActiveForm::begin([
                            'id'=>'search',
                            'enableAjaxValidation' => false,
                            'method' => 'post'
                        ]); ?>
                        <div class="conbox_set">
                            <h3 class="news_title"><span>系统通知</span></h3>
                            <div class="all_check">
                                <input type="checkbox" style="float:left;margin-top:8px;margin-right:5px;" id="checkedAll"  /> 全选 <input type="submit" value="删除" class="delet" />
                            </div>

                            <table cellpadding="0" cellspacing="0" class="news_notice2">
                                <tr>
                                    <th>序号</th>
                                    <th align="left">内容</th>
                                </tr>
                                <?php if(!empty($data['model']['models'])) {?>
                                <?php foreach ($data['model']['models'] as $key => $val) :?>
                                <tr>
                                    <td valign="top" style="padding-top:30px;"><input type="checkbox" name="id_list[]" value="<?= $val['id']?>" />&nbsp;&nbsp;<?= $key+1?></td>
                                    <td><span><img src="/images/user/mail.jpg" class="mail" /></span><span><img src="/images/user/logo1.jpg" /></span><span class="w700"><b></b><?= $val['content']?><b class="time"><?= $val['create_time']?></b></span></td>
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
                    <?php ActiveForm::end(); ?>

                    <!--footer-->
                    <p class="copyright_Set">Copyright © 2015   版权所有</p>
                    <!--footer-->
                </td>
            </tr>
        </table>
    </div>
</div>