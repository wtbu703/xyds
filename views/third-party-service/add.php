<script type="text/javascript">
    var saveUrl = "<?=Yii::$app->urlManager->createUrl('third-party-service/add-one')?>";
    var indexUrl = "<?=Yii::$app->urlManager->createUrl('third-party-service/index')?>";

	function pic(){
		var a;
		var timeText = $('.pic_text');
		a = document.myform.attachUrls.value;
		a = "<img src='"+a+"'  width='60%'>";
		timeText.html(a);
	}
</script>
<script type="text/javascript" src="js/admin/third-party-service/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>公司名称：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="companyName" id="companyName"  class="input-text"/></td>
						<td class="one"><div id="companyNameTip"></div></td>
                    </tr>
					<tr>
						<th align="right"><sub class="redstar">*</sub>企业类别：</th>
						<td><select id="category" style="width:250px;height: 30px;" class="input-text"/></select></td>
						<td class="one"><div id="categoryTip"></div></td>
					</tr>
	                <tr onmouseout="pic()">
		                <th align="right">图片：</th>
		                <td colspan="2"><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="40px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('third-party-service/upload')?>"></iframe></td>
	                </tr>
					<tr>
						<th align="right">图片预览：</th>
						<td class="pic_text" colspan="2"></td>
					</tr>
					<tr>
						<th align="right"><sub class="redstar">*</sub>发布者：</th>
						<td><input type="text" style="width:400px;height: 30px;" name="sources" id="sources"  class="input-text" placeholder="说明服务内容"/></td>
						<td class="one"><div id="sourcesTip"></div></td>
					</tr>
	                <tr>
		                <th align="right"><sub class="redstar">*</sub>服务名称：</th>
		                <td><input type="text" style="width:400px;height: 30px;" name="introduction" id="introduction"  class="input-text" placeholder="说明服务内容"/></td>
						<td class="one"><div id="introductionTip"></div></td>
	                </tr>
					<tr>
						<th align="right">内容：</th>
						<td colspan="2"><textarea style="width:450px;height:200px;" name="content" id="content" ></textarea></td>
					</tr>
					<tr>
						<th align="right"><sub class="redstar">*</sub>联系人：</th>
						<td><input type="text" style="width:250px;height: 30px;" name="contact" id="contact"  class="input-text"/></td>
						<td class="one"><div id="contactTip"></div></td>
					</tr>
	                <tr>
		                <th align="right"><sub class="redstar">*</sub>电话号码：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="tel" id="tel"  class="input-text"/></td>
						<td class="one"><div id="telTip"></div></td>
	                </tr>
	                <tr>
		                <th width="170" align="right"><sub class="redstar">*</sub>电子邮箱：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="email" id="email"  class="input-text"/></td>
						<td class="one"><div id="emailTip"></div></td>
	                </tr>
	                <tr>
		                <th align="right"><sub class="redstar">*</sub>地址：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="address" id="address"  class="input-text"/></td>
						<td class="one"><div id="addressTip"></div></td>
	                </tr>
	                <tr>
		                <th align="right">传真：</th>
						<td colspan="2"><input type="text" style="width:250px;height: 30px;" name="fax" id="fax"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th align="right"><sub class="redstar">*</sub>邮编：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="postcode" id="postcode"  class="input-text"/></td>
						<td class="one"><div id="postcodeTip"></div></td>
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
	</br></br>
</div>
<script type="text/javascript">
	var contentEditor=genEditor('','content','');
</script>