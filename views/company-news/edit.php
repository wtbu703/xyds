<?php
$this->title = "修改新闻";
?>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company-news/update-one')?>";
    function pic(){
        var a = '';
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%' id='ic'>";
        timeText.html(a);
    }
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
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px" align="right"><sub class="redstar">*</sub>新闻标题：</th>
                            <td><input type="text" id="title"  class="inputxt"  style="width:270px;" value="<?=$companyNews->title?>"/></td>
                            <td class="one"><div id="titleTip"></div></td>
                            <input type="hidden" id="id" value="<?=$companyNews->id?>" />
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>新闻类别：</th>
                            <td><select style="width:270px;" id="category">
                                    <?foreach($category as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $companyNews->category){?>
                                            <option name="category" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="category" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                            <td class="one"><div id="categoryTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>新闻来源：</th>
                            <td><input type="text" style="width:250px;" name="author" id="author"  value="<?=$companyNews->author?>" class="inputxt"/></td>
                            <td class="one"><div id="authorTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">新闻内容：</th>
                            <td colspan="2"><textarea style="width:500px;height:100px;" name="content" id="content" ><?=$companyNews->content?></textarea></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>关键词：</th>
                            <td><input type="text" id="keyword"  class="inputxt" style="width:270px;" value="<?=$companyNews->keyword?>" /></td>
                            <td class="one"><div id="keywordTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right">修改附件：</th>
                            <td colspan="2">
                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">原始图片：</th>
                            <td><img src="<?=$companyNews->picUrl?>" width="60%" /></td>
                        </tr>
                        <tr onmouseout="pic();">
                            <th align="right">修改图片：</th>
                            <td colspan="2">
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-news/uploads')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">图片预览：</th>
                            <td class="pic_text"></td>
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