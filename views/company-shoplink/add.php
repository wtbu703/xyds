<?php
$this->title = '添加网店链接';
?>
<script type="text/javascript">
    window.top.$('#display_center_id').css('display','none');
    var addUrl = '<?=yii::$app->urlManager->createUrl('company-shoplink/add')?>';
    var saveUrl = '<?=yii::$app->urlManager->createUrl('company-shoplink/add-one')?>';
    var listUrl = '<?=yii::$app->urlManager->createUrl('company-shoplink/list')?>';
    //正则表达式验证公司网址
    function IsUrl(str){
        if(str != '') {
            var regUrl = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/;
            var result = str.match(regUrl);
            if (result != null) {
                //alert("网址输入正确 ");
            }
            else {
                alert('网址输入不正确');
            }
        }
    }
</script>
<script type="text/javascript" src="js/admin/company-shoplink/add.js"></script>

<div class="pad-lr-10">
    <form action="<?=yii::$app->urlManager->createUrl('company-shoplink/add-one')?>" id="dictForm" name="dictForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                </table>
            </div>
            <div class="bk10"></div>
        </div>
        <!--列表-->
        <div class="table-list">
            <table id="modelTplTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th align="left">网店名称</th>
                    <th align="left">网店平台</th>
                    <th align="left">网店链接</th>
                    <th align="left">操作</th>
                </tr>
                </thead>
                <tbody id="modelTplTB">

                </tbody>
            </table>
            <div class="btn">
                <!--  <label for="check_box">全选/取消</label>-->
                <input type="button" class="buttonadd" name="dosubmit" value="增加" onclick="addrow()"/>
                <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="add()"/>
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('shoplink_add').close();"/>
            </div>
        </div>
    </form>
</div>
