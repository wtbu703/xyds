<script type="text/javascript">
    window.top.$('#display_center_id').css('display','none');
    var saveUrl = '<?=yii::$app->urlManager->createUrl('pic/add-one')?>';
    var indexUrl = '<?=yii::$app->urlManager->createUrl('pic/index')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/pic/add.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <form action="<?=Yii::$app->urlManager->createUrl('pic/add-one')?>" id="categoryForm" name="categoryForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px">前台栏目</th>
                        <td><select id="category" style='width:135px' name="category"></select></td>
                    </tr>
	                <tr>
		                <th>上传图片：</th>
		                <td>
			                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('pic/upload')?>"></iframe>
		                </td>
	                </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
        <!--列表-->
        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="add()"/>
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('category_add').close();"/>
            </div>
        </div>
    </form>
</div>