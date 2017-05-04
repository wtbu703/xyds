<?php
$this->title =  '修改文章';
?>
<!--文本编辑器 -->
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/ckeditor/genEditor.js"></script>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('article/updateone')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
</script>
<script language="javascript" type="text/javascript" src="js/admin/article/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">文章内容</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="60px">文章分类：</th>
                            <td><select style="width:270px;" id="category">
                                    <?foreach($cateGory as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $article->category){?>
                                            <option name="platform" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="platform" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                        </tr>
                        <tr>
                            <th width="100">标题</th>
                            <td><input type="text" id="title" value="<?=$article->title?>"/></td>
                            <input type="hidden" id="id" value="<?=$article->id?>" />
                        </tr>
                        <tr>
                            <th width="100">作者</th>
                            <td><input type="text" id="author"  class="input-text" style="width:270px;" value="<?=$article->author?>" /></td>
                        </tr>
                        <tr>
                            <th>关键词：</th>
                            <td><input type="text" style="width:250px;" name="keyword" id="keyword" value="<?=$article->keyword?>" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th width="100">文章内容</th>
                            <td><textarea style="width:500px;height:200px;" name="content" id="content"><?=$article->content?></textarea></td>
                        </tr>
                        <tr>
                            <th>附&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;件：</th>
                            <td>
                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('article/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th width="100">原始图片：</th>
                            <td><img src="<?=$article->picUrl?>" width="60%" /></td>
                        </tr>
                        <tr onmouseout="pic()">
                            <th>上传图片：</th>
                            <td>
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=60px scrolling=no src="<?=yii::$app->urlManager->createUrl('article/uploads')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th>图片预览：</th>
                            <td class="pic_text"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('article_update').close();"/>
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