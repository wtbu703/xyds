<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/18
 * Time: 18:41
 */
$this->title = '服务站点管理';
?>
<script type="text/javascript">
	window.top.$('#display_center_id').css('display','none');
	//iframe自适应高度
	function iFrameHeight() {
		var ifm= document.getElementById("iframeId");
		var subWeb = document.frames ? document.frames["iframeId"].document : ifm.contentDocument;
		if(ifm != null && subWeb != null) {
			ifm.height = subWeb.body.scrollHeight;
		}
	}
	var listdictUrl  = "<?=Yii::$app->urlManager->createUrl('dict/findall')?>";
	var addUrl = "<?=Yii::$app->urlManager->createUrl('service-site/add')?>";
	var listallUrl  = "<?=Yii::$app->urlManager->createUrl('service-site/find-by-attri')?>";
</script>
<script type="text/javascript" src="js/admin/service-site/index.js"></script>

<div class="subnav" id="display" >
	<div class="content-menu ib-a blue line-x">
		<?php /*if($add){*/?>
			<a class="add fb" href="javascript:openadd();void(0);"><em>添加服务站点</em></a>
		<?php /*}*/?>
		<?php /*if($excel){ */?><!--
			<a class="add fb" href="<?/*=yii::$app->urlManager->createUrl('adminmanage/excel')*/?>"><em>导出为Excel文件</em></a>
		--><?php /*}*/?>
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
							站点编码：
							<input id="code" name="code" type="text" value="" class="input-text" />
							站点名称：
							<input id="name" name="name" type="text" value="" class="input-text" />
							站点类型：
							<select id="type" name="type" style="width:140px;"></select>
							&nbsp;<input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询"/>
							<div class = "checkTip" style="float:right;margin-right:50%;color:red;">
							</div>
						</div>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</form>
	<div class="table-list">
		<iframe id="iframeId" name="iframeId" src="<?=Yii::$app->urlManager->createUrl('service-site/find-by-attri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
	</div>
</div>