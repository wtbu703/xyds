<?php
$this->title = "修改企业";
?>

<script type="text/javascript">
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company/update-one')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
    //正则表达式验证公司网址
    function IsUrl(str){
        if(str != '') {
            var regUrl = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/;
            var result = str.match(regUrl);
            if (result != null) {
                //alert("网址输入正确 ");
            }
            else {
                window.top.art.dialog({
                    content: '网址输入不正确！',
                    lock: true,
                    width: 250,
                    border: false,
                    time: 2
                    height: 100,
                });
            }
        }
    }
</script>
<script language="javascript" type="text/javascript" src="js/admin/company/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改企业</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px">类别</th>
                            <td><select style="width:270px;" id="category">
                                    <?foreach($category as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $company->category){?>
                                            <option name="category" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="category" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                        </tr>
                        <tr>
                            <th width="100">名称</th>
                            <td><input type="text" id="name"  class="input-text" style="width:270px;" value="<?=$company->name?>"/></td>
                            <input type="hidden" id="id" value="<?=$company->id?>" />
                        </tr>
                        <tr>
                            <th width="100">法人</th>
                            <td><input type="text" id="corporate"  class="input-text" style="width:270px;" value="<?=$company->corporate?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">地址</th>
                            <td><input type="text" id="address"  class="input-text" style="width:270px;" value="<?=$company->address?>" /></td>
                        </tr>
                        <tr>
                            <th>网址：</th>
                            <td><input type="text" style="width:250px;" id="webSite" value="<?=$company->webSite?>"  onmouseout= "IsUrl(document.myform.webSite.value)" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>来源：</th>
                            <td><input type="text" style="width:250px;" id="sources"  class="input-text" value="<?=$company->sources?>"/></td>
                        </tr>
                        <tr>
                            <th width="100">电话</th>
                            <td><input type="text" id="tel"  class="input-text" style="width:270px;" value="<?=$company->tel?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">简介</th>
                            <td><textarea style="width:500px;height:100px;" name="introduction" id="introduction" ><?=$company->introduction?></textarea></td>
                        </tr>
                        <tr>
                            <th width="100">原始图片：</th>
                            <td><img src="<?=$company->logoUrl?>" width="60%" /></td>
                        </tr>
                        <tr onmouseout="pic()">
                            <th>修改图片：</th>
                            <td>
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" value="" class="input-text" "/>
                                <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th>图片预览：</th>
                            <td class="pic_text"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('company_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','introduction','');
</script>