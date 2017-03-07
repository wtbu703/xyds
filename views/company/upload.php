<?php
/**
 * Created by PhpStorm.
 * User: liuyao
 * Date: 2016/3/9
 * Time: 12:10
 */
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;


?>
<script type="text/javascript" src="js/jquery.min.js"></script>
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
<script type="text/javascript" src="js/admin/company/upload.js"></script>
    </head>
    <body>
        <form id="uploadForm" name="form1" method="post" action="<?=yii::$app->urlManager->createUrl('company/upload')?>" enctype="multipart/form-data">
            <input type="file" id="fileName" name="file" style="height:18px;border:1px #ff9900;width:250px;"/>
            <input type="button" class="buttonsave" onClick="uploadPic();"  value="上传"/><div id="companyPWDAgainTip"></div>
        </form>
    </body>
</html>

<?php $this->endPage() ?>