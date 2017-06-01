<script type="text/javascript">
    var category = "<?=$pic->category?>";
    var listdictUrl = '<?=Yii::$app->urlManager->createUrl('dict/findall')?>';
    var updateUrl = '<?=Yii::$app->urlManager->createUrl('pic/update-one')?>';
    var uploadUrl = '<?=yii::$app->urlManager->createUrl('third-party-service/upload')?>';
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.categoryForm.attachUrls.value;
        a = "<img src='"+a+"'  width='50%'>";
        timeText.html(a);
    }
</script>
<script language="javascript" type="text/javascript" src="js/admin/pic/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <form action="<?=Yii::$app->urlManager->createUrl('pic/update-one')?>" id="categoryForm" name="categoryForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right">前台栏目:</th>
                        <td>
                            <select id="category" name="category" style="width:100px"></select><input type="hidden" id="id" value="<?=$pic->id?>"/>
                        </td>
                    </tr>
	                <tr>
		                <th align="right">原图：</th>
		                <td>
			                <img src="<?=$pic->url?>" width="50%"/>
		                </td>
	                </tr>
	                <tr onmouseout="pic()">
		                <th align="right">重新上传：</th>
		                <td>
			                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('pic/upload')?>"></iframe>
		                </td>
	                </tr>
                    <tr>
                        <th align="right">图片预览：</th>
                        <td class="pic_text" ></td>
                    </tr>

                </table>
            </div>
            <div class="bk10"></div>
        </div>
        <!--列表-->
        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="update()"/>
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('category_update').close();"/>
            </div>
        </div>
    </form>
</div>