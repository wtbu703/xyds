<?php
$this->title = '培训报名管理';
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
    var excelAllUrl = "<?=Yii::$app->urlManager->createUrl('ectrain-enter/excel-all')?>";
    var listallUrl  = "<?=yii::$app->urlManager->createUrl('ectrain-enter/find-by-attri')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/ectrain-enter/list.js" charset="utf-8"></script>
<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x">
        <a class="add fb" href="javascript:excelAll('<?=$id?>');"><em>全部导出到Excel</em></a>
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
                            姓名：
                            <input id="truename" name="truename" type="text" value="" class="input-text" />
                            &nbsp;
                            状态：
                            <select id="state" name="state" style="height: 25px;" class="input-text"></select>
                            &nbsp;<input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="查询"/>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="table-list">
        <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('ectrain-enter/find-by-attri')?>&trainId=<?=$id?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
    </div>
</div>
