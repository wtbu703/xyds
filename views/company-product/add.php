<?php
$this->title = '添加产品';
?>
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company-product/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company-product/add-one')?>";
    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
</script>
<script type="text/javascript" src="js/admin/company-product/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th>产品名称：</th>
                        <td><input type="text" style="width:250px;" name="name" id="name"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>产品介绍：</th>
                        <td><textarea style="width:500px;height:100px;" name="introduction" id="introduction" ></textarea></td>
                    </tr>
                    <tr>
                        <th>产品价格：</th>
                        <td><input type="text" style="width:250px;" name="price" id="price"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>产品库存：</th>
                        <td><input type="text" style="width:250px;" name="stock" id="stock"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>产品折扣：</th>
                        <td><input type="text" style="width:250px;" name="discount" id="discount"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>产品状态：</th>
                        <td><select style='width:250px;height:25px; ' id="state"  name="state" class="input-text"></select></td>
                    </tr>
                    <tr onmouseout="pic()">
                        <th>产品图片：</th>
                        <td>
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company-product/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th>图片预览：</th>
                        <td class="pic_text"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('product_add').close();"/>
        </div>
    </div>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','introduction','');
</script>
