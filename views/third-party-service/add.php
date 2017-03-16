<script type="text/javascript">
    var saveUrl = "<?=Yii::$app->urlManager->createUrl('third-party-service/add-one')?>";
    var indexUrl = "<?=Yii::$app->urlManager->createUrl('third-party-service/index')?>";
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
		                <th>LOGO：</th>
		                <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
			                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
			                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('third-party-service/upload')?>"></iframe></td>
	                </tr>
	                <tr>
		                <th>简介：</th>
		                <td><input type="text" style="width:400px;height: 30px;" name="introduction" id="introduction"  class="input-text" placeholder="说明服务内容"/></td>
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