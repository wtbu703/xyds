<?php
$this->title = "修改培训报名信息";
?>
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('ectrain-enter/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/ectrain-enter/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改培训报名</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px">培训ID</th>
                            <td><input type="text" id="trainId"  class="input-text" style="width:270px;" value="<?=$ectrainEnter->trainId?>"/></td>
                            <input type="hidden" id="id" value="<?=$ectrainEnter->id?>" />
                        </tr>
                        <tr>
                            <th width="100">真实姓名</th>
                            <td><input type="text" id="truename"  class="input-text" style="width:270px;" value="<?=$ectrainEnter->truename?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">地址</th>
                            <td><input type="text" id="address"  class="input-text" style="width:270px;" value="<?=$ectrainEnter->address?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">手机号</th>
                            <td><input type="text" id="mobile"  class="input-text" style="width:270px;" value="<?=$ectrainEnter->mobile?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" /></td>
                        </tr>
                        <tr>
                            <th width="100">性别</th>
                            <td><input type="text" id="gender"  class="input-text" style="width:270px;" value="<?=$ectrainEnter->gender?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">年龄</th>
                            <td><input type="text" id="age"  class="input-text" style="width:270px;" value="<?=$ectrainEnter->age?>" /></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('enter_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>
