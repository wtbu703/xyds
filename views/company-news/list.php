<?php
$this->title = '新闻管理';
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
    var addUrl = "<?=yii::$app->urlManager->createUrl('company-news/add')?>";
    var listallUrl  = "<?=yii::$app->urlManager->createUrl('company-news/find-by-attri')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/company-news/list.js" charset="utf-8"></script>
<div class="subnav" id="display" >
    <?php if($companyId != 'admin'&&$companyId != 'all'){?>
    <div class="content-menu ib-a blue line-x">
        <a class="add fb" href="javascript:openadd();"><em>添加新闻</em></a>
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
                            新闻标题：
                            <input id="title" name="title" type="text" value="" class="input-text" />
                            关键词：
                            <input id="keyword" name="keyword" type="text" value="" class="input-text" />
                            时间：
                            <input id="newsdateTime_1" name="newsdateTime_1" type="text" value="" class="date">
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "newsdateTime_1",
                                    trigger    : "newsdateTime_1",
                                    dateFormat: "%Y-%m-%d %k:%M:%S",
                                    showTime: true,
                                    minuteStep: 1,
                                    onSelect   : function() {this.hide();}
                                });
                            </script>
                            &nbsp;至&nbsp;&nbsp;
                            <input id="newsdateTime_2" name="newsdateTime_2" type="text" value="" class="date">
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "newsdateTime_2",
                                    trigger    : "newsdateTime_2",
                                    dateFormat: "%Y-%m-%d %k:%M:%S",
                                    showTime: true,
                                    minuteStep: 1,
                                    onSelect   : function() {this.hide();}
                                });
                            </script>

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
        <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('company-news/find-by-attri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
    </div>
</div>
