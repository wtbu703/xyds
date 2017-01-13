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

    <link rel="stylesheet" href="css/jquery.treeview.css" type="text/css" />
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery.treeview.js"></script>
    <style type="text/css">
        .filetree *{white-space:nowrap;}
        .filetree span.folder, .filetree span.file{display:auto;padding:1px 0 1px 16px;}
    </style>

    <script type="text/javascript">
        var sendmenuUrl  = "<?=yii::$app->urlManager->createUrl('role/add-menu-role')?>";
        window.top.$('#display_center_id').css('display','none');
        var menuIds = "<?=$menuIds?>";
        var roleId = "<?=$roleId?>";
    </script>
    <script type="text/javascript" src="js/admin/role/accesscontrol.js"></script>
</head>
<body>
    <div class="subnav" id="display1" >
        <div class="content-menu ib-a blue line-x">
            <a class="add fb" href="javascript:;"><em>分配角色权限</em></a>
            <a class="add fb" href="<?=yii::$app->urlManager->createUrl('role/list')?>"><em>返回</em></a>
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
                                角色名称：<?=$rolename?><input type="hidden" id="<?=$roleId?>" value="<?=$roleId?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <div class="table-list">
            <table border="0" width="100%" cellspacing="0" id="menulist">
                <div class="bk10"></div>
                <div id="treecontrol">
                    <span style="display:none">
                        <a href="#"></a>
                        <a href="#"></a>
                    </span>
                    <a href="#">
                        <img src="images/minus.gif" />
                        <img src="images/application_side_expand.png" /> 展开/收缩</a>
                </div>
                <ul id="menu_tree" class="filetree" style="width:300px">
                    <!-- 第一级 -->
                    <?php foreach ($menus as $key => $value){
                        if(!strcasecmp($value->menuLevel,"1")){?>
                        <li>
                            <div>
                                <span class="folder">&nbsp;</span>
                                <span>
                                    <input type="checkbox" id="<?=$value->id?>" value="<?=$value->id?>" name="menuId" onclick="selectMenu('<?=$value->id?>')"/><?=$value->menuName?>
                                </span>
                            </div>
                            <!-- 第二级 -->
                            <?php foreach ($menus as $index => $val){
                                if(!strcasecmp($value->id,$val->upLevelMenu)){?>
                                <ul>
                                    <li>
                                        <div>
                                            <span class="file">&nbsp;</span>
                                            <span><input type="checkbox" id="<?=$value->id?><?=$val->id?>" value="<?=$val->id?>" name="menuId" onclick="selectMenu('<?=$value->id?><?=$val->id?>')"/><?=$val->menuName?>
                                            </span>
                                        </div>
                                        <!-- 第三级 -->
                                        <?php foreach ($menus as $third => $thirdMenu){
                                            if (!strcasecmp($val->id, $thirdMenu->upLevelMenu)){?>
                                            <ul>
                                                <li>
                                                    <div>
                                                        <span class="file">&nbsp;</span>
                                                        <span><input type="checkbox" id="<?=$value->id?><?=$val->id?><?=$thirdMenu->id?>" value="<?=$thirdMenu->id?>" name="menuId" onclick="selectMenu('<?=$value->id?><?=$val->id?><?=$thirdMenu->id?>')"/><?=$thirdMenu->menuName?>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?}}?>
                                    </li>
                                </ul>
                            <?}}?>
                        </li>
                   <?}}?>
                </ul>
            </table>
            <div class="btn">
                <label for="check_box">
                    <a href="#" onclick="javascript:$('input[type=checkbox]').attr('checked', true)">全选</a>/
                    <a href="#" onclick="javascript:$('input[type=checkbox]').attr('checked', false)">取消</a>
                </label>
                <input type="button" class="buttondel" name="dosubmit" value="确定" onclick="sendMenu()"/>
                &nbsp; &nbsp;
                <input type="button" class="buttondel" name="dosubmit" value="返回" onclick="window.location.href='<?=yii::$app->urlManager->createUrl('role/list')?>';"/>
            </div>
        </div>
    </div>
</body>
</html>
<?php $this->endPage() ?>

