<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/3/1
 * Time: 18:09
 */
$this->title = '农村电子商务物流配送体系建设情况';
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
	var addUrl = "<?=Yii::$app->urlManager->createUrl('logistics-build/add')?>";
	var listallUrl  = "<?=Yii::$app->urlManager->createUrl('logistics-build/find-by-attri')?>";
</script>
<script type="text/javascript" src="js/admin/logistics-build/index.js"></script>

<div class="subnav" id="display" >
	<div class="content-menu ib-a blue line-x">
		<?php /*if($add){*/?>
			<a class="add fb" href="javascript:openadd();void(0);"><em>添加建设情况</em></a>
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
							日期：
							<input id="published" name="published" type="text" value="" class="date">
							<script type="text/javascript">
								Calendar.setup({
									weekNumbers: true,
									inputField : "published",
									trigger    : "published",
									dateFormat: "%Y-%m-%d",
									showTime: true,
									minuteStep: 1,
									onSelect   : function() {this.hide();}
								});
							</script>
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
		<iframe id="iframeId" name="iframeId" src="<?=Yii::$app->urlManager->createUrl('logistics-build/find-by-attri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
	</div>
</div>