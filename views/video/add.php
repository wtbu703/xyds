<?php
$this->title =  '添加视频';
?>

<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('video/findbyattri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('video/addone')?>";
</script>
<script type="text/javascript" src="js/admin/video/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">种&nbsp;类&nbsp;：</th>
                        <td><select style='width:250px;height:25px; ' id="sign"  name="sign" class="input-text"></select></td>
                    </tr>
                    <tr>
                        <th width="100">名&nbsp;字&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="name" id="name"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">时&nbsp;长&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="duration" id="duration"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">介&nbsp;绍&nbsp;：</th>
                        <td><textarea type="text" style="width:500px;height:200px;" name="content" id="content" ></textarea></td>
                    </tr>
                    <tr>
                        <th>来&nbsp;源&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="source" id="source"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>地&nbsp;址&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="url" id="url"  class="input-text"/></td>

                    </tr>
                    <tr>
                        <th>附&nbsp;件&nbsp;：</th>
                        <td>
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('video/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th>上传图片：</th>
                        <td>
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('video/uploads')?>"></iframe>
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
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('video_add').close();"/>
        </div>
    </div>
</div>
