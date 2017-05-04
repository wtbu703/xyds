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
    var addUrl = "<?=Yii::$app->urlManager->createUrl('resource/add')?>";
	var listallUrl = "<?=Yii::$app->urlManager->createUrl('resource/find-by-attri')?>";
</script>
<script type="text/javascript" src="js/admin/resource/list.js"></script>

<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x">
        <?php if($add){?>
        <a class="add fb" href="javascript:openadd();"><em>添加资源</em></a>
        <?php }?>
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
							控制器名：
							<input id="tableName" name="tableName" type="text" value="" class="input-text" />
							&nbsp;
							<input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询"/>
						</div>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</form>
	<div class="table-list">
		<iframe id="iframeId" name="iframeId" src="<?=Yii::$app->urlManager->createUrl('resource/find-by-attri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
	</div>
</div>