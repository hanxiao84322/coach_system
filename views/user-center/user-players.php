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
                                    <h1><span>教练员培训经历</span></h1>

                                    <div class="form_input">
                                        <div class="divp_pt">
                                            <table cellpadding="0" cellspacing="0" class="wans_content">
                                                <tr>
                                                    <th>序</th>
                                                    <th>效力球队</th>
                                                    <th>时间</th>
                                                    <th>任职</th>
                                                    <th>操作</th>
                                                </tr>
                                                <?php if (!empty($model)) {?>
                                                    <?php foreach ($model as $key => $val) :?>
                                                        <tr>
                                                            <td><?= $key+1?></td>
                                                            <td><?= $val['team'] ?></td>
                                                            <td><?= date('Y-m-d',strtotime($val['begin_time']))?> - <?= date('Y-m-d',strtotime($val['end_time']))?></td>
                                                            <td><?= $val['level']?></td>
                                                            <td><a href="<?= \yii\helpers\Url::to(['user-center/user-players', 'user_players_id' => $val['id']])?>">编辑</a> | <a href="<?= \yii\helpers\Url::to(['user-center/user-players', 'id' => $val['id']])?>">删除</a></td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                <?php } else {?>
                                                    <tr>
                                                        <td colspan="5">请添加运动经历</td>
                                                    </tr>
                                                <?php }?>
                                            </table>
                                            <?php $form = ActiveForm::begin([
                                                'id' => 'registerInfo',
                                                'enableAjaxValidation' => false,
                                                'action' => \yii\helpers\Url::to('/user-center/user-players')
                                            ]); ?>
                                            <table cellpadding="0" cellspacing="0" class="fixed_information">
                                                <tr>
                                                    <td colspan="2" style="color:#E4393D;">（未有运动经历的学员可不填写！）</td>
                                                </tr>
                                                <tr>
                                                <td align="right"><em>*</em>时间：</td>
                                                <td><?= DatePicker::widget([
                                                        'attribute' => 'begin_time',
                                                        'name' => 'UsersPlayers[begin_time]',
                                                        'clientOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'dd-M-yyyy',
                                                        ],
                                                    ]);?> 至 <?= DatePicker::widget([
                                                        'attribute' => 'end_time',
                                                        'name' => 'UsersPlayers[end_time]',
                                                        'clientOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'dd-M-yyyy',
                                                        ],
                                                    ]);?>（不填表示至今）
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>地点：</td>
                                                    <td><input type="text" value="" class="w400" name="UsersPlayers[address]"/><span class='state1'></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>任职：</td>
                                                    <td><select class="w78" name="UsersPlayers[level]">
                                                            <option value="无">无</option>
                                                            <option value="中锋">中锋</option>
                                                            <option value="边锋">边锋</option>
                                                            <option value="前腰">前腰</option>
                                                            <option value="边前卫">边前卫</option>
                                                            <option value="中前卫">中前卫</option>
                                                            <option value="后腰">后腰</option>
                                                            <option value="边后卫">边后卫</option>
                                                            <option value="中后卫">中后卫</option>
                                                            <option value="清道夫">清道夫</option>
                                                            <option value="门将">门将</option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>效力球队：</td>
                                                    <td><input type="text" value="" class="w189" name="UsersPlayers[team]"/> <span class='state1'></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><em>*</em>证明人：</td>
                                                    <td><input type="text" value="" class="w189" name="UsersPlayers[witness]"/> <span class='state1'></span>证明人电话：<input name="UsersPlayers[witness_phone]" type="text" value="" class="w189"/></td>
                                                </tr>
                                                <tr>
                                                    <td align="right" valign="top"><em>*</em>描述：</td>
                                                    <td><textarea class="w480" name="UsersPlayers[description]"></textarea><span class='state1'></span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="submit" value="保 存" class="fixe_btn"/></td>
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