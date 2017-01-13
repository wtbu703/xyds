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
        <link href="css/admin/table_form.css" rel="stylesheet" type="text/css">
        <!--自带弹框CSS-->
        <link href="css/admin/public.css" rel="stylesheet" type="text/css">
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

        <link rel="stylesheet" href="css/jquery.treeview.css" type="text/css" />
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
        <script type="text/javascript" src="js/jquery.treeview.js"></script>
        <style type="text/css">
            .filetree *{white-space:nowrap;}
            .filetree span.folder, .filetree span.file{display:auto;padding:1px 0 1px 16px;}
        </style>
        <script type="text/javascript">

            $(function(){
                $("#menu_tree").treeview({
                    control: "#treecontrol",
                    persist: "cookie",
                    cookieId: "treeview-black"
                });
            })
            function editOne(targetUrl){
                parent.document.getElementById('rightMain').src = targetUrl;
            }
            //打开添加页面
            function openadd(menuUpid,menuLevel,menuName){
                var _menuLevel = Number(menuLevel)+1;
                var redirect = "<?=Yii::$app->urlManager->createUrl('admin/findone')?>&uplevelMenu="+menuUpid+"&menuLevel="+_menuLevel+"&menuName="+encodeURIComponent(menuName);
                $.dialog({id:'menu_add'}).close();
                $.dialog.open(redirect, {
                    title: '添加菜单',
                    width: 650,
                    height:400,
                    lock: true,
                    border: false,
                    id: 'menu_add',
                    drag:true
                });
            }
        </script>
    </head>
    <body>
        <div class="bk10">

        </div>
        <div id="treecontrol">
            <span style="display:none">
                <a href="#"></a>
                <a href="#"></a>
            </span>
            <a href="#">
                <img src="images/minus.gif" />
                <img src="images/application_side_expand.png" />
                展开/收缩
            </a>
        </div>
        <ul class="filetree  treeview">
            <li class="collapsable">
                <div class="hitarea collapsable-hitarea"></div>
                <span>
                    <img src="images/icon/box-exclaim.gif" width="15" height="14"/>&nbsp;
                    <a href="javascript:openadd('','0','')">
                        添加一级菜单
                    </a>
                </span>
            </li>
        </ul>
        <ul id="menu_tree"  class="filetree" style="width:300px">
            <?php foreach ($menus as $key => $value){
                if(!strcasecmp($value->menuLevel,"1")){?>
                    <li>
                        <div>
                            <span class="folder">&nbsp;</span>
                            <span>
                                <a href="javascript:openadd('<?=$value->id ?>','<?=$value->menuLevel ?>','<?=$value->menuName ?>')">
                                    <img src="images/add_content.gif" title="添加下级">
                                </a>
                                <a href="javascript:editOne('<?= Yii::$app->urlManager->createUrl('admin/edit') ?>&menuId=<?= $value->id ?>')">
                                    <?=$value->menuName ?>
                                </a>
                            </span>
                        </div>

                    <?php foreach ($menus as $index => $val){
                        if(!strcasecmp($value->id,$val->upLevelMenu)){
                    ?>
                            <ul>
                                <li>
                                    <div>
                                        <span class="file">&nbsp;</span>
                                            <span>
                                                <a href="javascript:openadd('<?= $val->id ?>','<?= $val->menuLevel ?>','<?= $val->menuName ?>')">
                                                    <img src="images/add_content.gif" title="添加下级">
                                                </a>
                                                <a href="javascript:editOne('<?= Yii::$app->urlManager->createUrl('admin/edit') ?>&menuId=<?= $val->id ?>')">
                                                    <?= $val->menuName ?>
                                                </a>
                                            </span>
                                    </div>

                            <?php foreach ($menus as $third => $thirdMenu){
                                if (!strcasecmp($val->id, $thirdMenu->upLevelMenu)){
                                ?>
                                    <ul>
                                        <li>
                                            <div>
                                                <span class="file">&nbsp;</span>
                                                <span>
                                                    <a href="javascript:editOne('<?= Yii::$app->urlManager->createUrl('admin/edit') ?>&menuId=<?= $thirdMenu->id ?>')">
                                                        <?= $thirdMenu->menuName ?>
                                                    </a>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
        <?php
                                }
                            };?>
                                    </li>
                                </ul>
       <?php                 }
                    };?>
                        </li>
      <?php          }
            };
        ?>
        </ul>
    </body>
</html>
<?php $this->endPage() ?>

