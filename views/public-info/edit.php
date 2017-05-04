<?php
$this->title = "修改信息";
?>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('public-info/update-one')?>";

    function get_status(){
        var a;
        var timeText = $('.time_text');
        a = document.myform.state.value;
        <?foreach($state as $key => $val){?>
        if(a == <?=$val->dictItemCode?>){
            a = "<?=$val->dictItemName?>";
        }
        <?}?>
        a = a+'时间';
        timeText.html(a);
    }
</script>
<script language="javascript" type="text/javascript" src="js/admin/public-info/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改信息</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px">标题：</th>
                            <td><input type="text" id="title"  class="input-text" style="width:270px;" value="<?=$publicInfo->title?>"/></td>
                            <input type="hidden" id="id" value="<?=$publicInfo->id?>" />
                        </tr>
                        <tr>
                            <th width="100">作者：</th>
                            <td><input type="text" id="author"  class="input-text" style="width:270px;" value="<?=$publicInfo->author?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">内容：</th>
                            <td><textarea style="width:550px;height:150px;" name="content" id="content" ><?=$publicInfo->content?></textarea></td>
                        </tr>
                        <tr>
                            <th width="100">类别：</th>
                            <td><select style="width:270px;" id="category">
                                    <?foreach($cateGory as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $publicInfo->category){?>
                                            <option name="period" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="period" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                        </tr>
                        <tr>
                            <th width="100">状态：</th>
                            <td><select style="width:270px;" id="state" onmouseout="get_status()">
                                    <?foreach($state as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $publicInfo->state){?>
                                            <option name="state" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="state" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                        </tr>
                        <tr>
                            <th class="time_text"></th>
                            <td><input id="datetime" name="datetime" type="text" <?php if(!is_null($info)){?> value="<?=$info->time?>" <?}?> class="date">
                                <script type="text/javascript">
                                    Calendar.setup({
                                        weekNumbers: true,
                                        inputField : "datetime",
                                        trigger    : "datetime",
                                        dateFormat: "%Y-%m-%d %k:%M:%S",
                                        showTime: true,
                                        minuteStep: 1,
                                        onSelect   : function() {this.hide();}
                                    });
                                </script></td>
                        </tr>
                        <tr>
                            <th width="100">附件名称：</th>
                            <td><?=$publicInfo->attachName?></td>
                        </tr>
                        <tr>
                            <th width="100">修改附件：</th>
                            <td>
                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('public-info/upload')?>"></iframe>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('info_update').close();"/>
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