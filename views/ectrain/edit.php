<?php
$this->title = "修改培训信息";
?>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('ectrain/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/ectrain/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改培训信息</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px">培训名：</th>
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
                            <td><textarea style="width:500px;height:100px;" name="content" id="content" ><?=$ectrain->content?></textarea></td>
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
                            <th>报名时间：</th>
                            <td><input id="beginTime" name="beginTime" type="text" value="" class="date">
                                <script type="text/javascript">
                                    Calendar.setup({
                                        weekNumbers: true,
                                        inputField : "beginTime",
                                        trigger    : "beginTime",
                                        dateFormat: "%Y-%m-%d %k:%M:%S",
                                        showTime: true,
                                        minuteStep: 1,
                                        onSelect   : function() {this.hide();}
                                    });
                                </script>
                                &nbsp;至&nbsp;&nbsp;
                                <input id="endTime" name="endTime" type="text" value="" class="date">
                                <script type="text/javascript">
                                    Calendar.setup({
                                        weekNumbers: true,
                                        inputField : "endTime",
                                        trigger    : "endTime",
                                        dateFormat: "%Y-%m-%d %k:%M:%S",
                                        showTime: true,
                                        minuteStep: 1,
                                        onSelect   : function() {this.hide();}
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <th>针对人群：</th>
                            <td><input type="text" style="width:250px;"  name="target" id="target" value="<?=$ectrain->target?>" ></td>
                        </tr>
                        <tr>
                            <th>发布人：</th>
                            <td><input type="text" style="width:250px;"  name="publisher" id="publisher" value="<?=$ectrain->publisher?>" ></td>
                        </tr>
                        <tr>
                            <th>产品缩略图：</th>
                            <td>
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th>产品大图：</th>
                            <td>
                                <input type="text" style="display:none;" name="thumbnailUrl" id="thumbnailUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl(['ectrain/upload','detail'=>'detail'])?>"></iframe>
                            </td>
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
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>