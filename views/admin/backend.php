<?php

use yii\helpers\Html;

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="off">
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

        <script type="text/javascript" language="javascript">
            var listUrl = "<?= Yii::$app->urlManager->createUrl('admin/list')?>";
            var changepwdUrl = "<?= Yii::$app->urlManager->createUrl('admin/changepwd')?>";
            var lockUrl = "<?= Yii::$app->urlManager->createUrl('admin/lock')?>";
            var unlockUrl = "<?= Yii::$app->urlManager->createUrl('admin/unlock')?>";
            $(function(){
                $("#top_menu li:first a").click();
                $(".hiddenUl").each(function(){
                    $('.hiddenUl').hide();
                });

                $(".f12").each(function(){
                    var ul = $(this).next();
                    $(this).click(
                        function(){
                            if(ul.is(':visible')){
                                ul.hide();
                                $(this).find("span").removeClass('on');
                            }else{
                                ul.show();
                                $(this).find("span").addClass('on');
                            }
                        })
                });
            });
        </script>
        <script type="text/javascript" src="js/admin/index.js"></script>
        <script type="text/javascript" src="js/admin/changepwd.js"></script>
    </head>
    <body id="_body" scroll="no">
    <div id="main">
        <div id="fullbg"></div>
        <div id="dialog">
            <div class="pad-lr-10">
                <form id="myform" action="" method="post">
                    <div class="pad_10">
                        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                            <br/>
                            <br/>
                            <table width="100%" cellspacing="0" class="table_form contentWrap">
                                <tr>
                                    <th width="100">用户名：</th>
                                    <td id="userName">
                                        <?=Yii::$app->session['username']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>原始密码：</th>
                                    <td><input type="password" style="width:200px;" id="oldPWD" class="input-text"/></td>
                                </tr>
                                <tr>
                                    <th>新密码：</th>
                                    <td><input type="password" style="width:200px;" name="password" id="newPWD" value="" class="input-text"/></td>
                                </tr>
                                <tr>
                                    <th>确认新密码：</th>
                                    <td><input type="password" style="width:200px;" id="newPWDAgain" value="" class="input-text"/></td>
                                </tr>
                            </table>
                        </div>
                        <div class="bk10"></div>
                        <div class="rightbtn">
                            <input type="button" value="确定" name="dosubmit" onclick="resetPWD()" />
                            <input type="button" value="关闭" name="dosubmit" onclick="closeBg();" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->beginBody() ?>
    <header>
        <div id="dvLockScreen" class="ScreenLock" style="display:none">
            <div id="dvLockScreenWin" class="inputpwd">
                <h5><b class="ico ico-info"></b><span id="lock_tips">锁屏状态，请输入密码解锁</span></h5>
                <div class="input">
                    <label class="lb">密码：</label>
                    <input name="username" type="hidden" id="username" value="<?=Yii::$app->session['username']?>"/>
                    <input name="password" type="password" id="lock_password" class="input-text" size="18" />
                    <input type="button" class="submit" value="&nbsp;" name="dosubmit" onclick="unscreenlock();return false;" />
                </div>
            </div>
        </div>
        <div class="header">
            <div class="logo lf"><span class="invisible">后台管理系统</span></div>
            <div class="rt">
                <div class="tab_style white cut_line text-r"><a href="javascript:;" onclick="lock_screen();"><img src="images/icon/lockscreen.png" /> 锁屏</a>
                    <ul id="Skin">
                        <li class="s1 styleswitch" rel="styles1"></li>
                        <li class="s2 styleswitch" rel="styles2"></li>
                        <li class="s3 styleswitch" rel="styles3"></li>
                        <li class="s4 styleswitch" rel="styles4"></li>
                    </ul>
                </div>
                <div class="style_but"></div>
            </div>
            <div class="col-auto" style="overflow: visible">
                <div class="log white cut_line">
                    您好！<?=Yii::$app->session['username']?>  [<?=Yii::$app->session['truename']?>]<span>|</span><a href="javascript:showBg();">[修改密码]</a><span>|</span><a href="<?=Yii::$app->urlManager->createUrl('admin/logout')?>">[退出]</a><span>|</span><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>" target="_blank">[前台主页]</a>
                </div>
                <input type="hidden" value="${sessionScope.SITE.siteName }" id="defaultSite" />
                <ul class="nav white" id="top_menu" name="top_menu">
                    <!-- 一级菜单 -->
                    <?php foreach ($models as $key => $value){
                        if(!strcasecmp($value->menuLevel,"1")){?>
                            <li id='_M<?=$value->id ?>' class='on top_menu'><a onclick="_M('<?=$value->id ?>','<?=$value->menuName ?>','<?= Yii::$app->urlManager->createUrl('admin/main')?>','<?= Yii::$app->urlManager->createUrl('admin/menu')?>')" hidefocus="true" style="outline:none;"><?=$value->menuName ?></a></li>
                        <?php } }?>
                </ul>
            </div>
        </div>
    </header>
    <div id="content">
        <div class="col-left left_menu">
            <div id="leftMain">

            </div>
            <a href="javascript:;" id="openClose" style="outline-style: none; outline-color: invert; outline-width: medium;" hideFocus="hidefocus" class="open" title="展开与关闭"><span class="hidden">展开</span></a>
        </div>
        <div class="col-1 lf cat-menu" id="display_center_id" style="display:none" height="100%">
            <div class="content">
                <!--栏目管理树位置-->
                <iframe name="center_frame" id="center_frame"  src="" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
            </div>
        </div>
        <div class="col-auto mr8">
            <div class="crumbs">
                <!--<div class="shortcut cu-span"></div>-->
                当前位置：<span id="current_pos"></span></div>
            <div class="col-1">
                <div class="content" style="position:relative; overflow:hidden">
                    <div class="tabpanel_content">
                        <iframe class="rightMain" id="rightMain"  src="<?= Yii::$app->urlManager->createUrl('admin/main')?>" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <ul class="tab-web-panel hidden" style="position:absolute; z-index:999; background:#fff">
    </ul>

    <footer>

    </footer>

    </body>
    </html>
<?php $this->endPage() ?>