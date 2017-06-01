<?php
$this->title = '添加招聘信息';
?>
<link href="css/tabpanel/cityList.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/add-one')?>";

</script>


<script type="text/javascript" src="js/admin/company-recruit/add.js"></script>



<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>职位</th>
                        <td><input type="text" id="position"  style="width:270px;" /></td>
                        <td class="one"><div id="positionTip"></div></td>
                    </tr>
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>工作地区：</th>
                        <td colspan="2"><input type="text" name="place" id="city"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>详细地址：</th>
                        <td><input type="text" style="width:250px;" name="workPlace" id="workPlace" /></td>
                        <td class="one"><div id="workPlaceTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>学历要求：</th>
                        <td colspan="2"><select type="text" style="width:260px;" name="record" id="record" ></select></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>薪资：</th>
                        <td><input type="text" style="width:250px;" name="salary" id="salary"/></td>
                        <td class="one"><div id="salaryTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>经验要求：</th>
                        <td><input type="text" style="width:250px;" name="exp" id="exp"  /></td>
                        <td class="one"><div id="expTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">要求：</th>
                        <td colspan="2"><textarea style="width:500px;height:100px;" name="demand" id="demand" ></textarea></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>手机</th>
                        <td><input type="text" id="mobile"  style="width:270px;" /></td>
                        <td class="one"><div id="mobileTip"></div></td>
                    </tr>
                    <tr>
                        <th  align="right"><sub class="redstar">*</sub>座机</th>
                        <td><input type="text" id="tel"  style="width:270px;"  /></td>
                        <td class="one"><div id="telTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>邮箱</th>
                        <td><input type="text" id="email"  style="width:270px;" /></td>
                        <td class="one"><div id="emailTip"></div></td>
                    </tr>
                    <tr>
                        <th  align="right"><sub class="redstar">*</sub>联系人</th>
                        <td><input type="text" id="contacts"  style="width:270px;"  /></td>
                        <td class="one"><div id="contactsTip"></div></td>
                    </tr>

                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="submit" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('recruit_add').close();"/>
        </div>
    </div>
    </br></br></br>
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