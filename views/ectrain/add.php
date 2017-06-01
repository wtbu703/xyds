<?php
$this->title = '添加培训信息';
?>

<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('ectrain/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('ectrain/add-one')?>";
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
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
</script>
<script type="text/javascript" src="js/admin/ectrain/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>培训名称：</th>
                        <td><input type="text" style="width:268px;height: 30px;" name="name" id="name"  class="input-text"/></td>
                        <td class="one"><div id="nameTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>培训类别：</th>
                        <td><select type="text" style="width:268px;height: 40px;" name="category" id="category"  class="input-text"/></td>
                        <td class="one"><div id="categoryTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">内容：</th>
                        <td colspan="2"><textarea style="width:500px;height:100px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>天数：</th>
                        <td><input type="text" style="width:268px;height: 30px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" name="dayNum" id="dayNum"  class="input-text"/></td>
                        <td class="one"><div id="dayNumTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>期数：</th>
                        <td><select type="text" style="width:268px;height: 40px;"  name="period" id="period" class="input-text"></td>
                        <td class="one"><div id="periodTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>人数：</th>
                        <td><input type="text"  style="width:268px;height: 30px;"  onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="peopleNum" id="peopleNum" class="input-text"></td>
                        <td class="one"><div id="peopleNumTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">报名时间：</th>
                        <td colspan="2"><input id="beginTime" name="beginTime" type="text" value=""  style="width:250px;height: 30px;"  class="date">
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
                        <input id="endTime" name="endTime" type="text" value=""  style="width:250px;height: 30px;"  class="date">
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
                        <td colspan="2"><input type="text" style="width:268px;height: 30px;"  name="target" id="target" class="input-text"></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>发布人：</th>
                        <td><input type="text" style="width:268px;height: 30px;"  name="publisher" id="publisher" class="input-text"></td>
                        <td class="one"><div id="publisherTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">培训开始时间：</th>
                        <td colspan="2"><input id="time" name="time" type="text" value=""  style="width:250px;height: 30px;"  class="date">
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
                    <tr onmouseout="bigPic()">
                        <th align="right">图片：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="thumbnailUrl" id="thumbnailUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">大图预览：</th>
                        <td class="pic_text4" colspan="2"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('ectrain_add').close();"/>
        </div>
    </div>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>
