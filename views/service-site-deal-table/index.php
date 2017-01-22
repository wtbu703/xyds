<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/22
 * Time: 22:41
 */
?>
<script type="text/javascript">
	var findOneUrl = "<?=Yii::$app->urlManager->createUrl('service-site-deal-table/find-one')?>";
	var dealTableUrl = "<?=Yii::$app->urlManager->createUrl('service-site-deal-table/deal-table')?>";
</script>
<script type="text/javascript" src="js/admin/deal-table/index.js"></script>
<div class="subnav" id="display" >
	<div class="content-menu ib-a blue line-x">
		<a class="add fb" href="javascript:;"><em>填写日交易信息</em></a>
	</div>
</div>
<div class="pad-lr-10">
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr align="center">
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
						<td><?=$index+$pages->page*$pages->pageSize+1?></td>
						<td><?=htmlspecialchars($val->code)?></td>
						<td><a href="javascript:detail('<?=$val->id?>','<?=$val->name?>')"><?=htmlspecialchars($val->name)?></a></td>
						<td><?=$val->countyType?></td>
						<td>
							<a href="javascript:addDealTable('<?=$val['id']?>','<?=$val->name?>')">填写日交易信息</a>
						</td>
					</tr>
				<?}?>
			<?}?>
			</tbody>
		</table>
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
<form action="<?=yii::$app->urlManager->createUrl('service-site-deal-table/find-by-attri')?>" method="get" id="pageForm">
	<input type="hidden" id="page" name="page"/>
	<input type="hidden"  name="r" value="service-site-deal-table/find-by-attri"/>
	<input type="hidden" id="pre-page" name="pre-page" value="<?=$pages->pageSize?>"/>
</form>