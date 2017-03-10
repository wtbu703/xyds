<?php
$this->title = '添加信息';
?>

<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('public-info/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('public-info/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/public-info/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th>标题：</th>
                        <td><input type="text" style="width:250px;" name="title" id="title"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>作者：</th>
                        <td><input type="text" style="width:250px;" name="author" id="author"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>内容：</th>
                        <td><textarea style="width:500px;height:100px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th>类别：</th>
                        <td><select type="text" style="width:250px;height:30px;" name="category" id="category"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>状态：</th>
                        <td><select type="text" style="width:250px;height:30px;" name="state" id="state"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>附&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;件：</th>
                        <td>
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('public-info/upload')?>"></iframe>
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
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('info_add').close();"/>
        </div>
    </div>
</div>
