<?php
$this->title =  '文章';
?>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
    var pageUrl = "<?=yii::$app->urlManager->createUrl('article/find-web-resource')?>";
    var detailUrl = "<?=yii::$app->urlManager->createUrl('article/view')?>";
    var addMoreUrl = "<?=yii::$app->urlManager->createUrl('article/add-more')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/article/result.js" charset="utf-8"></script>
<script language="javascript" type="text/javascript" src="js/page.js" charset="utf-8"></script>

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

<!--<form action="<?/*=yii::$app->urlManager->createUrl('article/find-web-resource')*/?>" method="get" id="pageForm">
    <input type="hidden" id="page" name="page" value="<?/*=$pages->page*/?>"/>
    <input type="hidden"  name="r" value="article/find-web-resource"/>
    <input type="hidden" id="pre-page" name="pre-page" value="<?/*=$pages->pageSize*/?>"/>
    <input type="hidden" id="title" name="title" value="<?/*=$para['title']*/?>"/>
    <input type="hidden" id="author" name="truename" value="<?/*=$para['author']*/?>"/>
</form>-->
