
<script type="text/javascript">
    var insertUrl = "<?=yii::$app->urlManager->createUrl('user/insert')?>";
    var tag = "<?=$tag?>";

    if(tag == 'success'){

        var picUrl = window.parent.$('#thumbnailUrl').val();
        if(picUrl != ''){
            window.parent.$('#thumbnailUrl').val("<?=$fileArg['fileSaveUrl']?>");
        }else{
            window.parent.$('#thumbnailUrl').val("<?=$fileArg['fileSaveUrl']?>");

        }
    }
</script>
<script type="text/javascript" src="js/admin/ectrain/upload.js"></script>

<form id="uploadForm" name="form1" method="post" action="<?=yii::$app->urlManager->createUrl('ectrain/upload')?>" enctype="multipart/form-data">
    <input type="file" id="fileName" name="file" style="height:18px;border:1px #ff9900;width:250px;"/>
    <input type="button" class="buttonsave" onClick="uploadPic();"  value="上传"/><div id="productPWDAgainTip"></div>
</form>
