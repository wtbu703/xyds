<?php
use yii\helpers\Html;
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
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
        <!--公共函数-->
        <script type="text/javascript" src="js/common.js"></script>
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
            var addUrl = "<?=yii::$app->urlManager->createUrl('adminmanage/add')?>";
            var listallUrl  = "<?=yii::$app->urlManager->createUrl('adminmanage/findbyattri')?>";
        </script>
        <script type="text/javascript" src="js/admin/admin/list.js"></script>
    </head>
    <body>
        <div class="subnav" id="display" >
            <div class="content-menu ib-a blue line-x">
                <?php if($add){?>
                <a class="add fb" href="javascript:openadd();void(0);"><em>添加管理员</em></a>
                <?php }?>
                <?php if($excel){ ?>
                <a class="add fb" href="<?=yii::$app->urlManager->createUrl('adminmanage/excel')?>"><em>导出为Excel文件</em></a>
                <?php }?>
            </div>
        </div>
        <div class="pad-lr-10">
            <form name="searchform" id="searchform" action="" method="post" target="iframeId">
                <table width="100%" cellspacing="0" class="search-form">
                    <tbody>
                    <tr>
                        <td>
                            <div class="explain-col">
                                <div>
                                    用户名：
                                    <input id="username" name="username" type="text" value="" class="input-text" />
                                    真实姓名：
                                    <input id="truename" type="text" name="truename" value="" class="input-text" />
                                    状态：
                                    <select name="state" id="state" style="width:140px;"></select>
                                    &nbsp;<input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询"/>
                                    <div class = "checkTip" style="float:right;margin-right:50%;color:red;">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            <div class="table-list">
                <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('adminmanage/findbyattri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
            </div>
        </div>
    </body>
</html>