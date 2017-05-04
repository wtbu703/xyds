<?php
$this->title =  '上传图片';
?>
<script type="text/javascript">
    var insertUrl = "<?=yii::$app->urlManager->createUrl('user/insert')?>";
    var tag = "<?=$tag?>";

    if(tag == 'success'){

        var picUrl = window.parent.$('#picUrl').val();
        if(picUrl != ''){
            window.parent.$('#picUrl').val(picUrl + ";<?=$fileArg['fileSaveUrl']?>");
        }else{
            window.parent.$('#picUrl').val("<?=$fileArg['fileSaveUrl']?>");

        }
    }
</script>
<script type="text/javascript" src="js/admin/article/uploads.js"></script>

<form id="uploadForm" name="form1" method="post" action="<?=yii::$app->urlManager->createUrl('article/uploads')?>" enctype="multipart/form-data">
    <input type="file" id="fileName" name="file" style="height:18px;border:1px #ff9900;width:220px;"/>
    <input type="button" class="buttonsave" onClick="uploadPic();"  value="上传"/> <span style="font-size: 6px;color: #7d8289;">限制分辨率为250*170（宽*高），大小不超过2M！</span><div id="productPWDAgainTip"></div>

</form>

