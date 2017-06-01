<?php
$this->title = '添加新闻';
?>
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company-news/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company-news/add-one')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  id='ic'>";
        timeText.html(a);
    }

</script>
<script type="text/javascript" src="js/admin/company-news/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>新闻标题：</th>
                        <td><input type="text" id="title"  class="inputxt"  style="width:270px;"/></td>
                        <td class="one"><div id="titleTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>新闻类别：</th>
                        <td><select style="width:270px;" id="category"></select></td>
                        <td class="one"><div id="categoryTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>新闻来源：</th>
                        <td><input type="text" style="width:250px;" name="author" id="author" class="inputxt"/></td>
                        <td class="one"><div id="authorTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">新闻内容</th>
                        <td colspan="2"><textarea style="width:500px;height:100px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>关键词：</th>
                        <td><input type="text" id="keyword"  class="inputxt" style="width:270px;" /></td>
                        <td class="one"><div id="keywordTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">附件：</th>
                        <td>
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/upload')?>"></iframe>
                        </td>
                        <td class="one"></td>
                    </tr>
                    <tr onmouseout="pic()">
                        <th align="right">上传图片</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/uploads')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">图片预览</th>
                        <td class="pic_text"></td>
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
    </br> </br> </br>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>
