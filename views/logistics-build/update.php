<script>
    var updateUrl = "<?=Yii::$app->urlManager->createUrl('logistics-build/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/logistics-build/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
	                        <th><sub class="redstar">*</sub>乡镇快递覆盖率（%）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="townCover" id="townCover"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" value="<?=$supportLaunch['townCover']?>"/></td>
                        </tr>
                        <tr>
	                        <th><sub class="redstar">*</sub>县->乡快递企业数量（个）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="countyToVillage" id="countyToVillage"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"value="<?=$supportLaunch['countyToVillage']?>"/></td>
                        </tr>
                        <tr>
	                        <th><sub class="redstar">*</sub>行政村快递覆盖率（%）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="villageCover" id="villageCover"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" value="<?=$supportLaunch['villageCover']?>"/></td>
                        </tr>
                        <tr>
	                        <th><sub class="redstar">*</sub>乡->村快递企业数量（个）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="villageToHamlet" id="villageToHamlet"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"value="<?=$supportLaunch['villageToHamlet']?>"/></td>
                        </tr>
                        <tr>
	                        <th><sub class="redstar">*</sub>当月本县快递收件数量（件）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="receiveNum" id="receiveNum"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" value="<?=$supportLaunch['receiveNum']?>"/></td>
                        </tr>
                        <tr>
	                        <th><sub class="redstar">*</sub>当月本县快递发件数量（件）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="sendNum" id="sendNum"  class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"value="<?=$supportLaunch['sendNum']?>"/></td>
                        </tr>
                        <tr>
	                        <th><sub class="redstar">*</sub>排序：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="orderBy" id="orderBy" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" value="<?=$supportLaunch['orderBy']?>"/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="save()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('site_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>