<?php
$this->title =  '修改视频';
?>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('video/updateone')?>";
    var url = "<?=substr($video->url,0,6)?>";
    $(function(){
        if(url == 'upload'){
            $('#videoUrl').hide();
        }else {
            $('#uploadVideo').hide();
        }
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
<script language="javascript" type="text/javascript" src="js/admin/video/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改视频</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="120px" align="right"><sub class="redstar">*</sub>来源类型：</th>
                            <td colspan="2"><select style='width:200px;height:25px; ' id="category"  name="category" class="input-text" onChange="getpush(this.value)">
                                    <?php if(substr($video->url,0,6) == 'upload'){?>
                                        <option name="category" value="本站" selected>本站</option>
                                        <option name="category"  value="外网" >外网</option>
                                    <?}else{?>
                                        <option name="category" value="本站" >本站</option>
                                        <option name="category"  value="外网" selected>外网</option>
                                    <?}?>
                                </select></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>类别：</th>
                            <td><select style="width:250px;" id="sign">
                                    <?foreach($sign as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $video->sign){?>
                                            <option name="sign" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="sign" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                            <td class="one"><div id="signTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>名字：</th>
                            <td colspan="2"><input type="text" id="name" value="<?=$video->name?>"/></td>
                            <input type="hidden" id="id"value="<?=$video->id?>" />
                        </tr>
                        <tr>
                            <th align="right">介&nbsp;绍&nbsp;：</th>
                            <td colspan="2"><textarea type="text" style="width:400px;height:200px;" name="content" id="content" value=""><?=$video->content?></textarea></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>来源：</th>
                            <td><input type="text" id="source"  class="input-text" style="width:250px;" value="<?=$video->source?>" /></td>
                            <td class="one"><div id="sourceTip"></div></td>
                        </tr>
                        <tr id="videoUrl">
                            <th align="right"><sub class="redstar">*</sub>视频链接：</th>
                            <td colspan="2"><input type="text" style="width:250px;" name="attachUrls" id="attachUrls" value="<?=$video->url?>" class="input-text"/></td>
                        </tr>

                        <tr id="uploadVideo">
                            <th align="right">修改视频：</th>
                            <td colspan="2">
                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('video/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">原始图片：</th>
                            <td colspan="2"><img src="<?=$video->picUrl?>" width="60%" /></td>
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
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('video_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>
