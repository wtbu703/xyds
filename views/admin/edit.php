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
    <script>
        var saveUrl = "<?=yii::$app->urlManager->createUrl('admin/updateone')?>";
        var deleteUrl = "<?=yii::$app->urlManager->createUrl('admin/deleteone')?>";
        var treeUrl =  '<?= Yii::$app->urlManager->createUrl('admin/tree')?>';
    </script>
    <script language="javascript" type="text/javascript" src="js/admin/edit.js" charset="utf-8"></script>
</head>
<body id="_body" scroll="no">
    <div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="center_frame">
        <div class="pad-10">
            <div class="col-tab">
                <ul class="tabBut cu-li">
                    <li id="tab_setting_1" class="on" onclick="">菜单信息</li>
                </ul>
                <div id="div_setting_1" class="contentList pad-10">
                    <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                        <table width="90%" cellspacing="0" class="table_form contentWrap">
                            <tbody>
                            <tr>
                                <th width="100">菜单级别</th>
                                <td><div id="menuLev"><?=$menu->menuLevel?></div></td>
                                <input type="hidden" id="id" value="<?=$menu->id?>" />
                            </tr>
                            <tr>
                                <th width="100">菜单名称</th>
                                <td><input type="text" id="menuName"  class="input-text" style="width:270px;" value="<?=$menu->menuName?>" /></td>
                            </tr>
                            <tr>
                                <th width="100">菜单URL</th>
                                <td><input type="text" id="menuUrl"  class="input-text" style="width:270px;" value="<?=$menu->menuUrl?>" /></td>
                            </tr>
                            <tr>
                                <th width="100">菜单状态</th>
                                <td>
                                    <select style="width:270px;" id="state">
                                        <option name="state" value="0" <?if($menu->state =='0')?> selected>否</option>
                                        <option name="state" value="1" <?if($menu->state =='1')?> selected>是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="100">排序</th>
                                <td><input type="text" id="orderBy" class="input-text" style="width:270px;" value="<?=$menu->orderBy?>"/></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bk10"></div>
                    <div class="rightbtn">
                        <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="修改" onclick="editMenu()"/>
                        &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要删除吗？')) del('<?=$menu->id?>')"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</body>
</html>