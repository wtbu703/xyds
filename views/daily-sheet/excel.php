<script type="text/javascript">
    var saveUrl = "<?=Yii::$app->urlManager->createUrl('daily-sheet/save-excel')?>";
    var indexUrl = "<?=Yii::$app->urlManager->createUrl('daily-sheet/index')?>";
</script>
<script type="text/javascript" src="js/admin/daily-sheet/excel.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
	                <tr>
		                <th>时间：</th>
		                <td>
			                <input id="date" name="date" type="text" value="" class="date">
			                <script type="text/javascript">
				                Calendar.setup({
					                weekNumbers: true,
					                inputField : "date",
					                trigger    : "date",
					                dateFormat: "%Y-%m-%d",
					                showTime: true,
					                minuteStep: 1,
					                onSelect   : function() {this.hide();}
				                });
			                </script>
		                </td>
	                </tr>
	                <tr>
		                <th>上传文件：</th>
		                <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('daily-sheet/upload')?>"></iframe>
		                </td>
	                </tr>
	                <tr>
		                <th>示例文件：</th>
		                <td><a href="upload/doc/example.xlsx" download="示例文件">点击此处下载</a></td>
	                </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="提交" name="dosubmit" onclick="submit()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('upload_excel').close();"/>
        </div>
    </div>
</div>