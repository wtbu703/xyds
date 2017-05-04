<script type="text/javascript">
	var deleteResourceUrl = "<?=yii::$app->urlManager->createUrl('resource/delete-one')?>";
	var deleteMoreUrl = "<?=yii::$app->urlManager->createUrl('resource/delete-more')?>";
</script>
<script type="text/javascript" src="js/admin/resource/listall.js"></script>
<div class="pad-lr-10">
	<div class="table-list">
		<table width="100%" cellspacing="0" id="role_list">
			<thead id="dict_list_head">
			<tr align="left">
				<th width="80px"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</th><th width="160px" align="center">控制器名</th><th width="160px" align="center">操作名</th><th width="160px" align="center">注释</th><th align="center">操作</th>
			</tr>
			</thead>
			<tbody id="role_list_body">
			<?if(!is_null($resources)){?>
				<?php foreach ($resources as $index => $val){?>
					<tr align="left">
						<td><input type="checkbox" id="id" name="id" value="<?=htmlspecialchars($val['id'])?>"/></td>
						<td align="center"><?=htmlspecialchars($val['tableName'])?></td>
						<td align="center"><?=htmlspecialchars($val['tableOpreate'])?></td>
						<td align="center"><?=htmlspecialchars($val['note'])?></td>
						<td align="center">
							<?if($delete){?>
								<a href="javascript:deleteResource('<?=$val['id']?>')">删除</a>
							<?}?>
						</td>
					</tr>
				<?}?>
			<?}?>
			</tbody>
		</table>
		<div class="btn">
			<label for="check_box"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</label>
			<?if($delete){?>
				<input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要删除吗？')) deleteMore();"/>
			<?}?>
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
<form action="<?=Yii::$app->urlManager->createUrl('resource/find-by-attri')?>" method="get" id="pageForm">
	<input type="hidden" id="page" name="page" value="<?=$pages->page?>"/>
	<input type="hidden"  name="r" value="resource/find-by-attri"/>
	<input type="hidden" id="pre-page" name="pre-page" value="<?=$pages->pageSize?>"/>
	<input type="hidden" id="tableName" name="tableName" value="<?=$para['tableName']?>"/>
</form>