<script type="text/javascript">
    var saveUrl = "<?=Yii::$app->urlManager->createUrl('logistics-build/add-one')?>";
    var indexUrl = "<?=Yii::$app->urlManager->createUrl('logistics-build/index')?>";
</script>
<script type="text/javascript" src="js/admin/logistics-build/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th>乡镇快递覆盖率（%）：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="townCover" id="townCover"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"/></td>
                    </tr>
	                <tr>
		                <th>行政村快递覆盖率（%）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="villageCover" id="villageCover"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"/></td>
	                </tr>
	                <tr>
		                <th>当月本县快递收件数量（件）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="receiveNum" id="receiveNum"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"/></td>
	                </tr>
	                <tr>
		                <th>排序：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="orderBy" id="orderBy" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"/></td>
	                </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('build_add').close();"/>
        </div>
    </div>
</div>