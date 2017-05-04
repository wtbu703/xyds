<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/31
 * Time: 19:41
 */
$this->title = '日报表管理';
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
    var listallUrl = '<?=Yii::$app->urlManager->createUrl('daily-sheet/find-by-attri')?>';
	var uploadExcelUrl = '<?=Yii::$app->urlManager->createUrl('daily-sheet/upload-excel')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/daily-sheet/index.js" charset="utf-8"></script>
<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x">
        <a class="add fb" href="javascript:uploadExcel();"><em>上传日报表</em></a>
    </div>
</div>
<div class="pad-lr-10">
    <form action="" method="post" id="searchForm" name="searchForm" target="iframeId">
        <table width="100%" cellspacing="0" class="search-form">
            <tbody>
            <tr>
                <td>
	                <div class="explain-col">
		                时间：
		                <input id="date1" name="date1" type="text" value="" class="date">
		                <script type="text/javascript">
			                Calendar.setup({
				                weekNumbers: true,
				                inputField : "date1",
				                trigger    : "date1",
				                dateFormat: "%Y-%m-%d",
				                showTime: true,
				                minuteStep: 1,
				                onSelect   : function() {this.hide();}
			                });
		                </script>
		                &nbsp;至&nbsp;&nbsp;
		                <input id="date2" name="date2" type="text" value="" class="date">
		                <script type="text/javascript">
			                Calendar.setup({
				                weekNumbers: true,
				                inputField : "date2",
				                trigger    : "date2",
				                dateFormat: "%Y-%m-%d",
				                showTime: true,
				                minuteStep: 1,
				                onSelect   : function() {this.hide();}
			                });
		                </script>
                        <input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询" />
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="table-list">
        <iframe scrolling="auto" width="100%" height="450" id="iframeId" name="iframeId" frameborder="0" onLoad="iFrameHeight()" src="<?=Yii::$app->urlManager->createUrl('daily-sheet/find-by-attri')?>"></iframe>
    </div>
</div>