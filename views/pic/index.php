<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/29
 * Time: 19:41
 */
$this->title = '图片管理';
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
    var addUrl = '<?=Yii::$app->urlManager->createUrl('pic/add')?>';
    var listallUrl = '<?=Yii::$app->urlManager->createUrl('pic/find-by-attri')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/pic/index.js" charset="utf-8"></script>
<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x">
        <a class="add fb" href="javascript:openadd();"><em>添加图片大类</em></a>
    </div>
</div>
<div class="pad-lr-10">
    <form action="" method="post" id="searchForm" name="searchForm" target="iframeId">
        <table width="100%" cellspacing="0" class="search-form">
            <tbody>
            <tr>
                <td>
	                <div class="explain-col"> 图片大类名称：
                        <input id="categoryName" name="categoryName" type="text" value="" class="input-text" />
                        &nbsp;<select id="categoryState" style='width:135px' name="categoryState"></select>
                        <input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询" />
                        <div class = "checkTip" style="float:right;margin-right:65%;color:red;">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="table-list">
        <iframe scrolling="auto" width="100%" height="450" id="iframeId" name="iframeId" frameborder="0" onLoad="iFrameHeight()" src="<?=Yii::$app->urlManager->createUrl('pic/find-by-attri')?>"></iframe>
    </div>
</div>