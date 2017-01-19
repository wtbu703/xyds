<script type="text/javascript">
    var findOneUrl = "<?=Yii::$app->urlManager->createUrl('service-site/find-one')?>";
    var deleteOneUrl = "<?=Yii::$app->urlManager->createUrl('service-site/delete-one')?>";
    var deleteMoreUrl = "<?=Yii::$app->urlManager->createUrl('service-site/delete-more')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/service-site/listall.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <div class="table-list">
        <table width="100%" cellspacing="0">
            <thead>
	            <tr align="center">
	                <th width="80px" align="left"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</th>
		            <th width="30px">序号</th>
		            <th width="160px">站点编码</th>
		            <th width="160px">站点名称</th>
		            <th width="160px">站点类型</th>
		            <th>操作</th>
	            </tr>
            </thead>
            <tbody>
            <?if(!is_null($serviceSites)){?>
	            <?php foreach ($serviceSites as $index => $val){?>
	                <tr align="center">
	                    <td align="left"><input type="checkbox" id="id" name="id" value="<?=$val->id?>"/></td>
	                    <td><?=$index+$pages->page*$pages->pageSize+1?></td>
	                    <td><?=$val->code?></td>
	                    <td><a href="javascript:detail('<?=$val->id?>','<?=$val->name?>')"><?=$val->name?></a></td>
	                    <td><?=$val->countyType?></td>
	                    <td align="center">
	                        <?/*if($edit){*/?><a href="javascript:update('<?=$val->id?>','<?=$val->name?>')">修改</a>&nbsp;&nbsp;|<?/*}*/?>
		                    <?/*if($delete){*/?>&nbsp;&nbsp;<a href="javascript:deleteOne('<?=$val->id?>')">删除</a><?/*}*/?>
	                    </td>
	               </tr>
	            <?}?>
            <?}?>
            </tbody>
        </table>
        <div class="btn">
            <label for="check_box"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</label>
            <?/*if($delete){*/?>
            <input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要删除吗？')) deleteMore();"/>
            <?/*}*/?>
        </div>

	    <!-- 分页 -->
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
<form action="<?=Yii::$app->urlManager->createUrl('service-site/find-by-attri')?>" method="get" id="pageForm">
    <input type="hidden" id="page" name="page" value="<?=$pages->page?>"/>
    <input type="hidden"  name="r" value="service-site/find-by-attri"/>
    <input type="hidden" id="pre-page" name="pre-page" value="<?=$pages->pageSize?>"/>
    <input type="hidden" id="code" name="code" value="<?=$para['code']?>"/>
    <input type="hidden" id="name" name="name" value="<?=$para['name']?>"/>
    <input type="hidden" id="type" name="type" value="<?=$para['type']?>"/>
</form>