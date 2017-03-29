<?php
$this->title =  '视频列表';
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
    var addUrl = "<?=yii::$app->urlManager->createUrl('video/add')?>";
    var listallUrl  = "<?=yii::$app->urlManager->createUrl('video/findbyattri')?>";
</script>
<script type="text/javascript" src="js/admin/video/list.js"></script>

<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x"> <a class="add fb" href="javascript:openadd();void(0);"><em>添加视频</em></a> </div>
</div>
<div class="pad-lr-10">
    <form name="searchform" id="searchform" action="" method="post" target="iframeId">
        <table width="100%" cellspacing="0" class="search-form">
            <tbody>
            <tr>
                <td>
                    <div class="explain-col">
                        <div>
                            名字：
                            <input id="name" name="name" type="text" value="" class="input-text" />
                            来源：
                            <input id="source" type="text" name="source" value="" class="input-text" />
                            来源种类：
                            <select id="sign" style='width:135px' name="sign"></select>
                            状态：
                            <select id="state" style='width:135px' name="state"></select>
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
        <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('video/findbyattri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
    </div>
</div>
