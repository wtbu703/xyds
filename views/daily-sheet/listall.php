<script type="text/javascript">
    var findOneUrl = "<?=Yii::$app->urlManager->createUrl('daily-sheet/find-one')?>";
    var deleteOneUrlUrl = "<?=Yii::$app->urlManager->createUrl('daily-sheet/delete-one')?>";
    var deleteMoreUrl = "<?=Yii::$app->urlManager->createUrl('daily-sheet/delete-more')?>"
</script>
<script language="javascript" type="text/javascript" src="js/admin/daily-sheet/listall.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <div class="table-list">
        <table width="100%" cellspacing="0" id="dict_list">
            <thead>
	            <tr align="center">
	                <th width="80px" align="left"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</th>
		            <th width="30px">序号</th>
		            <th width="100px">报表日期</th>
		            <th width="100px">报表状态</th>
		            <th>操作</th>
	            </tr>
            </thead>
            <tbody>
            <?if(!is_null($dailySheets)){?>
	            <?php foreach ($dailySheets as $index => $val){?>
	                <tr align="center">
		                <td align="left"><input type="checkbox" id="id" name="id" value="<?=$val->id?>"/></td>
	                    <td><?=$index+$pages->page*$pages->pageSize+1?></td>
	                    <td><a href="javascript:detail('<?=$val->id?>','<?=$val->date?>')"><?=$val->date?></a></td>
	                    <td><?=$val->state?></td>
	                    <td>
	                        <a href="javascript:update('<?=$val->id?>','<?=$val->date?>')">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		                    <a href="javascript:deleteOne('<?=$val->id?>')">删除</a>
	                    </td>
	                </tr>
	            <?}?>
            <?}?>
            </tbody>
        </table>
        <div class="btn">
            <label for="check_box"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</label>
            <input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要删除吗？')) deleteMore();"/>
	        <input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要提交吗？')) submit();"/>
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
<form action="<?=Yii::$app->urlManager->createUrl('daily-sheet/find-by-attri')?>" method="get" id="pageForm">
    <input type="hidden" id="page" name="page" value="<?=$pages->page?>"/>
    <input type="hidden" name="r" value="daily-sheet/find-by-attri"/>
    <input type="hidden" id="pre-page" name="pre-page" value="<?=$pages->pageSize?>"/>
    <input type="hidden" id="date1" name="date1" value="<?=$para['date1']?>"/>
    <input type="hidden" id="date2" name="date2" value="<?=$para['date2']?>"/>
</form>
