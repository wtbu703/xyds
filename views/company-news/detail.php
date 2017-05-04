<?php
$this->title = '新闻详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">新闻标题</th>
                        <td id="title"><?=$companyNews->title?></td>
                    </tr>
                    <tr>
                        <th width="100">新闻类别</th>
                        <td id="category"><?=$companyNews->category?></td>
                    </tr>
                    <tr>
                        <th width="100">新闻来源</th>
                        <td id="author"><?=$companyNews->author?></td>
                    </tr>
                    <tr>
                        <th width="100">新闻内容</th>
                        <td id="content"><?=$companyNews->content?></td>
                    </tr>
                    <tr>
                        <th width="100">关键词</th>
                        <td id="keyword"><?=$companyNews->keyword?></td>
                    </tr>
                    <tr>
                        <th width="100">附件名称</th>
                        <td id="picUrl"><?=$companyNews->attachName?></td>
                    </tr>
                    <tr>
                        <th width="100">图片</th>
                        <td id="picUrl"><img src="<?=$companyNews->picUrl?>" width="60%" /></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('news_detail').close();" />
                </div>
            </div>
    </form>
</div>
