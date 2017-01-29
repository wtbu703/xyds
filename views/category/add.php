<script type="text/javascript">
    window.top.$('#display_center_id').css('display','none');
    var addUrl = '<?=yii::$app->urlManager->createUrl('dict/add')?>';
    var findidUrl = '<?=yii::$app->urlManager->createUrl('dict/checkone')?>';
    var saveUrl = '<?=yii::$app->urlManager->createUrl('dict/addone')?>';
    var listUrl = '<?=yii::$app->urlManager->createUrl('dict/list')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/dict/add.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <form action="<?=yii::$app->urlManager->createUrl('dict/addone')?>" id="dictForm" name="dictForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">字典组标识</th>
                        <td><input type="text" style="width:370px;" name="dictCode"  id="dictCode" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">字典名称</th>
                        <td><input type="text" style="width:370px;" name="dictName"  id="dictName" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">字典简介</th>
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
                    <th align="left">字典排序</th>
                    <th align="left">字典项值</th>
                    <th align="left">字典项名称</th>
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
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('dict_add').close();"/>
            </div>
        </div>
    </form>
</div>