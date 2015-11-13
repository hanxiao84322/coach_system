<script language="javascript" type="text/javascript" src="/js/My97DatePicker/WdatePicker.js"></script>
<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <h3 class="h3_h40s">个人信息</h3>
                        <div class="boxset_content">
                            <ul class="nrset_set">
                                <li>
                                    <h1><span>教育经历</span></h1>

                                    <div class="form_input">
                                        <div class="divp_pt">
                                            <table cellpadding="0" cellspacing="0" class="wans_content">
                                                <tr>
                                                    <th>序</th>
                                                    <th>学校名称</th>
                                                    <th>时间</th>
                                                    <th>学历/学位</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php if (!empty($model)) {?>
                                                    <?php foreach ($model as $key => $val) :?>
                                                        <tr>
                                                            <td><?= $key+1?></td>
                                                            <td><?= $val['school'] ?></td>
                                                            <td><?= date('Y-m-d',strtotime($val['begin_time']))?> - <?= date('Y-m-d',strtotime($val['end_time']))?></td>
                                                            <td><?= $val['educational_background']?></td>
                                                            <td><a href="<?= \yii\helpers\Url::to(['user-center/user-education', 'user_education_id' => $val['id']])?>">编辑</a> | <a href="<?= \yii\helpers\Url::to(['user-center/user-education', 'id' => $val['id']])?>">删除</a></td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                <?php } else {?>
                                                    <tr>
                                                        <td colspan="5">请添加教育经历</td>
                                                    </tr>
                                                <?php }?>
                                            </table>
                                            <?php $form = ActiveForm::begin([
                                                'id' => 'registerInfo',
                                                'enableAjaxValidation' => false,
                                                'action' => \yii\helpers\Url::to('/user-center/user-education')
                                            ]); ?>
                                            <table cellpadding="0" cellspacing="0" class="fixed_information">
                                                <tr>
                                                    <td align="right"><em>*</em>时间：</td>
                                                    <td><input type="text" id="d221" name="UsersEducation[begin_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', strtotime('-1 year'))?>'})" /> 至 <input type="text" id="d221" name="UsersEducation[end_time]" onFocus="WdatePicker({startDate:'<?= date('Y-m-d', time())?>'})"/>（不填表示至今）</td>

                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>地点：</td>
                                                    <td><input type="text" value="" class="w400" name="UsersEducation[address]"/><span class='state1'></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>学校名称：</td>
                                                    <td><input type="text" value="" class="w400" name="UsersEducation[school]"/><span class='state1'></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>学历/学位：</td>
                                                    <td><select class="w78" name="UsersEducation[educational_background]">
                                                            <option value="博士">博士</option>
                                                            <option value="硕士">硕士</option>
                                                            <option value="本科">本科</option>
                                                            <option value="专科">专科</option>
                                                            <option value="高中">高中</option>
                                                            <option value="初中">初中</option>
                                                            <option value="小学">小学</option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>证明人：</td>
                                                    <td><input type="text" value="" class="w189" name="UsersEducation[witness]"/> <span class='state1'></span>证明人电话：<input name="UsersEducation[witness_phone]" type="text" value="" class="w189"/></td>
                                                </tr>
                                                <tr>
                                                    <td align="right" valign="top"><em>*</em>描述：</td>
                                                    <td><textarea class="w480" name="UsersEducation[description]"></textarea><span class='state1'></span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="submit" value="保 存" class="fixe_btn"/><a href="<?= \yii\helpers\Url::to('/user-center/user-train')?>">添加培训信息</a></td>
                                                </tr>
                                            </table>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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