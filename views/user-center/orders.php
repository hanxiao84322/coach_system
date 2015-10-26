<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <div class="conbox_set">
                            <h3 class="news_title"><span>缴费记录</span></h3>
                            <div class="all_check">
                                <input type="checkbox" style="float:left;margin-top:8px;margin-right:5px;" /> 全选 <input type="button" value="删除" class="delet" />
                            </div>
                            <table cellpadding="0" cellspacing="0" class="news_notice">
                                <tr>
                                    <th>序号</th>
                                    <th>用途</th>
                                    <th>缴费金额</th>
                                    <th>缴费时间</th>
                                    <th>方式</th>
                                    <th>状态</th>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>市级教练员注册</td>
                                    <td><span>￥500.00元</span></td>
                                    <td>2015-08-06 15:38:26</td>
                                    <td>在线缴费</td>
                                    <td>缴费成功</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>市级教练员注册</td>
                                    <td><span>￥500.00元</span></td>
                                    <td>2015-08-06 15:38:26</td>
                                    <td>线下缴费</td>
                                    <td>未缴费</td>
                                </tr>
                            </table>
                        </div>
                    </div>                    <!--footer-->
                    <p class="copyright_Set">Copyright © 2015   版权所有</p>
                    <!--footer-->
                </td>
            </tr>
        </table>
    </div>
</div>