<script>
    var updateUrl = "<?=Yii::$app->urlManager->createUrl('third-party-service/update-one')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.attachUrls.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
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
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th align="right" width="120px"><sub class="redstar">*</sub>公司名称：</th>
                            <td><input type="text" style="width:250px;height: 30px;" name="companyName" id="companyName"  class="input-text" value="<?=$ThirdPartyService['companyName']?>"/></td>
                            <input type="hidden" id="id" value="<?=$ThirdPartyService['id']?>" />
                            <td class="one"><div id="companyNameTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>公司类别：</th>
                            <td><select style="width:270px;" id="category">
                                    <?foreach($category as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $ThirdPartyService->category){?>
                                            <option name="category" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="category" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                            <td class="one"><div id="categoryTip"></div></td>
                        </tr>
                        <tr>
	                        <th align="right">原始图片：</th>
	                        <td colspan="2"><img src="<?=$ThirdPartyService['logoUrl']?>" width="60%"></td>
                        </tr>
                        <tr onmouseout="pic()">
	                        <th align="right">重新上传：</th>
	                        <td colspan="2"><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
		                        <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
		                        <iframe frameborder="0" width="100%" height="40px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
	                        </td>
                        </tr>
                        <tr>
                            <th align="right">图片预览：</th>
                            <td class="pic_text" colspan="2"></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>服务名称：</th>
                            <td><input type="text" style="width:400px;height: 30px;" name="introduction" id="introduction"  class="input-text" value="<?=$ThirdPartyService['introduction']?>"/></td>
                            <td class="one"><div id="introductionTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>发布者：</th>
                            <td><input type="text" style="width:400px;height: 30px;" name="sources" id="sources"  class="input-text" value="<?=$ThirdPartyService['sources']?>"/></td>
                            <td class="one"><div id="sourcesTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">内容：</th>
                            <td colspan="2"><textarea style="width:450px;height:200px;" name="content" id="content"> <?=$ThirdPartyService['content']?> </textarea></td>
                        </tr><tr>
                            <th align="right"><sub class="redstar">*</sub>联系人：</th>
                            <td><input type="text" style="width:250px;height: 30px;" name="contact" id="contact" value="<?=$ThirdPartyService['contact']?>"  class="input-text"/></td>
                            <td class="one"><div id="contactTip"></div></td>
                        </tr>
                        <tr>
	                        <th width="170" align="right"><sub class="redstar">*</sub>电话：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="tel" id="tel"  class="input-text" value="<?=$ThirdPartyService['tel']?>"/></td>
                            <td class="one"><div id="telTip"></div></td>
                        </tr>
                        <tr>
	                        <th align="right"><sub class="redstar">*</sub>电子邮箱：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="email" id="email"  class="input-text" value="<?=$ThirdPartyService['email']?>"/></td>
                            <td class="one"><div id="emailTip"></div></td>
                        </tr>
                        <tr>
	                        <th align="right"><sub class="redstar">*</sub>地址：</th>
	                        <td><input type="text" style="width:400px;height: 30px;" name="address" id="address"  class="input-text" value="<?=$ThirdPartyService['address']?>"/></td>
                            <td class="one"><div id="addressTip"></div></td>
                        </tr>
                        <tr>
	                        <th align="right">传真：</th>
	                        <td colspan="2"><input type="text" style="width:250px;height: 30px;" name="fax" id="fax"  class="input-text" value="<?=$ThirdPartyService['fax']?>"/></td>
                        </tr>
                        <tr>
	                        <th align="right"><sub class="redstar">*</sub>邮编：</th>
	                        <td><input type="text" style="width:250px;height: 30px;" name="postcode" id="postcode"  class="input-text" value="<?=$ThirdPartyService['postcode']?>"/></td>
                            <td class="one"><div id="postcodeTip"></div></td>
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
            </br>
            </br>
            </br>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>