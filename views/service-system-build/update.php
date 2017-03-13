<script>
    var updateUrl = "<?=Yii::$app->urlManager->createUrl('service-system-build/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/system-build/update.js" charset="utf-8"></script>
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
	                        <td><input type="text" style="width:250px;height: 30px;" name="name" id="name"  class="input-text" value="<?=$serviceSystemBuild['name']?>"/></td>
	                        <input type="hidden" id="id" value="<?=$serviceSystemBuild['id']?>" />
                        </tr>
                        <tr>
	                        <th>详细地址：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="address" id="address"  class="input-text" value="<?=$serviceSystemBuild['address']?>"/></td>
                        </tr>
                        <tr>
	                        <th>主要功能：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="function" id="function"  class="input-text" value="<?=$serviceSystemBuild['function']?>"/></td>
                        </tr>
                        <tr>
	                        <th>负责人：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeName" id="chargeName" class="input-text" value="<?=$serviceSystemBuild['chargeName']?>"/></td>
                        </tr>
                        <tr>
	                        <th>联系电话：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile" id="chargeMobile" class="input-text" value="<?=$serviceSystemBuild['chargeMobile']?>"/></td>
                        </tr>
                        <tr>
	                        <th>服务站ID：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="code" id="code" class="input-text" value="<?=$serviceSystemBuild['code']?>"/></td>
                        </tr>
                        <tr>
	                        <th>是否与县级物流配送中心共享场地和地点：</th>
	                        <td>
		                        <select id="isCountyLogistics" name="isCountyLogistics" style="width:200px;">
			                        <option value="" selected><--请选择--></option>
			                        <option value="1">是</option>
			                        <option value="0">否</option>
		                        </select>
	                        </td>
                        </tr>
                        <tr>
	                        <th>是否承担乡镇级（村级）物流服务点功能：</th>
	                        <td>
		                        <select id="isTownLogistics" name="isTownLogistics" style="width:200px;">
			                        <option value="" selected><--请选择--></option>
			                        <option value="1">是</option>
			                        <option value="0">否</option>
		                        </select>
	                        </td>
                        </tr>
                        <tr>
	                        <th>设施配置：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="config" id="config" class="input-text" value="<?=$serviceSystemBuild['config']?>"/></td>
                        </tr>
                        <tr>
	                        <th>中央财政资金支持建设内容：</th>
	                        <td><input type="text" style="width:400px;height: 30px;" name="centralSupportContent" id="centralSupportContent" class="input-text"  value="<?=$serviceSystemBuild['centralSupportContent']?>"/></td>
                        </tr>
                        <tr>
	                        <th>项目建设进度：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="buildProgress" id="buildProgress" class="input-text" value="<?=$serviceSystemBuild['buildProgress']?>"/></td>
                        </tr>
                        <tr>
	                        <th>中央财政资金支持总金额（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="centralSupport" id="centralSupport" class="input-text"  value="<?=$serviceSystemBuild['centralSupport']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>中央财政资金已拨付金额（截止上月底）（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="centralPaid" id="centralPaid" class="input-text" value="<?=$serviceSystemBuild['centralPaid']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>地方财政配套资金总金额（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="localSupport" id="localSupport" class="input-text" value="<?=$serviceSystemBuild['localSupport']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>企业投入资金总金额（万元）：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="companyPaid" id="companyPaid" class="input-text" value="<?=$serviceSystemBuild['companyPaid']?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
                        </tr>
                        <tr>
	                        <th>项目承办单位：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="organizer" id="organizer" class="input-text" value="<?=$serviceSystemBuild['organizer']?>"/></td>
                        </tr>
                        <tr>
	                        <th>承办单位负责人：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeName1" id="chargeName1" class="input-text" value="<?=$serviceSystemBuild['chargeName1']?>"/></td>
                        </tr>
                        <tr>
	                        <th>联系电话：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile1" id="chargeMobile1" class="input-text" value="<?=$serviceSystemBuild['chargeMobile1']?>"/></td>
                        </tr>
                        <tr>
	                        <th>信息公开网址：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="publicInfoUrl" id="publicInfoUrl" class="input-text" value="<?=$serviceSystemBuild['publicInfoUrl']?>"/></td>
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