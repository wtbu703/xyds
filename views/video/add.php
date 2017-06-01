<?php
$this->title =  '添加视频';
?>


<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('video/findbyattri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('video/addone')?>";
    $(function(){
        //$('#uploadVideo').hide();
        $('#videoUrl').hide();
    })
    function getpush(category) {
        if (category == '本站') {
            $('#uploadVideo').show();
            $('#videoUrl').hide();
        }
        else {

            $('#videoUrl').show();
            $('#uploadVideo').hide();
        }
    }
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
</script>
<script type="text/javascript" src="js/admin/video/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="120px" align="right"><sub class="redstar">*</sub>来源类型：</th>
                        <td><select style='width:250px;height:25px; ' id="category"  name="category" class="input-text" onChange="getpush(this.value)">
                                <option name="category" value="本站" selected>本站</option>
                                <option name="category"  value="外网" >外网</option>
                            </select></td>
                        <td class="one"><div id="categoryTip"></div></td>
                    </tr>
                    <tr>
                        <th width="100" align="right"><sub class="redstar">*</sub>类&nbsp;别&nbsp;：</th>
                        <td><select style='width:250px;height:25px; ' id="sign"  name="sign" class="input-text"></select></td>
                        <td class="one"><div id="signTip"></div></td>
                    </tr>
                    <tr>
                        <th width="100" align="right"><sub class="redstar">*</sub>名&nbsp;字&nbsp;：</th>
                        <td colspan="2"><input type="text" style="width:250px;" name="name" id="name"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">介&nbsp;绍&nbsp;：</th>
                        <td  colspan="2"><textarea type="text" style="width:400px;height:200px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>来&nbsp;源&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="source" id="source"  class="input-text"/></td>
                        <td class="one"><div id="sourceTip"></div></td>
                    </tr>
                    <tr id="videoUrl">
                        <th align="right"><sub class="redstar">*</sub>视频链接：</th>
                        <td colspan="2"><input type="text" style="width:250px;" name="attachUrls" id="attachUrls"  class="input-text"/></td>
                    </tr>

                    <tr id="uploadVideo">
                        <th align="right"><sub class="redstar">*</sub>上传视频：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('video/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr onmouseout="pic()">
                        <th align="right">上传图片：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('video/uploads')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">图片预览：</th>
                        <td class="pic_text" colspan="2"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('video_add').close();"/>
        </div>
    </div>
</div>


