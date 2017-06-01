<?php
$this->title = "修改企业";
?>


<script type="text/javascript">
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company/update-one')?>";
    var detailUrl = "<?=yii::$app->urlManager->createUrl('company/find-one')?>";


    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
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
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px" align="right"><sub class="redstar">*</sub>类别：</th>
                            <td><select style="width:270px;" id="category">
                                    <?foreach($category as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $company->category){?>
                                            <option name="category" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="category" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                            <td class="one"><div id="categoryTip"></div></td>
                        </tr>
                        <tr>
                            <input type="hidden" id="id" value="<?=$company->id?>"/>
                            <th align="right"><sub class="redstar">*</sub>名称：</th>
                            <td><input type="text" id="name"  class="inputxt" style="width:270px;" value="<?=$company->name?>" /></td>
                            <td class="one"><div id="nameTip"></div></td>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>法人：</th>
                            <td><input type="text" id="corporate"  class="inputxt" style="width:270px;" value="<?=$company->corporate?>" /></td>
                            <td class="one"><div id="corporateTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>地址：</th>
                            <td><input type="text" id="address"  class="inputxt" style="width:270px;" value="<?=$company->address?>" /></td>
                            <td class="one"><div id="addressTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>网址：</th>
                            <td><input type="text" id="webSite"  class="inputxt" style="width:270px;" value="<?=$company->webSite?>" /></td>
                            <td class="one"><div id="webSiteTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>来源：</th>
                            <td><input type="text" id="sources"  class="inputxt" style="width:270px;" value="<?=$company->sources?>" /></td>
                            <td class="one"><div id="sourcesTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>电话：</th>
                            <td><input type="text" id="tel"  class="inputxt" style="width:270px;" value="<?=$company->tel?>" /></td>
                            <td class="one"><div id="telTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">简介:</th>
                            <td colspan="2"><textarea style="width:500px;height:100px;" name="introduction" id="introduction" ><?=$company->introduction?></textarea></td>
                        </tr>
                        <tr>
                            <th align="right">原始图片:</th>
                            <td><img src="<?=$company->logoUrl?>" width="60%" /></td>
                        </tr>
                        <tr onmouseout="pic();">
                            <th align="right">修改图片:</th>
                            <td colspan="2">
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" value="" class="input-text" "/>
                                <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">图片预览:</th>
                            <td class="pic_text"></td>
                            <td class="one"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit('<?=$type?>')"/>
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