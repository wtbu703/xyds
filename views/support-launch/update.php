<script>
    var updateUrl = "<?=Yii::$app->urlManager->createUrl('support-launch/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/support-launch/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
	                        <th>项目建设名称：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="name" id="name"  class="input-text" value="<?=$supportLaunch['name']?>"/></td>
	                        <input type="hidden" id="id" value="<?=$supportLaunch['id']?>" />
                        </tr>
                        <tr>
	                        <th>中央财政资金支持建设内容：</th>
	                        <td><input type="text" style="width:400px;height: 30px;" name="centralSupportContent" id="centralSupportContent" class="input-text"  value="<?=$supportLaunch['centralSupportContent']?>"/></td>
                        </tr>

                        <tr>
	                        <th>中央财政资金支持总金额（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="centralSupport" id="centralSupport" class="input-text"  value="<?=$supportLaunch['centralSupport']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>中央财政资金已拨付金额（截止上月底）（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="centralPaid" id="centralPaid" class="input-text" value="<?=$supportLaunch['centralPaid']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>地方财政配套资金总金额（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="localSupport" id="localSupport" class="input-text" value="<?=$supportLaunch['localSupport']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>企业投入资金总金额（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="companyPaid" id="companyPaid" class="input-text" value="<?=$supportLaunch['companyPaid']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>项目承办单位：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="organizer" id="organizer" class="input-text" value="<?=$supportLaunch['organizer']?>"/></td>
                        </tr>
                        <tr>
	                        <th>承办单位负责人：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeName1" id="chargeName1" class="input-text" value="<?=$supportLaunch['chargeName1']?>"/></td>
                        </tr>
                        <tr>
	                        <th>联系电话：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile1" id="chargeMobile1" class="input-text" value="<?=$supportLaunch['chargeMobile1']?>"/></td>
                        </tr>
                        <tr>
	                        <th>信息公开网址：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="publicInfoUrl" id="publicInfoUrl" class="input-text" value="<?=$supportLaunch['publicInfoUrl']?>"/></td>
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