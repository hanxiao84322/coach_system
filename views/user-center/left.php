<td width="220" valign="top">
    <div class="left_nav">
        <img
            src="<?php if (!empty($data['photo'])) { ?><?= '/upload/images/users_info/photo/' . $data['photo'] ?><?php } else { ?>/images/user/4.jpg<?php } ?>"
            width="71" height="99"/>
        Hi, <b class="green"><?= Yii::$app->user->identity->username ?></b><br/>（<?= $data['levelName'] ?>）<span>消息（<a
                href="<?= \yii\helpers\Url::to('/user-center/system-comment') ?>"><b><?= $data['messageCount'] ?></b></a>）</span>
    </div>
    <div class="left_navbox">
        <ul class="nav">
            <li>
                <h1 <?php if (Yii::$app->controller->action->id == 'login-info' || Yii::$app->controller->action->id == 'change-password') { ?>class="hover"<?php } ?>>
                    <a href="javascript:;">个人设置</a></h1>

                <div class="second_div"
                     <?php if (Yii::$app->controller->action->id == 'login-info' || Yii::$app->controller->action->id == 'change-password') { ?>style="display:block;"<?php } ?>>
                    <a href="<?= \yii\helpers\Url::to('/user-center/login-info') ?>"><span>登录信息</span></a>
                    <a href="<?= \yii\helpers\Url::to(['/user-center/change-password', 'step' => 1]) ?>"><span>修改登录密码</span></a>
                </div>
            </li>
            <li>
                <h1 <?php if (Yii::$app->controller->action->id == 'user-info' || Yii::$app->controller->action->id == 'train-index') { ?>class="hover"<?php } ?>>
                    <a href="javascript:;">培训管理</a></h1>

                <div class="second_div"
                     <?php if (Yii::$app->controller->action->id == 'user-info' || Yii::$app->controller->action->id == 'train-index') { ?>style="display:block;"<?php } ?>>
                    <a href="<?= \yii\helpers\Url::to('/user-center/user-info') ?>"><span>报名信息</span></a>
                    <a href="<?= \yii\helpers\Url::to('/user-center/train-index') ?>"><span>课程安排<?php if (!empty($data['currentTrain'])) echo '（<b>1</b>）'; ?></span></a>
                </div>
            </li>
            <?php if (\app\models\UsersLevel::getStatusOrderByIdAsc(Yii::$app->user->id) >= \app\models\UsersLevel::REG) { ?>
                <li>
                    <h1 <?php if (Yii::$app->controller->action->id == 'user-level-info' || Yii::$app->controller->action->id == 'activity' || Yii::$app->controller->action->id == 'my-activity' || Yii::$app->controller->action->id == 'user-level-up') { ?>class="hover"<?php } ?>>
                        <a href="javascript:;">教练员管理</a></h1>

                    <div class="second_div"
                         <?php if (Yii::$app->controller->action->id == 'user-level-info' || Yii::$app->controller->action->id == 'activity' || Yii::$app->controller->action->id == 'my-activity' || Yii::$app->controller->action->id == 'user-level-up') { ?>style="display:block;"<?php } ?>>
                        <a href="<?= \yii\helpers\Url::to('/user-center/user-level-info') ?>"><span>注册信息</span></a>
                        <?php if (\app\models\UsersLevel::getStatusOrderByIdAsc(Yii::$app->user->id) > \app\models\UsersLevel::PAY) { ?>
                            <a href="<?= \yii\helpers\Url::to('/user-center/activity') ?>"><span>活动管理（考核&活动）</span></a>
                            <?php if (\app\models\ActivityUsers::findAll(['user_id' => Yii::$app->user->id])) { ?>
                                <a href="<?= \yii\helpers\Url::to('/user-center/my-activity') ?>"><span>我的活动</span></a>
                            <?php } ?>
                            <a href="<?= \yii\helpers\Url::to('/user-center/user-level-up') ?>"><span>晋升管理</span></a>
                        <?php } ?>

                    </div>
                </li>
            <?php } ?>
            <li>
                <h1 <?php if (Yii::$app->controller->action->id == 'messages-comment' || Yii::$app->controller->action->id == 'system-comment') { ?>class="hover"<?php } ?>>
                    <a href="javascript:;">消息管理</a></h1>

                <div class="second_div"
                     <?php if (Yii::$app->controller->action->id == 'messages-comment' || Yii::$app->controller->action->id == 'system-comment') { ?>style="display:block;"<?php } ?>>
                    <a href="<?= \yii\helpers\Url::to('/user-center/messages-comment') ?>"><span>最新公告（<b><?= \app\models\MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id, 1) ?></b>）</span></a>
                    <a href="<?= \yii\helpers\Url::to('/user-center/system-comment') ?>"><span>系统通知（<b><?= \app\models\MessagesUsers::getCountByUserIdAndType(\Yii::$app->user->id, 2) ?></b>）</span></a>
                </div>
            </li>
            <li>
                <h1 <?php if (Yii::$app->controller->action->id == 'orders') { ?>class="hover"<?php } ?>><a
                        href="javascript:;">缴费管理</a></h1>

                <div class="second_div"
                     <?php if (Yii::$app->controller->action->id == 'orders') { ?>style="display:block;"<?php } ?>>
                    <a href="<?= \yii\helpers\Url::to('/user-center/orders') ?>"><span>缴费记录</span></a>
                </div>
            </li>
        </ul>
    </div>
</td>