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
                        <th>文章分类：</th>
                        <td><select type="text" style="width:250px;height: 30px;" name="category" id="category"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">标&nbsp;题&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="title" id="title"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>作者：</th>
                        <td><input type="text" style="width:250px;" name="author" id="author"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>关键词：</th>
                        <td><input type="text" style="width:250px;" name="keyword" id="keyword"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>正&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文：</th>
                        <td><textarea style="width:500px;height:200px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th>附&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;件：</th>
                        <td>
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('article/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr onmouseout="pic()">
                        <th>上传图片：</th>
                        <td>
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=60px scrolling=no src="<?=yii::$app->urlManager->createUrl('article/uploads')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th>图片预览：</th>
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
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('article_add').close();"/>
        </div>
    </div>
</div>

<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>
