<?php
$this->title = "修改培训信息";
?>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('ectrain/update-one')?>";
    function pic(){
        var a;
        a = document.myform.picUrl.value;
        arr = a.split(';');
        for(i in arr) {
            ar = "<img src='" + arr[i] + "'  width='60%'>";
            var timeText = $('.pic_text'+i);
            timeText.html(ar);
        }
    }
    function bigPic(){
        var a;
        var timeText = $('.pic_text4');
        a = document.myform.thumbnailUrl.value;
        var ar = "<img src='"+a+"'  width='60%'>";
        timeText.html(ar);
    }
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
                            <th width="100px" align="right"><sub class="redstar">*</sub>培训名称：</th>
                            <td><input type="text" style="width:268px;height: 30px;" name="name" id="name" value="<?=$ectrain->name?>" /></td>
                            <td class="one"><div id="nameTip"></div></td>
                            <input type="hidden" id="id" value="<?=$ectrain->id?>"
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>培训类别：</th>
                            <td><select style="width:268px;height: 40px;"  id="category">
                                    <?foreach($categorydict as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $ectrain->category){?>
                                            <option name="category" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="category" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                            <td class="one"><div id="categoryTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">内容：</th>
                            <td colspan="2"><textarea style="width:500px;height:100px;" name="content" id="content" ><?=$ectrain->content?></textarea></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>天数：</th>
                            <td><input type="text"  onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" style="width:268px;height: 30px;" name="dayNum" id="dayNum" value="<?=$ectrain->dayNum?>" /></td>
                            <td class="one"><div id="dayNumTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>期数：</th>
                            <td><select style="width:268px;height: 40px;"  id="period">
                                    <?foreach($perioddict as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $ectrain->category){?>
                                            <option name="period" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="period" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select>
                            </td>
                            <td class="one"><div id="periodTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>人数：</th>
                            <td><input type="text" style="width:268px;height: 30px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="peopleNum" id="peopleNum" value="<?=$ectrain->peopleNum?>" ></td>
                            <td class="one"><div id="peopleNumTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">报名时间：</th>
                            <td colspan="2"><input id="beginTime" name="beginTime" style="width:250px;height: 30px;"  type="text" value="<?=$ectrain->beginTime?>" class="date">
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
                                <input id="endTime" name="endTime" type="text" style="width:250px;height: 30px;"  value="<?=$ectrain->endTime?>" class="date">
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
                            <th align="right">针对人群：</th>
                            <td colspan="2"><input type="text"style="width:268px;height: 30px;"  name="target" id="target" value="<?=$ectrain->target?>" ></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>发布人：</th>
                            <td><input type="text"style="width:268px;height: 30px;"  name="publisher" id="publisher" value="<?=$ectrain->publisher?>" ></td>
                            <td class="one"><div id="publisherTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">培训开始时间：</th>
                            <td colspan="2"><input id="time" name="time" type="text" style="width:250px;height: 30px;"  value="<?=$ectrain->time?>" class="date">
                                <script type="text/javascript">
                                    Calendar.setup({
                                        weekNumbers: true,
                                        inputField : "time",
                                        trigger    : "time",
                                        dateFormat: "%Y-%m-%d %k:%M:%S",
                                        showTime: true,
                                        minuteStep: 1,
                                        onSelect   : function() {this.hide();}
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">原始大图：</th>
                            <td id="thumbnailUrl" colspan="2"> <img src="<?=$ectrain->thumbnailUrl?>" width="60%"></td>
                        </tr>
                        <tr onmouseout="bigPic()">
                            <th align="right">修改图片：</th>
                            <td colspan="2">
                                <input type="text" style="display:none;" name="thumbnailUrl" id="thumbnailUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">大图预览：</th>
                            <td class="pic_text4" colspan="2"></td>
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