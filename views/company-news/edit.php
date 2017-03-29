<?php
$this->title = "修改新闻";
?>
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company-news/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/company-news/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改新闻</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100">企业ID</th>
                            <td><input type="text" id="companyId"  class="input-text" style="width:270px;" value="<?=$companyNews->companyId?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">标题</th>
                            <td><input type="text" id="title"  class="input-text" style="width:270px;" value="<?=$companyNews->title?>"/></td>
                            <input type="hidden" id="id" value="<?=$companyNews->id?>" />
                        </tr>
                        <tr>
                            <th width="100">内容</th>
                            <td><textarea style="width:500px;height:100px;" name="content" id="content" ><?=$companyNews->content?></textarea></td>
                        </tr>
                        <tr>
                            <th width="100">关键词</th>
                            <td><input type="text" id="keyword"  class="input-text" style="width:270px;" value="<?=$companyNews->keyword?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">附件</th>
                            <td>
                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th>上传图片：</th>
                            <td>
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/uploads')?>"></iframe>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('news_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>