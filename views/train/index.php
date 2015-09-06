<!--banner-->
<div class="pxbm_set">
</div>
<!--banner-->
<!--注册人数-->
<div class="register_number">
    <div class="nav_sets">
        您现在的位置：<a href="<?= \yii\helpers\Url::to('home/index')?> ">首页</a><b>></b>培训报名
    </div>
</div>
<!--注册人数-->
<!--content-->
<div class="content_box">
<div class="con_set">
<div class="news_con">
<div class="notice_set">
    <span>教练员培训须知！</span>1、热爱教练事业优先<br />2、大专以上学历（体育专业优先）。 <br />3、年龄在25-45岁。 <br />4、提交报名表后会在7-14个工作日以短信形式通知录取信息以及培训信息，请您务必准确填写每项信息<br /><b>注意：如有虚假报名申请将列入教练员黑名单！！</b>
</div>

<div class="tabs martop">
<h3 class="title_h43"><a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '2']) ?>" <?php if ($levelId == 2):?> class="hover" <?php endif;?>>市级班</a><a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '3']) ?>" <?php if ($levelId == 3):?> class="hover" <?php endif;?>>D级班</a><a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '4']) ?>" <?php if ($levelId == 4):?> class="hover" <?php endif;?>>C级班</a><a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '5']) ?>" <?php if ($levelId == 5):?> class="hover" <?php endif;?>>B级班</a><a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '6']) ?>" <?php if ($levelId == 6):?> class="hover" <?php endif;?>>A级班</a><a href="<?= \yii\helpers\Url::to(['train/index', 'levelId' => '7']) ?>" <?php if ($levelId == 7):?> class="hover" <?php endif;?>>职业级班</a><span class="pxke_Set">培训课程</span></h3>
<!--北京市市级教练员培训-->
<div class="tab_son">
    <div class="h132">
        <p class="fl"><img src="/images/l<?= $levelId-1?>.jpg" /></p>
        <div class="fl con_h"><span>录取条件!</span>身体健康、热爱足球教练员事业、有一定足球训练基础的足球学校教练员、业余体校教练员、大中小学体育教师、在籍体育大专和本科学生、职业俱乐部退役队员均可报名。</div>
        <p class="fr"><img src="/images/pic3.jpg" /></p>
    </div>
    <div class="table_box">
        <table cellpadding="0" cellspacing="0" class="h31">
            <tr>
                <td width="50" class="pxset">排序</td>
                <td colspan="4">&nbsp;</td>
                <td width="100">等级 <img src="/images/sj.jpg" /></td>
                <td width="100">类别 <img src="/images/sj.jpg" /></td>
                <td width="100">状态 <img src="/images/sj.jpg" /></td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="table_set">
            <tr>
                <th width="50">序</th>
                <th width="210">教练员培训班类别</th>
                <th>类别</th>
                <th>培训时间</th>
                <th>培训地点</th>
                <th>报名人数</th>
                <th>报名状态</th>
            </tr>
            <?php foreach ($models as $key => $val) :?>
                <tr>
                <td><?= $val->id ?></td>
                <td><?= $val->name ?></td>
                <td><?= \app\models\Train::$categoryList[$val->category] ?></td>
                <td><?= $val->begin_time ?></td>
                <td><?= $val->address ?></td>
                <td>招<?= $val->recruit_count ?>人 ( <b>已录取 <?= $val->already_recruit_count ?> 人</b> )</td>
                <td><b><a href="<?= \yii\helpers\Url::to(['/train/apply', 'id' => $val->id])?>">申请报名</a></b></td>
            </tr>
            <?php endforeach; ?>

        </table>
        <!--number-->
        <div class="number_box">
            <ul>
                <li><a href="javascript:;" class="w50">上一页</a></li>
                <li><a href="javascript:;">1</a></li>
                <li><a href="javascript:;">2</a></li>
                <li><a href="javascript:;">3</a></li>
                <li><a href="javascript:;">4</a></li>
                <li><a href="javascript:;">5</a></li>
                <li><a href="javascript:;" class="w50">下一页</a></li>
                <li><span>倒数</span></li>
                <li><span><input type="text" class="w50" /></span></li>
                <li><span class="ye">页</span></li>
                <li><span><input type="submmit" value="确定" class="w50" /></span></li>
            </ul>
        </div>
        <!--number-->
    </div>
</div>
</div>
</div>
</div>
</div>
<!--content-->

