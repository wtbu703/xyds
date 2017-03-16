<script>
    var updateUrl = "<?=Yii::$app->urlManager->createUrl('third-party-service/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/third-party-service/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">第三方服务信息</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th>公司名：</th>
                            <td><input type="text" style="width:250px;height: 30px;" name="companyName" id="companyName"  class="input-text" value="<?=$ThirdPartyService['companyName']?>"/></td>
                            <input type="hidden" id="id" value="<?=$ThirdPartyService['id']?>" />
                        </tr>
                        <tr>
	                        <th>LOGO：</th>
	                        <td><img src="<?=$ThirdPartyService['logoUrl']?>"></td>
                        </tr>
                        <tr>
	                        <th>重新上传：</th>
	                        <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
		                        <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
		                        <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
	                        </td>
                        </tr>
                        <tr>
                            <th>简介：</th>
                            <td><input type="text" style="width:400px;height: 30px;" name="introduction" id="introduction"  class="input-text" value="<?=$ThirdPartyService['introduction']?>"/></td>
                        </tr>
                        <tr>
	                        <th>电话：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="tel" id="tel"  class="input-text" value="<?=$ThirdPartyService['tel']?>"/></td>
                        </tr>
                        <tr>
	                        <th>电子邮箱：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="email" id="email"  class="input-text" value="<?=$ThirdPartyService['email']?>"/></td>
                        </tr>
                        <tr>
	                        <th>地址：</th>
	                        <td><input type="text" style="width:400px;height: 30px;" name="address" id="address"  class="input-text" value="<?=$ThirdPartyService['address']?>"/></td>
                        </tr>
                        <tr>
	                        <th>传真：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="fax" id="fax"  class="input-text" value="<?=$ThirdPartyService['fax']?>"/></td>
                        </tr>
                        <tr>
	                        <th>邮编：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="postcode" id="postcode"  class="input-text" value="<?=$ThirdPartyService['postcode']?>"/></td>
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