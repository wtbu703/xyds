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
            window.top.$('#display_center_id').css('display','none');
            var getdictdetailUrl = "<?=yii::$app->urlManager->createUrl('dict/findone')?>";
            var editUrl = "<?=yii::$app->urlManager->createUrl('dict/update')?>";
            var deldictUrl = "<?=yii::$app->urlManager->createUrl('dict/deleteone')?>"
            var deldictallUrl = "<?=yii::$app->urlManager->createUrl('dict/delelemore')?>"
        </script>
        <script language="javascript" type="text/javascript" src="js/admin/dict/listall.js" charset="utf-8"></script>
        <script language="javascript" type="text/javascript" src="js/page.js" charset="utf-8"></script>
    </head>
    <body>
        <div class="pad-lr-10">
            <div class="table-list">
                <table width="100%" cellspacing="0" id="dict_list">
                    <thead id="dict_list_head">
                    <tr align="left">
                        <th width="80px"><input type="checkbox" id='check_box' onclick="selectall('dictCode')"/>全选/取消</th><th width="30px">序号</th><th width="220px">字典标识</th><th width="160px">字典名称</th><th width="80px" align="center">字典状态</th><th align="center">操作</th>
                    </tr>
                    </thead>
                    <tbody id="dict_list_body">
                    <?if(!is_null($dicts)){?>
                    <?php foreach ($dicts as $index => $val){?>
                        <tr align="left">
                            <td><input type="checkbox" id="dictCode" name="dictCode" value="<?=$val->dictCode?>"/></td>
                            <td><?=$index+$pages->page*$pages->pageSize+1?></td>
                            <td><a href="javascript:detail('<?=$val->dictCode?>','<?=$val->dictName?>')"><?=$val->dictCode?></a></td>
                            <td><?=$val->dictName?></td>
                            <td align="center"><?=$val->state?></td>
                            <td align="center">
                                <?if($edit){?><a href="javascript:openedit('<?=$val->dictCode?>','<?=$val->dictName?>')">修改</a>&nbsp;&nbsp;<?}?>|<?if($delete){?>&nbsp;&nbsp;<a href="javascript:deleteDict('<?=$val->dictCode?>')">删除</a><?}?>
                            </td>
                        </tr>
                    <?}?>
                    <?}?>
                    </tbody>
                </table>
                <div class="btn">
                    <label for="check_box"><input type="checkbox" id='check_box' onclick="selectall('dictCode')"/>全选/取消</label>
                    <?if($delete){?><input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要删除吗？')) delopt();"/><?}?>
                </div>
                <div id="pages">
                    <a><?=$pages->totalCount?>条/<?=$pages->pageCount?>页</a>
                    <input type="hidden" value="<?=$pages->page?>" id="curPage"/><!--当前页-->
                    <input type="hidden" value="<?=$pages->pageCount?>" id="pageCount"/><!--总页数-->
                    <input type="hidden" value="<?=$pages->pageSize?>" id="pageSize"/><!--每页显示数-->
                    <?if($pages->page>0){?>
                        <!-- 判断是否不是第一页 -->
                        <a id="firstPageid" href="javascript:page('1')">首页</a>
                        <a id="supPageId" href="javascript:page('2')">上一页</a>
                    <?}?>
                    <?=$pages->page+1?>
                    <?if($pages->page<$pages->pageCount-1){?>
                        <!-- 判断如果不是最后一页 -->
                        <a id="nextPageid" href="javascript:page('3')">下一页</a>
                        <a id="lastPageid" href="javascript:page('4')" class="a1">尾页</a>
                    <?}?>
                    <input type="text" size="2" class="input-text" value="<?=$pages->page+1?>" id="goPage"/><a href="javascript:page('0')">GO</a>
                </div>
            </div>
        </div>
    </body>
</html>
<form action="<?=yii::$app->urlManager->createUrl('dict/findbyattri')?>" method="get" id="pageForm">
    <input type="hidden" id="page" name="page"/>
    <input type="hidden"  name="r" value="dict/findbyattri"/>
    <input type="hidden" id="pre-page" name="pre-page" value="<?=$pages->pageSize?>"/>
    <input type="hidden" id="dictName" name="dictName" value="<?=$para['dictName']?>"/>
    <input type="hidden" id="state" name="state" value="<?=$para['state']?>"/>
</form>
