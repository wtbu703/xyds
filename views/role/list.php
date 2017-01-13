<?php

use yii\helpers\Html;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?><!--生成一个替换字符，表示css和js的引用代码在这里显示-->

    <!--核心CSS-->
    <link href="css/admin/reset.css" rel="stylesheet" type="text/css">
    <link href="css/admin/system.css" rel="stylesheet" type="text/css">
    <link href="css/admin/public.css" rel="stylesheet" type="text/css">
    <link href="css/admin/table_form.css" rel="stylesheet" type="text/css">
    <!--TAB样式-->
    <link href="css/tabpanel/core.css" rel="stylesheet" type="text/css">
    <link href="css/tabpanel/TabPanel.css" rel="stylesheet" type="text/css">
    <link href="css/tabpanel/Toolbar.css" rel="stylesheet" type="text/css">
    <link href="css/tabpanel/WindowPanel.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <!--弹窗-->
    <script type="text/javascript" src="js/dialog/dialog.js"></script>
    <script type="text/javascript" src="js/admin/styleswitch.js"></script>
    <script type="text/javascript" src="js/admin/hotkeys.js"></script>
    <script type="text/javascript" src="js/admin/jquery.sGallery.js"></script>
    <!--表单验证-->
    <script language="javascript" type="text/javascript" src="js/admin/formvalidatorregex.js" charset="utf-8"></script>
    <script language="javascript" type="text/javascript" src="js/admin/formvalidator.js" charset="utf-8"></script>
    <!--TAB JS-->
    <script type="text/javascript" src="js/tabpanel/Fader.js"></script>
    <script type="text/javascript" src="js/tabpanel/TabPanel.js"></script>
    <script type="text/javascript" src="js/tabpanel/Math.uuid.js"></script>
    <script type="text/javascript" src="js/tabpanel/Toolbar.js"></script>
    <script type="text/javascript" src="js/tabpanel/WindowPanel.js"></script>
    <script type="text/javascript" src="js/tabpanel/Drag.js"></script>
    <!--弹出图片-->
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <script type="text/javascript">
            window.top.$('#display_center_id').css('display','none');
            //iframe自适应高度
            function iFrameHeight() {
                var ifm= document.getElementById("iframeId");
                var subWeb = document.frames ? document.frames["iframeId"].document : ifm.contentDocument;
                if(ifm != null && subWeb != null) {
                    ifm.height = subWeb.body.scrollHeight;
                }
            }
            var listdictUrl  = "<?=yii::$app->urlManager->createUrl('dict/findall')?>";
            var addUrl = "<?=yii::$app->urlManager->createUrl('role/add')?>";
            var listallUrl  = "<?=yii::$app->urlManager->createUrl('role/find-all')?>";
        </script>
        <script type="text/javascript" src="js/admin/role/list.js"></script>
    </head>
    <body>
        <div class="subnav" id="display" >
            <div class="content-menu ib-a blue line-x">
                <?if($add){?>
                <a class="add fb" href="javascript:openadd();void(0);"><em>添加角色</em></a>
                <?}?>
                <!--<a class="add fb" href="<?/*=yii::$app->urlManager->createUrl('role/excel')*/?>"><em>导出为Excel文件</em></a>-->
            </div>
        </div>
        <div class="pad-lr-10">
            <div class="table-list">
                <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('role/find-all')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
            </div>
        </div>
    </body>
</html>