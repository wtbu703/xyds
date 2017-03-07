<?php
$this->title = "修改招聘信息";
?>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('platform-recruit/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/platform-recruit/edit.js" charset="utf-8"></script>
</head>
<body id="_body" scroll="no">
    <div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="center_frame">
        <div class="pad-10">
            <div class="col-tab">
                <ul class="tabBut cu-li">
                    <li id="tab_setting_1" class="on" onclick="">修改招聘信息</li>
                </ul>
                <div id="div_setting_1" class="contentList pad-10">
                    <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                        <table width="90%" cellspacing="0" class="table_form contentWrap">
                            <tbody>
                            <tr>
                                <th width="100">职位</th>
                                <td><input type="text" id="position"  class="input-text" style="width:270px;" value="<?=$platformRecruit->position?>" /></td>
                                <input type="hidden" id="id" value="<?=$platformRecruit->id?>" />
                            </tr>
                            <tr>
                                <th width="100">要求</th>
                                <td><textarea style="width:500px;height:100px;" name="demand" id="demand" ><?=$platformRecruit->demand?></textarea></td>
                            </tr>
                            <tr>
                                <th width="100">手机</th>
                                <td><input type="text" id="mobile" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"   class="input-text" style="width:270px;" value="<?=$platformRecruit->mobile?>" /></td>
                            <tr>
                                <th width="100">座机</th>
                                <td><input type="text" id="tel"  class="input-text" style="width:270px;" value="<?=$platformRecruit->tel?>" /></td>
                            </tr>
                            <tr>
                                <th width="100">邮箱</th>
                                <td><input type="text" id="email"  class="input-text" style="width:270px;" value="<?=$platformRecruit->email?>" /></td>
                            </tr>
                            <tr>
                                <th width="100">联系人</th>
                                <td><input type="text" id="contacts"  class="input-text" style="width:270px;" value="<?=$platformRecruit->contacts?>" /></td>
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
</body>
</html>