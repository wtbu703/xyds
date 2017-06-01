<?php
$this->title = '网店链接管理';
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
    var listdictUrl  = "<?=yii::$app->urlManager->createUrl('dict/findall')?>";
    var addUrl = "<?=yii::$app->urlManager->createUrl('company-shoplink/add')?>";
    var listallUrl  = "<?=yii::$app->urlManager->createUrl('company-shoplink/find-by-attri')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/company-shoplink/list.js" charset="utf-8"></script>
<div class="subnav" id="display" >
    <?php if($companyId != 'admin'&&$companyId != 'all'){?>
        <div class="content-menu ib-a blue line-x">
            <a class="add fb" href="javascript:openadd();"><em>添加网店链接</em></a>
        </div>
    <?}?>
</div>

<div class="pad-lr-10">
    <form name="searchform" id="searchform" action="" method="post" target="iframeId">
        <table width="100%" cellspacing="0" class="search-form">
            <tbody>
            <tr>
                <td>
                    <div class="explain-col">
                        <div>
                            网店名称：
                            <input id="shopName" name="shopName" type="text" value="" class="input-text" />
                            网店平台：
                            <select id="platform" style='width:175px' name="platform"></select>
                            &nbsp;<input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询"/>
                            <div class = "checkTip" style="float:right;margin-right:40%;color:red;">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="table-list">
        <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('company-shoplink/find-by-attri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
    </div>
</div>
