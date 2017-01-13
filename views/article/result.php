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
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript">
            var pageUrl = "<?=yii::$app->urlManager->createUrl('article/find-web-resource')?>";
            var detailUrl = "<?=yii::$app->urlManager->createUrl('article/view')?>";
            var addMoreUrl = "<?=yii::$app->urlManager->createUrl('article/add-more')?>";
        </script>
        <script language="javascript" type="text/javascript" src="js/admin/article/result.js" charset="utf-8"></script>
        <script language="javascript" type="text/javascript" src="js/page.js" charset="utf-8"></script>
    </head>
    <body>
        <div class="pad-lr-10">
            <div class="table-list">
                <table width="100%" cellspacing="0" id="user_list">
                    <thead id="dict_list_head">
                    <tr align="left">
                        <th width="80px"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</th><th width="30px">序号</th><th width="160px">标题</th><th width="160px">作者</th><th width="160px">时间</th>
                    </tr>
                    </thead>
                    <tbody id="user_list_body">
                    <?if(!is_null($articles)){?>
                        <?php foreach ($articles as $key => $value){?>
                        <tr align="left">
                            <td><input type="checkbox" id="id" name="id" value="<?=$value->id?>"/></td>
                            <td><?=$key+1?></td>
                            <td><a href="javascript:detail('<?=$value->id?>')"><?=$value->title?></a></td>
                            <td><?=$value->author?></td>
                            <td><?=$value->catchtime?></td>
                            <!--<td style="display:none"><?/*=$url_array[$key]*/?></td>
                            <td style="display:none"><?/*=$content_array[$key]*/?></td>-->
                       </tr>
                        <?}?>
                    <?}?>
                    </tbody>
                </table>
                <div class="btn">
                    <label for="check_box"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</label>
                    <input type="button" class="buttondel" name="dosubmit" value="添加" onclick="addMore();"/>
                </div>
            </div>
        </div>
    </body>
</html>
<!--<form action="<?/*=yii::$app->urlManager->createUrl('article/find-web-resource')*/?>" method="get" id="pageForm">
    <input type="hidden" id="page" name="page" value="<?/*=$pages->page*/?>"/>
    <input type="hidden"  name="r" value="article/find-web-resource"/>
    <input type="hidden" id="pre-page" name="pre-page" value="<?/*=$pages->pageSize*/?>"/>
    <input type="hidden" id="title" name="title" value="<?/*=$para['title']*/?>"/>
    <input type="hidden" id="author" name="truename" value="<?/*=$para['author']*/?>"/>
</form>-->
