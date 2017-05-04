
<script type="text/javascript">
    var insertUrl = "<?=yii::$app->urlManager->createUrl('user/insert')?>";
    var tag = "<?=$tag?>"

    if(tag == 'success'){

        var picUrl = window.parent.$('#picUrl').val();
        if(picUrl != ''){
            window.parent.$('#picUrl').val(picUrl + ";<?=$fileArg['fileSaveUrl']?>");
        }else{
            window.parent.$('#picUrl').val("<?=$fileArg['fileSaveUrl']?>");

        }
    }
</script>
<script type="text/javascript" src="js/admin/company-product/upload.js"></script>

<form id="uploadForm" name="form1" method="post" action="<?=yii::$app->urlManager->createUrl('company-product/upload')?>" enctype="multipart/form-data">
    <input type="file" id="fileName" name="file" style="height:18px;border:1px #ff9900;width:250px;"/>
    <input type="button" class="buttonsave" onClick="uploadPic();"  value="上传"/>限制分辨率为290*190（宽*高），大小不超过2M！<div id="productPWDAgainTip"></div>
</form>

