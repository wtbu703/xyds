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
            var saveUrl = "<?=yii::$app->urlManager->createUrl('resource/add-one')?>";
            //var checkUrl = "<?=yii::$app->urlManager->createUrl('resource/check-one')?>";
            var listUrl = "<?=yii::$app->urlManager->createUrl('resource/find-by-attri')?>";
        </script>
        <script type="text/javascript" src="js/admin/resource/add.js"></script>
    </head>
    <body>
    <div class="pad-lr-10">
        <form action="<?=yii::$app->urlManager->createUrl('resource/add-one')?>" id="resourceForm" name="resourceForm" method="post" target="iframeId">
            <div class="pad_10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tr>
                            <th width="100">控制器名称</th>
                            <td><input type="text" style="width:370px;" name="tableName"  id="tableName" class="input-text"/></td>
                        </tr>
                    </table>
                </div>
                <div class="bk10"></div>
            </div>
            <!--列表-->
            <div class="table-list">
                <table id="modelTplTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th align="left">操作排序</th>
                        <th align="left">操作名称</th>
                        <th align="left">简介</th>
                        <th align="left">操作</th>
                    </tr>
                    </thead>
                    <tbody id="modelTplTB">

                    </tbody>
                </table>
                <div class="btn">
                    <!--  <label for="check_box">全选/取消</label>-->
                    <input type="button" class="buttonadd" name="dosubmit" value="增加" onclick="addrow()"/>
                    <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="add()"/>
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('resource_add').close();"/>
                </div>
            </div>
        </form>
    </div>

    </body>
</html>
<?php $this->endPage() ?>