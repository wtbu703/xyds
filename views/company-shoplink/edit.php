<?php
$this->title = "修改网店";
?>
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company-shoplink/update-one')?>";
    //正则表达式验证公司网址
    function IsUrl(str){
        if(str != '') {
            var regUrl = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/;
            var result = str.match(regUrl);
            if (result != null) {
                //alert("网址输入正确 ");
            }
            else {
                alert('网址输入不正确');
            }
        }
    }
</script>
<script language="javascript" type="text/javascript" src="js/admin/company-shoplink/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改网店</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="50px">名称</th>
                            <td><input type="text" id="shopName"  class="input-text" value="<?=$companyShoplink->shopName?>"/></td>
                            <input type="hidden" id="id" value="<?=$companyShoplink->id?>" />
                        </tr>
                        <tr>
                            <th width="50px">链接</th>
                            <td><input type="text" id="shopLink" style="width:270px;"  value="<?=$companyShoplink->shopLink?>"  onmouseout= "IsUrl(document.myform.shopLink.value)" ></td>
                        </tr>
                        <tr>
                            <th width="50px">平台</th>
                            <td><select style="width:270px;" id="platform">
                                    <?foreach($platform as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $companyShoplink->shopLink){?>
                                            <option name="platform" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="platform" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('shoplink_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>