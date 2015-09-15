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
                    <h3 class="title_h43"><a href="javascript:;">市级班</a><a href="javascript:;">D级班</a><a href="javascript:;">C级班</a><a href="javascript:;">B级班</a><a href="javascript:;">A级班</a><a href="javascript:;">职业级班</a><span class="pxbxi_Set1">培训课程</span></h3>
                    <!--市级教练员-->
                    <?php if (!empty($data['trainListA'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班类别</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainListA'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['train_user_id']])?>"><?= $val['name']?></a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= $val['begin_time']?></td>
                                            <td><?= $val['address']?></td>
                                            <td><b class="<?php if ($val['user_status'] == '6') {?>red<?php }elseif ($val['user_status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['user_status']]?></b></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                <?php }?>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to('/user/register-coach')?>">教练员注册</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::NO_PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <div class="h132">
                                <p class="fl"><img src="/images/l1.jpg" /></p>
                                <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById(2)?></div>
                                <p class="fr"><img src="/images/pic12_2.jpg" /></p>
                            </div>
                            <p class="sorry_p"><span>对不起，没有相关培训信息</span></p>
                        </div>
                    <?php }?>
                    <!--市级教练员-->
                    <!--D级教练员-->
                    <?php if (!empty($data['trainListB'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班类别</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainListB'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['train_user_id']])?>"><?= $val['name']?></a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= $val['begin_time']?></td>
                                            <td><?= $val['address']?></td>
                                            <td><b class="<?php if ($val['user_status'] == '6') {?>red<?php }elseif ($val['user_status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['user_status']]?></b></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                <?php }?>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to('/user/register-coach')?>">教练员注册</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::NO_PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <div class="h132">
                                <p class="fl"><img src="/images/l2.jpg" /></p>
                                <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById(3)?></div>
                                <p class="fr"><img src="/images/pic12_2.jpg" /></p>
                            </div>
                            <p class="sorry_p"><span>对不起，没有相关培训信息（您是<?= $data['levelName']?>，不具备该级别的教练员培训权限）</span></p>
                        </div>
                    <?php }?>
                    <!--D级教练员-->
                    <!--C级教练员-->
                    <?php if (!empty($data['trainListC'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班类别</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainListC'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['train_user_id']])?>"><?= $val['name']?></a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= $val['begin_time']?></td>
                                            <td><?= $val['address']?></td>
                                            <td><b class="<?php if ($val['user_status'] == '6') {?>red<?php }elseif ($val['user_status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['user_status']]?></b></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                <?php }?>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to('/user/register-coach')?>">教练员注册</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::NO_PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <div class="h132">
                                <p class="fl"><img src="/images/l3.jpg" /></p>
                                <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById(4)?></div>
                                <p class="fr"><img src="/images/pic12_2.jpg" /></p>
                            </div>
                            <p class="sorry_p"><span>对不起，没有相关培训信息（您是<?= $data['levelName']?>，不具备该级别的教练员培训权限）</span></p>
                        </div>
                    <?php }?>
                    <!--C级教练员-->
                    <!--B级教练-->
                    <?php if (!empty($data['trainListD'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班类别</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainListD'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['train_user_id']])?>"><?= $val['name']?></a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= $val['begin_time']?></td>
                                            <td><?= $val['address']?></td>
                                            <td><b class="<?php if ($val['user_status'] == '6') {?>red<?php }elseif ($val['user_status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['user_status']]?></b></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                <?php }?>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to('/user/register-coach')?>">教练员注册</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::NO_PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <div class="h132">
                                <p class="fl"><img src="/images/l4.jpg" /></p>
                                <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById(5)?></div>
                                <p class="fr"><img src="/images/pic12_2.jpg" /></p>
                            </div>
                            <p class="sorry_p"><span>对不起，没有相关培训信息（您是<?= $data['levelName']?>，不具备该级别的教练员培训权限）</span></p>
                        </div>
                    <?php }?>
                    <!--B级教练-->
                    <!--A级教练员-->
                    <?php if (!empty($data['trainListE'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班类别</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainListE'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['train_user_id']])?>"><?= $val['name']?></a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= $val['begin_time']?></td>
                                            <td><?= $val['address']?></td>
                                            <td><b class="<?php if ($val['user_status'] == '6') {?>red<?php }elseif ($val['user_status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['user_status']]?></b></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                <?php }?>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to('/user/register-coach')?>">教练员注册</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::NO_PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <div class="h132">
                                <p class="fl"><img src="/images/l5.jpg" /></p>
                                <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById(6)?></div>
                                <p class="fr"><img src="/images/pic12_2.jpg" /></p>
                            </div>
                            <p class="sorry_p"><span>对不起，没有相关培训信息（您是<?= $data['levelName']?>，不具备该级别的教练员培训权限）</span></p>
                        </div>
                    <?php }?>
                    <!--A级教练员--
                    <!--职业级教练员-->
                    <?php if (!empty($data['trainListF'])) { ?>
                        <!--市级教练员-->
                        <div class="tab_son box_table1">
                            <div class="table_box">
                                <table cellpadding="0" cellspacing="0" class="table_set">
                                    <tr>
                                        <th width="50">序</th>
                                        <th width="210">教练员培训班类别</th>
                                        <th>类别</th>
                                        <th>培训时间</th>
                                        <th>培训地点</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php foreach ($data['trainListF'] as $key => $val) :?>
                                        <tr>
                                            <td><?= $key+1?></td>
                                            <td><a href="<?= \yii\helpers\Url::to(['/user-center/train-view', 'trainUsersId' => $val['train_user_id']])?>"><?= $val['name']?></a></td>
                                            <td><?= \app\models\Train::getCategoryName($val['category'])?></td>
                                            <td><?= $val['begin_time']?></td>
                                            <td><?= $val['address']?></td>
                                            <td><b class="<?php if ($val['user_status'] == '6') {?>red<?php }elseif ($val['user_status'] == '5'){?>gray<?php } else {?>green<?php }?>"><?= \app\models\TrainUsers::$statusList[$val['user_status']]?></b></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to('/user-center/updateUserInfo')?>">修改信息</a>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::SIGN,\app\models\TrainUsers::APPROVED])) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/update-train-user-status', 'trainId' => $val['train_user_id'], 'status' => \app\models\TrainUsers::CANCEL])?>">取消</a>
                                                <?php }?>
                                                <?php if (in_array($val['user_status'], [\app\models\TrainUsers::NO_APPROVED,\app\models\TrainUsers::CANCEL])) {?>

                                                    <a href="<?= \yii\helpers\Url::to(['/user-center/delete-train-users', 'id' => $val['train_user_id']])?>">删除</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to('/user/register-coach')?>">教练员注册</a>
                                                <?php }?>
                                                <?php if ($val['user_status'] == \app\models\TrainUsers::NO_PASS) {?>
                                                    <a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val['train_id'], 'user_id' => $val['user_id']])?>">继续培训</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <!--市级教练员-->
                    <?php } else { ?>
                        <div class="tab_son box_table1 ClearFix">
                            <div class="h132">
                                <p class="fl"><img src="/images/l6.jpg" /></p>
                                <div class="fl con_h"><span>录取条件!</span><?= \app\models\Level::getContentById(7)?></div>
                                <p class="fr"><img src="/images/pic12_2.jpg" /></p>
                            </div>
                            <p class="sorry_p"><span>对不起，没有相关培训信息（您是<?= $data['levelName']?>，不具备该级别的教练员培训权限）</span></p>
                        </div>
                    <?php }?>
                    <!--职业级教练员-->
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