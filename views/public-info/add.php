<?php
$this->title = '添加信息';
?>

<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('public-info/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('public-info/add-one')?>";

    function get_status(){
        var a;
        var timeText = $('.time_text');
        a = document.myform.state.value;
        <?foreach($state as $key => $val){?>
        if(a == <?=$val->dictItemCode?>){
            a = "<?=$val->dictItemName?>";
        }
        <?}?>
        a = a+'时间：';
        timeText.html(a);
    }
</script>
<script type="text/javascript" src="js/admin/public-info/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right"><sub class="redstar">*</sub>标题：</th>
                        <td><input type="text" style="width:250px;" name="title" id="title"  class="input-text"/></td>
                        <td class="one"><div id="titleTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>作者：</th>
                        <td><input type="text" style="width:250px;" name="author" id="author"  class="input-text"/></td>
                        <td class="one"><div id="authorTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">内容：</th>
                        <td colspan="2"><textarea style="width:500px;height:100px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>类别：</th>
                        <td><select type="text" style="width:250px;height:30px;" name="category" id="category"  class="input-text"></select></td>
                        <td class="one"><div id="categoryTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right">状态：</th>
                        <td><select style="width:270px;" id="state" onmouseout="get_status()"></select></td>
                        <td class="one"><div id="stateTip"></div></td>
                    </tr>
                    <tr>
                        <th class="time_text"  align="right"></th>
                        <td colspan="2"><input id="datetime" name="datetime" type="text" value="" class="date">
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
                        <th align="right">附件：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('public-info/upload')?>"></iframe>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('info_add').close();"/>
        </div>
    </div>
</div>
</br></br></br>
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>
