<script type="text/javascript">
    var tag = "<?=$tag?>"

    if(tag == 'success'){
        var attachUrls = window.parent.$('#attachUrls').val();
        var attachNames = window.parent.$('#attachNames').val();
        if(attachUrls != ''){
            window.parent.$('#attachUrls').val( "<?=$fileArg['fileSaveUrl']?>");
            window.parent.$('#attachNames').val( "<?=$fileArg['fileName']?>");
        }else{
            window.parent.$('#attachUrls').val("<?=$fileArg['fileSaveUrl']?>");
            window.parent.$('#attachNames').val("<?=$fileArg['fileName']?>");
        }
    }
</script>
<script type="text/javascript" src="js/admin/pic/upload.js"></script>

<form id="uploadForm" name="form1" method="post" action="<?=yii::$app->urlManager->createUrl('pic/upload')?>" enctype="multipart/form-data">
    <input type="hidden" id="category" name="category"/>
    <input type="file" id="fileName" name="file" style="height:18px;border:1px #ff9900;width:250px;"/>
    <input type="button" class="buttonsave" onClick="uploadPic();"  value="上传"/>限制分辨率为300*190（宽*高），大小不超过2M！<div id="userPWDAgainTip"></div>
</form>