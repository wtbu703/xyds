
    <script type="text/javascript">
        window.top.$('#display_center_id').css('display','none');
        var saveUrl = "<?=yii::$app->urlManager->createUrl('resource/add-one')?>";
        var listUrl = "<?=yii::$app->urlManager->createUrl('resource/index')?>";
    </script>
    <script type="text/javascript" src="js/admin/resource/add.js"></script>
    <div class="pad-lr-10">
        <form action="<?=yii::$app->urlManager->createUrl('resource/add-one')?>" id="resourceForm" name="resourceForm" method="post" target="iframeId">
            <div class="pad_10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tr>
                            <th width="100">控制器名称</th>
                            <td><input type="text" style="width:370px;" name="tableName"  id="tableName" class="input-text"/></td>
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
                        <th align="left">操作排序</th>
                        <th align="left">操作名称</th>
                        <th align="left">简介</th>
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
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('resource_add').close();"/>
                </div>
            </div>
        </form>
    </div>