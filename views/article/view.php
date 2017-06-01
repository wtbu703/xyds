<?php
$this->title =  '文章预览';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px">标题</th>
                        <td id="title"><?=$article['title']?></td>
                    </tr>
                    <tr>
                        <th width="100">作者</th>
                        <td id="author"><?=$article['author']?></td>
                    </tr>
                    <tr>
                        <th width="100">时间</th>
                        <td id="author"><?=$article['datetime']?></td>
                    </tr>
                    <tr>
                        <th width="100">内容</th>
                        <td id="content" width="500px"><?=$article['content']?></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('article_detail').close();" />
                </div>
            </div>
    </form>
</div>
