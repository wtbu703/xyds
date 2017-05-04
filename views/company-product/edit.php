<?php
$this->title = "修改产品";
?>

<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('company-product/update-one')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
</script>
<script language="javascript" type="text/javascript" src="js/admin/company-product/edit.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改产品</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100">名称</th>
                            <td><input type="text" id="name"  class="input-text" style="width:270px;" value="<?=$companyProduct->name?>"/></td>
                            <input type="hidden" id="id" value="<?=$companyProduct->id?>" />
                        </tr>
                        <tr>
                            <th width="100">介绍</th>
                            <td><textarea style="width:500px;height:100px;" name="introduction" id="introduction" ><?=$companyProduct->introduction?></textarea></td>
                        </tr>
                        <tr>
                            <th width="100">价格</th>
                            <td><input type="text" id="price"  class="input-text" style="width:270px;" value="<?=$companyProduct->price?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">折扣</th>
                            <td><input type="text" id="discount"  class="input-text" style="width:270px;" value="<?=$companyProduct->discount?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">库存</th>
                            <td><input type="text" id="stock"  class="input-text" style="width:270px;" value="<?=$companyProduct->stock?>" /></td>
                        </tr>
                        <tr>
                            <th width="100">状态</th>
                            <td><select style="width:270px;" id="state">
                                    <?foreach($productState as $key => $val){?>
                                        <?if(intval($val->dictItemCode) == $companyProduct->state){?>
                                            <option name="state" value="<?=$val->dictItemCode?>" selected><?=$val->dictItemName?></option>
                                        <?}else{?>
                                            <option name="state" value="<?=$val->dictItemCode?>"><?=$val->dictItemName?></option>
                                        <?}?>
                                    <?}?>
                                </select></td>
                        </tr>
                        <tr>
                            <th width="100">原始图片：</th>
                            <td><img src="<?=$companyProduct->thumbnailUrl?>" width="60%" /></td>
                        </tr>
                        <tr onmouseout="pic()">
                            <th>修改图片：</th>
                            <td>
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" value="" class="input-text" "/>
                                <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-product/upload')?>"></iframe>
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
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('product_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','introduction','');
</script>