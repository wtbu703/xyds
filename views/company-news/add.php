<?php
$this->title = '添加新闻';
?>

<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company-news/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company-news/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/company-news/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th >企业ID：</th>
                        <td><input type="text" style="width:250px;" name="companyId" id="companyId"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th >新闻标题：</th>
                        <td><input type="text" style="width:250px;" name="title" id="title"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>新闻内容：</th>
                        <td><textarea style="width:500px;height:100px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th>关键词：</th>
                        <td><input type="text" style="width:250px;" name="keyword" id="keyword"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>附&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;件：</th>
                        <td>
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/upload')?>"></iframe>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('news_add').close();"/>
        </div>
    </div>
</div>
