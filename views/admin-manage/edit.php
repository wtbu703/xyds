<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('admin-manage/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/admin/edit.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">管理员信息</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100">用户名</th>
                            <td><div id="username"><?=$user->username?></div></td>
                            <input type="hidden" id="id" value="<?=$user->id?>" />
                        </tr>
                        <tr>
                            <th width="100">真实姓名</th>
                            <td><input type="text" id="truename"  class="input-text" style="width:270px;" value="<?=$user->truename?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">电话号码</th>
                            <td><input type="text" id="mobilephone"  class="input-text" style="width:270px;" value="<?=$user->telephone?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">状态</th>
                            <td>
                                <select style="width:270px;" id="userState">
                                    <?foreach($statedict as $key => $val){?>
                                        <?if($val->dictItemCode == $user->state){?>
                                            <option name="userState" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="userState" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('admin_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>