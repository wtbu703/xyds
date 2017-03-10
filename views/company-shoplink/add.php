<?php
$this->title = '添加网店链接';
?>
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company-shoplink/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company-shoplink/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/company-shoplink/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th >企业ID：</th>
                        <td><input type="text" style="width:250px;" name="companyId" id="companyId"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>网店名：</th>
                        <td><input type="text" style="width:250px;" name="shopName" id="shopName"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>网店链接：</th>
                        <td><textarea style="width:500px;height:100px;" name="shopLink" id="shopLink" ></textarea></td>
                    </tr>
                    <tr>
                        <th>网店平台：</th>
                        <td><select style='width:250px;height:25px; ' id="platform"  name="platform" class="input-text"></select></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('shoplink_add').close();"/>
        </div>
    </div>
</div>
