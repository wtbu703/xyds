<?php
$this->title = "修改招聘信息";
?>
<link href="css/tabpanel/cityList.css" rel="stylesheet" type="text/css">
<!--表单验证-->
<link href="css/admin/validator.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="js/admin/formvalidatorregex.js" charset="utf-8"></script>
<script language="javascript" type="text/javascript" src="js/admin/formvalidator.js" charset="utf-8"></script>
<link href="css/common_css/edit.css" rel="stylesheet">
<!--表单验证 end-->
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/update-one')?>";
</script>

<script language="javascript" type="text/javascript" src="js/admin/company-recruit/edit.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改招聘信息</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px" align="right"><sub class="redstar">*</sub>职位</th>
                            <td><input type="text" id="position" style="width:270px;" value="<?=$companyRecruit->position?>" /></td>
                            <td class="one"><div id="positionTip"></div></td>
                            <input type="hidden" id="id"  class="input-text" value="<?=$companyRecruit->id?>" />
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>工作地区：</th>
                            <td><input type="text" style="width:250px;" name="place" id="city"  value="<?=$companyRecruit->place?>"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>详细地址：</th>
                            <td><input type="text" style="width:250px;" name="workPlace" id="workPlace"  value="<?=$companyRecruit->workPlace?>" /></td>
                            <td class="one"><div id="workPlaceTip"></div></td>
                        </tr>
                        <tr>
                            <th width="100px" align="right"><sub class="redstar">*</sub>学历要求:</th>
                            <td><select style="width:270px;" id="record">
                                    <?foreach($record as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $companyRecruit->record){?>
                                            <option name="record" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="record" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                            <td><div id="recordTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>薪资：</th>
                            <td><input type="text" style="width:250px;" name="salary" id="salary"  value="<?=$companyRecruit->salary?>"/></td>
                            <td class="one"><div id="salaryTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>经验要求：</th>
                            <td><input type="text" style="width:250px;" name="exp" id="exp"  value="<?=$companyRecruit->exp?>" /></td>
                            <td class="one"><div id="expTip"></div></td>
                        </tr>
                        <tr>
                            <th  align="right">要求</th>
                            <td colspan="2"><textarea style="width:500px;height:100px;" name="demand" id="demand" ><?=$companyRecruit->demand?></textarea></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>手机</th>
                            <td><input type="text" id="mobile" style="width:270px;" value="<?=$companyRecruit->mobile?>" /></td>
                            <td class="one"><div id="mobileTip"></div></td>
                        </tr>
                        <tr>
                            <th  align="right"><sub class="redstar">*</sub>座机</th>
                            <td><input type="text" id="tel" style="width:270px;"  value="<?=$companyRecruit->tel?>" /></td>
                            <td class="one"><div id="telTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>邮箱</th>
                            <td><input type="text" id="email"  style="width:270px;" value="<?=$companyRecruit->email?>" /></td>
                            <td class="one"><div id="emailTip"></div></td>
                        </tr>
                        <tr>
                            <th  align="right"><sub class="redstar">*</sub>联系人</th>
                            <td><input type="text" id="contacts"  style="width:270px;" value="<?=$companyRecruit->contacts?>" /></td>
                            <td class="one"><div id="contactsTip"></div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('recruit_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script type="text/javascript" src="js/admin/company-recruit/cityJson.js"></script>
<script type="text/javascript" src="js/admin/company-recruit/Popt.js"></script>
<script type="text/javascript" src="js/admin/company-recruit/citySet.js"></script>
<script type="text/javascript">
    var contentEditor=genEditor('','demand','');

    $("#city").click(function (e) {
        SelCity(this,e);

    });
</script>