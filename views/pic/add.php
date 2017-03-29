<script type="text/javascript">
    window.top.$('#display_center_id').css('display','none');
    var checkCodeUrl = '<?=yii::$app->urlManager->createUrl('pic/check-one')?>';
    var saveUrl = '<?=yii::$app->urlManager->createUrl('pic/add-one')?>';
    var indexUrl = '<?=yii::$app->urlManager->createUrl('pic/index')?>';
    var uploadUrl = '<?=yii::$app->urlManager->createUrl('third-party-service/upload')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/pic/add.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <form action="<?=Yii::$app->urlManager->createUrl('pic/add-one')?>" id="categoryForm" name="categoryForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">图片大类标识</th>
                        <td><input type="text" style="width:370px;" name="categoryCode"  id="categoryCode" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">图片大类名称</th>
                        <td><input type="text" style="width:370px;" name="categoryName"  id="categoryName" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">图片大类简介</th>
                        <td><textarea style="width:370px;height:80px;" id="intro" name="intro"></textarea></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
        <!--列表-->
        <div class="table-list">
            <table id="modelTplTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th align="left">排序</th>
                    <th align="left">上传图片</th>
                    <th align="left">操作</th>
                </tr>
                </thead>
                <tbody id="modelTplTB">

                </tbody>
            </table>
            <div class="btn">
                <!--  <label for="check_box">全选/取消</label>-->
                <input type="button" class="buttonadd" name="dosubmit" value="增加" onclick="addRow()"/>
                <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="add()"/>
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('category_add').close();"/>
            </div>
        </div>
    </form>
</div>