<script>
    var updateUrl = "<?=Yii::$app->urlManager->createUrl('service-site/update-one')?>";
    var checkCodeUrl = "<?=Yii::$app->urlManager->createUrl('service-site/check-code')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/service-site/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">服务站点信息</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th>站点编码：</th>
                            <td><input type="text" style="width:250px;height: 30px;" name="code" id="code"  class="input-text" value="<?=$serviceSite['code']?>"/></td>
                            <input type="hidden" id="id" value="<?=$serviceSite['id']?>" />
	                        <input type="hidden" id="oldCode" value="<?=$serviceSite['code']?>" />
                        </tr>
                        <tr>
                            <th>站点名称：</th>
                            <td><input type="text" style="width:250px;height: 30px;" name="name" id="name"  class="input-text" value="<?=$serviceSite['name']?>"/></td>
                        </tr>
                        <tr>
                            <th>站点类型：</th>
                            <td><select style="width:200px;" id="type">
		                            <?foreach($typeDict as $key => $val){?>
			                            <?if($val->dictItemCode == $serviceSite['countyType']){?>
				                            <option name="type" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
			                            <?}else{?>
				                            <option name="type" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
			                            <?}?>
		                            <?}?>
	                            </select>
                            </td>
                        </tr>
                        <tr>
	                        <th>负责人：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeName" id="chargeName"  class="input-text" value="<?=$serviceSite['chargeName']?>"/></td>
                        </tr>
                        <tr>
	                        <th>联系电话：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="chargeMobile" id="chargeMobile"  class="input-text" value="<?=$serviceSite['chargeMobile']?>"/></td>
                        </tr>
                        <tr>
	                        <th>地址：</th>
	                        <td><input type="text" style="width:400px;height: 30px;" name="address" id="address"  class="input-text" value="<?=$serviceSite['address']?>"/></td>
                        </tr>
                        <tr>
	                        <th>站点照片：</th>
	                        <td><img src="<?=$serviceSite['picUrl']?>"></td>
                        </tr>
                        <tr>
	                        <th>重新上传：</th>
	                        <td><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
		                        <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
		                        <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('service-site/upload')?>"></iframe>
	                        </td>
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