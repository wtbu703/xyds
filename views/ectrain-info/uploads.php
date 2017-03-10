

<script type="text/javascript">
var tag = "<?=$tag?>"

if(tag == 'success'){
    var signSheetUrl = window.parent.$('#signSheetUrl').val();
    var attachNames = window.parent.$('#attachNames').val();
    if(signSheetUrl != ''){
        window.parent.$('#signSheetUrl').val(signSheetUrl + ";<?=$fileArg['fileSaveUrl']?>");
        window.parent.$('#attachNames').val(attachNames + ";<?=$fileArg['fileName']?>");
    }else{
        window.parent.$('#signSheetUrl').val("<?=$fileArg['fileSaveUrl']?>");
        window.parent.$('#attachNames').val("<?=$fileArg['fileName']?>");
    }

}
</script>
<script type="text/javascript" src="js/admin/ectrain-info/upload.js"></script>

<form id="uploadForm" name="form1" method="post" action="<?=yii::$app->urlManager->createUrl('ectrain-info/uploads')?>" enctype="multipart/form-data">
    <input type="file" id="fileName" name="file" style="height:18px;border:1px #ff9900;width:250px;"/>
    <input type="button" class="buttonsave" onClick="uploadPic();"  value="上传"/><div id="userPWDAgainTip"></div>
</form>
