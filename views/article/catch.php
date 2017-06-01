<?php
$this->title =  '文章抓取';
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
    var listallUrl  = "<?=yii::$app->urlManager->createUrl('article/find-web-resource')?>";
</script>
<script type="text/javascript" src="js/admin/article/catch.js"></script>

<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x"><em></em></div>
</div>
<div class="pad-lr-10">
    <form name="searchform" id="searchform" action="" method="post" target="iframeId">
        <table width="100%" cellspacing="0" class="search-form">
            <tbody>
            <tr>
                <td>
                    <div class="explain-col">
                        <span>
                            选择网站：
                            <select name="web" id="web" style="width:140px;"></select>
                            &nbsp;
                            <input type="button" onclick="search();" name="dosubmit" class="buttonsearch" value="抓取"/>
                            <span>
                                &nbsp; &nbsp; &nbsp; 抓取成功后，请选择要添加的文章，点“导入到网站”完成添加
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="table-list">
        <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('article/find-web-resource')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
    </div>
</div>