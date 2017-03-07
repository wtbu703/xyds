<?php
$this->title = "修改培训信息";
?>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('ectrain/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/ectrain/edit.js" charset="utf-8"></script>
</head>
<body id="_body" scroll="no">
    <div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="center_frame">
        <div class="pad-10">
            <div class="col-tab">
                <ul class="tabBut cu-li">
                    <li id="tab_setting_1" class="on" onclick="">修改培训信息</li>
                </ul>
                <div id="div_setting_1" class="contentList pad-10">
                    <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                        <table width="90%" cellspacing="0" class="table_form contentWrap">
                            <tbody>
                            <tr>
                                <th >培训名：</th>
                                <td><input type="text" style="width:250px;" name="name" id="name" value="<?=$ectrain->name?>" /></td>
                                <input type="hidden" id="id" value="<?=$ectrain->id?>"
                            </tr>
                            <tr>
                                <th>培训类别：</th>
                                <td><select style="width:270px;" id="category">
                                        <?foreach($categorydict as $key => $val){?>
                                            <?if(intval($val->dictItemCode) == $ectrain->category){?>
                                                <option name="category" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                            <?}else{?>
                                                <option name="category" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                            <?}?>
                                        <?}?>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><input type="text" style="width:250px;" name="content" id="content" value="<?=$ectrain->content?>" /></td>
                            </tr>
                            <tr>
                                <th>天数：</th>
                                <td><input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" style="width:250px;" name="dayNum" id="dayNum" value="<?=$ectrain->dayNum?>" /></td>
                            </tr>
                            <tr>
                                <th>期数：</th>
                                <td><select style="width:270px;" id="period">
                                        <?foreach($perioddict as $key => $val){?>
                                            <?if(intval($val->dictItemCode) == $ectrain->category){?>
                                                <option name="period" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                            <?}else{?>
                                                <option name="period" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                            <?}?>
                                        <?}?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>人数：</th>
                                <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="peopleNum" id="peopleNum" value="<?=$ectrain->peopleNum?>" ></td>
                            </tr>
                            <tr>
                                <th>针对人群：</th>
                                <td><input type="text" style="width:250px;"  name="target" id="target" value="<?=$ectrain->target?>" ></td>
                            </tr>
                            <tr>
                                <th>发布人：</th>
                                <td><input type="text" style="width:250px;"  name="publisher" id="publisher" value="<?=$ectrain->publisher?>" ></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <div class="bk10"></div>
                    <div class="rightbtn">
                        <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                        &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('ectrain_update').close();"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</body>
</html>