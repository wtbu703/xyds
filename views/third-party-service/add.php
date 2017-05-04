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
                        <th>公司名：</th>
                        <td><input type="text" style="width:250px;height: 30px;" name="companyName" id="companyName"  class="input-text"/></td>
                    </tr>
					<tr>
						<th width="100px">企业类别：</th>
						<td><select id="category"  style='width:250px;height:25px; ' class="input-text"/></select></td>
					</tr>
	                <tr onmouseout="pic()">
		                <th>图片：</th>
		                <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="40px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('third-party-service/upload')?>"></iframe></td>
	                </tr>
					<tr>
						<th>图片预览：</th>
						<td class="pic_text"></td>
					</tr>
					<tr>
						<th>内容来源：</th>
						<td><input type="text" style="width:400px;height: 30px;" name="sources" id="sources"  class="input-text" placeholder="说明服务内容"/></td>
					</tr>
	                <tr>
		                <th>服务名称：</th>
		                <td><input type="text" style="width:400px;height: 30px;" name="introduction" id="introduction"  class="input-text" placeholder="说明服务内容"/></td>
	                </tr>
					<tr>
						<th>内容：</th>
						<td><textarea style="width:450px;height:200px;" name="content" id="content" ></textarea></td>
					</tr>
					<tr>
						<th>联系人：</th>
						<td><input type="text" style="width:250px;height: 30px;" name="contact" id="contact"  class="input-text"/></td>
					</tr>
	                <tr>
		                <th>电话号码：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="tel" id="tel"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>电子邮箱：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="email" id="email"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>地址：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="address" id="address"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>传真：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="fax" id="fax"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>邮编：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="postcode" id="postcode"  class="input-text"/></td>
	                </tr>
					<tr>
						<th>时间：</th>
						<td><input id="publicTime" name="publicTime" type="text" value="" class="date">
						<script type="text/javascript">
							Calendar.setup({
								weekNumbers: true,
								inputField : "publicTime",
								trigger    : "publicTime",
								dateFormat: "%Y-%m-%d %k:%M:%S",
								showTime: true,
								minuteStep: 1,
								onSelect   : function() {this.hide();}
							});
						</script>
						</td>
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