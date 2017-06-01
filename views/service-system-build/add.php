<script type="text/javascript">
    var saveUrl = "<?=Yii::$app->urlManager->createUrl('service-system-build/add-one')?>";
    var indexUrl = "<?=Yii::$app->urlManager->createUrl('service-system-build/index')?>";
</script>
<script type="text/javascript" src="js/admin/system-build/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th><sub class="redstar">*</sub>项目建设名称：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="name" id="name"  class="input-text"/></td>
						<td><div id="nameTip"></div></td>
                    </tr>
                    <tr>
                        <th><sub class="redstar">*</sub>详细地址：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="address" id="address"  class="input-text"/></td>
						<td><div id="addressTip"></div></td>
                    </tr>
                    <tr>
                        <th><sub class="redstar">*</sub>主要功能：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="function" id="function"  class="input-text"/></td>
						<td><div id="functionTip"></div></td>
                    </tr>
                    <tr>
                        <th><sub class="redstar">*</sub>负责人：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="chargeName" id="chargeName" class="input-text"/></td>
						<td><div id="chargeNameTip"></div></td>
                    </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>联系电话：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile" id="chargeMobile" class="input-text"/></td>
						<td><div id="chargeMobileTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>服务站ID：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="code" id="code" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" class="input-text"/></td>
						<td><div id="codeTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>是否与县级物流配送中心共享场地和地点：</th>
		                <td>
			                <select id="isCountyLogistics" name="isCountyLogistics" style="width:200px;">
				                <option value="" selected><--请选择--></option>
				                <option value="1">是</option>
				                <option value="0">否</option>
			                </select>
		                </td>
						<td><div id="isCountyLogisticsTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>是否承担乡镇级（村级）物流服务点功能：</th>
		                <td>
			                <select id="isTownLogistics" name="isTownLogistics" style="width:200px;">
				                <option value="" selected><--请选择--></option>
				                <option value="1">是</option>
				                <option value="0">否</option>
			                </select>
		                </td>
						<td><div id="isTownLogisticsTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>设施配置：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="config" id="config" class="input-text"/></td>
						<td><div id="configTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金支持建设内容：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralSupportContent" id="centralSupportContent" class="input-text" placeholder="对整个项目建设内容进行描述"/></td>
						<td><div id="centralSupportContentTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>项目建设进度：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="buildProgress" id="buildProgress" class="input-text"/></td>
						<td><div id="buildProgressTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金支持总金额（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralSupport" id="centralSupport" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
						<td><div id="centralSupportTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金已拨付金额（截止上月底）（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralPaid" id="centralPaid" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
						<td><div id="centralPaidTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>地方财政配套资金总金额（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="localSupport" id="localSupport" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
						<td><div id="localSupportTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>企业投入资金总金额（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="companyPaid" id="companyPaid" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
						<td><div id="companyPaidTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>项目承办单位：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="organizer" id="organizer" class="input-text"/></td>
						<td><div id="organizerTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>承办单位负责人：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="chargeName1" id="chargeName1" class="input-text"/></td>
						<td><div id="chargeName1Tip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>联系电话：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile1" id="chargeMobile1" class="input-text"/></td>
						<td><div id="chargeMobile1Tip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金支持此项目的政府决策单位或领导：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralDecisionUnit" id="centralDecisionUnit" class="input-text"/></td>
						<td><div id="centralDecisionUnitTip"></div></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>决策文件：</th>
		                <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('service-system-build/upload')?>"></iframe>
		                </td>
						<td></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>信息公开网址：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="publicInfoUrl" id="publicInfoUrl" class="input-text"/></td>
						<td><div id="publicInfoUrlTip"></div></td>
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