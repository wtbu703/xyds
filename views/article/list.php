<?php
$this->title =  '文章管理';
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
    var addUrl = "<?=yii::$app->urlManager->createUrl('article/add')?>";
    var listallUrl  = "<?=yii::$app->urlManager->createUrl('article/findbyattri')?>";
</script>
<script type="text/javascript" src="js/admin/article/list.js"></script>

<div class="subnav" id="display" >
    <div class="content-menu ib-a blue line-x">
        <?php if($add){?>
        <a class="add fb" href="javascript:openadd();void(0);"><em>添加文章</em></a>
        <?php }?>
        <?php if($excel){ ?>
        <a class="add fb" href="<?=yii::$app->urlManager->createUrl('article/excel')?>"><em>导出为Excel文件</em></a>
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
                            标题：
                            <input id="title" name="title" type="text" value="" class="input-text" />
                            作者：
                            <input id="author" type="text" name="author" value="" class="input-text" />
                            类别：
                            <select id="category" style='width:135px' name="category"></select></br>
                            时间：
                            <input id="articledateTime_1" name="articledateTime_1" type="text" value="" class="date">
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "articledateTime_1",
                                    trigger    : "articledateTime_1",
                                    dateFormat: "%Y-%m-%d %k:%M:%S",
                                    showTime: true,
                                    minuteStep: 1,
                                    onSelect   : function() {this.hide();}
                                });
                            </script>
                            &nbsp;至&nbsp;&nbsp;
                            <input id="articledateTime_2" name="articledateTime_2" type="text" value="" class="date">
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "articledateTime_2",
                                    trigger    : "articledateTime_2",
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
        <iframe id="iframeId" name="iframeId" src="<?=yii::$app->urlManager->createUrl('article/findbyattri')?>"  frameBorder=0 scrolling=no width="100%" onLoad="iFrameHeight()"></iframe>
    </div>
</div>