<div class="content_user">
<div class="max_width">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<?= $this->render('left',['data' => $data]);?>
    <td valign="top">
        <div class="content_box">
            <h3 class="h3_h40s">课程安排</h3>
            <div class="conbox_set">
                <div class="tabs martop">
                <h3 class="title_h44">
                    <a href="<?= \yii\helpers\Url::to(['user-center/train-index', 'levelId' => '2']) ?>" <?php if ($data['levelId'] == 2):?> class="hover" <?php endif;?>>市级</a><a href="<?= \yii\helpers\Url::to(['user-center/train-index', 'levelId' => '3']) ?>" <?php if ($data['levelId'] == 3):?> class="hover" <?php endif;?>>D级</a><a href="<?= \yii\helpers\Url::to(['user-center/train-index', 'levelId' => '4']) ?>" <?php if ($data['levelId'] == 4):?> class="hover" <?php endif;?>>C级</a><a href="<?= \yii\helpers\Url::to(['user-center/train-index', 'levelId' => '5']) ?>" <?php if ($data['levelId'] == 5):?> class="hover" <?php endif;?>>B级</a><a href="<?= \yii\helpers\Url::to(['user-center/train-index', 'levelId' => '6']) ?>" <?php if ($data['levelId'] == 6):?> class="hover" <?php endif;?>>A级</a><a href="<?= \yii\helpers\Url::to(['user-center/train-index', 'levelId' => '7']) ?>" <?php if ($data['levelId'] == 7):?> class="hover" <?php endif;?>>职业级</a><span class="pxbxi_Set1">培训课程</span></h3>
                    <!--市级教练员-->
                    <?php if (!empty($data['trainList'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">培训课排期</th>
                                        <th>类别</th>
                                        <th>开课时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainList'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['id']])?>"> <?= $val['name']?> 第<?= $val['period_num'] ?>期</a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= date('Y年m月d日', strtotime($val['begin_time'])) ?></td>
                                            <td><?= \app\models\TrainLand::getNameById($val['train_land_id']) ?></td>
                                            <td>
                                                <b class="<?php if ($val['status'] == \app\models\TrainUsers::NO_APPROVED || $val['status'] == \app\models\TrainUsers::SIGN) { ?>red<?php } elseif ($val['status'] == \app\models\TrainUsers::END) { ?>gray<?php } else { ?>green<?php } ?>"><?= \app\models\TrainUsers::$statusList[$val['status']] ?></b>
                                            </td>
                                            <td>
                                                <?php if (in_array($val['status'], [\app\models\TrainUsers::NO_APPROVED,  \app\models\TrainUsers::APPROVED])) { ?>
                                                    <a href="<?= \yii\helpers\Url::to('/user-center/user-info') ?>">修改信息</a>
                                                    <?php if ($val['status'] == \app\models\TrainUsers::NO_APPROVED) { ?>
                                                        <a href="<?= \yii\helpers\Url::to(['/user-center/resign', 'train_user_id' => $val['id']]) ?>">重新报名</a>
                                                    <?php } ?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['id'], 'status' => \app\models\TrainUsers::CANCEL]) ?>">取消</a>
                                                <?php } elseif ($val['status'] == \app\models\TrainUsers::NO_PASS) { ?>
                                                    <a href="<?= \yii\helpers\Url::to('/train/index') ?>">继续培训</a>
                                                <?php } elseif ($val['status'] == \app\models\TrainUsers::PASS) { ?>
                                                    <?php if (!empty($val['userLevel'])) {?>
                                                        <a href="<?= \yii\helpers\Url::to(['/user/register-coach', 'register' => 1]) ?>">教练员注册</a>
                                                    <?php } else {?>
                                                        已注册
                                                    <?php } ?>
                                                <?php } elseif ($val['status'] == \app\models\TrainUsers::SIGN) { ?>
                                                    <?php if (empty($val['userInfo'])) {?>
                                                        <a href="<?= \yii\helpers\Url::to(['/user/register-info', 'train_id' => $val['train_id']]) ?>">完善信息</a>
                                                    <?php } else {?>
                                                        <?php if (empty($val['userEducation'])) {?>
                                                            <a href="<?= \yii\helpers\Url::to(['/user/register-education', 'train_id' => $val['train_id']]) ?>">完善信息</a>
                                                        <?php } else {?>
                                                            <a href="<?= \yii\helpers\Url::to(['/user/register-train', 'train_id' => $val['train_id']]) ?>">完善信息</a>

                                                        <?php } ?>

                                                    <?php } ?>

                                                <?php } else {?>
                                                    无
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <p class="sorry_p"><span>对不起，没有相关培训信息</span></p>
                        </div>
                    <?php }?>
                    <!--市级教练员-->
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