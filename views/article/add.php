<?php
$this->title =  '添加文章';
?>
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('article/findbyattri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('article/addone')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
</script>
<script type="text/javascript" src="js/admin/article/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>文章分类：</th>
                        <td><select type="text" style="width:250px;height: 30px;" name="category" id="category"  class="input-text"/></td>
                        <td class="one"><div id="categoryTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>标&nbsp;题&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="title" id="title"  class="input-text"/></td>
                        <td class="one"><div id="titleTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>作者：</th>
                        <td><input type="text" style="width:250px;" name="author" id="author"  class="input-text"/></td>
                        <td class="one"><div id="authorTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>来源：</th>
                        <td><input type="text" style="width:250px;" name="sourceUrl" id="sourceUrl"  class="input-text"/></td>
                        <td class="one"><div id="sourceUrlTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>关键词：</th>
                        <td><input type="text" style="width:250px;" name="keyword" id="keyword"  class="input-text"/></td>
                        <td class="one"><div id="keywordTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">正文：</th>
                        <td colspan="2"><textarea style="width:500px;height:200px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th align="right">附件：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('article/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr onmouseout="pic()">
                        <th align="right">上传图片：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=60px scrolling=no src="<?=yii::$app->urlManager->createUrl('article/uploads')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">图片预览：</th>
                        <td class="pic_text" colspan="2"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('article_add').close();"/>
        </div>
    </div>
</div>

<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>
