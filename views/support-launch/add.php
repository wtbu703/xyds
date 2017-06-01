<script type="text/javascript">
    var saveUrl = "<?=Yii::$app->urlManager->createUrl('support-launch/add-one')?>";
    var indexUrl = "<?=Yii::$app->urlManager->createUrl('support-launch/index')?>";
</script>
<script type="text/javascript" src="js/admin/support-launch/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th><sub class="redstar">*</sub>项目建设名称：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="name" id="name"  class="input-text"/></td>
                    </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金支持建设内容：</th>
		                <td><input type="text" style="width:400px;height: 30px;" name="centralSupportContent" id="centralSupportContent" class="input-text" placeholder="对整个项目建设内容进行描述"/></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金支持总金额（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralSupport" id="centralSupport" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金已拨付金额（截止上月底）（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralPaid" id="centralPaid" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>地方财政配套资金总金额（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="localSupport" id="localSupport" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>企业投入资金总金额（万元）：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="companyPaid" id="companyPaid" class="input-text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-.-]+/,'');}).call(this)" onblur="this.v();" /></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>项目承办单位：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="organizer" id="organizer" class="input-text"/></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>承办单位负责人：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="chargeName1" id="chargeName1" class="input-text"/></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>联系电话：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile1" id="chargeMobile1" class="input-text"/></td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>中央财政资金支持此项目的政府决策单位或领导：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="centralDecisionUnit" id="centralDecisionUnit" class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>决策文件：</th>
		                <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('service-system-build/upload')?>"></iframe>
		                </td>
	                </tr>
	                <tr>
		                <th><sub class="redstar">*</sub>信息公开网址：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="publicInfoUrl" id="publicInfoUrl" class="input-text"/></td>
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