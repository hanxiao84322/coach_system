<div class="content_user">
    <div class="max_width">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <?= $this->render('left',['data' => $data]);?>
                <td valign="top">
                    <div class="content_box">
                        <div class="conbox_set">
                            <h3 class="news_title"><span>最新公告</span></h3>
                            <table cellpadding="0" cellspacing="0" class="news_notice1">
                                <tr>
                                    <td align="right" width="80">发件人：</td>
                                    <td align="left"><?= $data['messagesInfo']['create_user']?></td>
                                </tr>
                                <tr>
                                    <td align="right">标题：</td>
                                    <td align="left"><?= $data['messagesInfo']['title']?></td>
                                </tr>
                                <tr>
                                    <td align="right">时间：</td>
                                    <td align="left"><?= $data['messagesInfo']['create_time']?></td>
                                </tr>
                                <tr>
                                    <td align="right">内容：</td>
                                    <td align="left"><?= $data['messagesInfo']['content']?></td>
                                </tr>
                            </table>
                            <div class="all_check">
                                <input type="button" value="返回" class="delet" onclick="javascript:history.back(-1);" /> <input type="button" value="删除" class="delet" onclick="javascript:location.href='/user-center/comment-delete?id=<?= $data['messagesInfo']['id']?>&type=<?= $data['messagesInfo']['type']?>';" />
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
