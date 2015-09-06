<td width="220" valign="top">
    <div class="left_nav">
        <img src="/images/user/pic1.jpg" />
        Hi, <b class="green"><?= Yii::$app->user->identity->username?></b><br/>（<?= $result['levelName']?>）<span>消息（<b>1</b>）</span>
    </div>
    <div class="left_navbox">
        <ul class="nav">
            <li>
                <h1 class="hover"><a href="javascript:;">个人设置</a></h1>
                <div class="second_div" style="display:block;">
                    <a href="javascript:;"><span>登录信息</span></a>
                    <a href="javascript:;"><span>修改登录密码</span></a>
                </div>
            </li>
            <li>
                <h1><a href="javascript:;">培训管理</a></h1>
                <div class="second_div">
                    <a href="javascript:;"><span>报名信息</span></a>
                    <a href="javascript:;"><span>课程安排（<b>1</b>）</span></a>
                </div>
            </li>
            <li>
                <h1><a href="javascript:;">教练员管理</a></h1>
                <div class="second_div">
                    <a href="javascript:;"><span>注册信息</span></a>
                    <a href="javascript:;"><span>活动管理（考核&活动）</span></a>
                    <a href="javascript:;"><span>我的活动</span></a>
                    <a href="javascript:;"><span>晋升管理</span></a>
                </div>
            </li>
            <li>
                <h1><a href="javascript:;">消息管理</a></h1>
                <div class="second_div">
                    <a href="javascript:;"><span>最新公告（<b>2</b>）</span></a>
                    <a href="javascript:;"><span>系统通知（<b>1</b>）</span></a>
                </div>
            </li>
            <li>
                <h1><a href="javascript:;">缴费管理</a></h1>
                <div class="second_div">
                    <a href="javascript:;"><span>缴费记录</span></a>
                </div>
            </li>
        </ul>
    </div>
</td>