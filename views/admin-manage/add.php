<script type="text/javascript">
    var listdictUrl = "<?=yii::$app->urlManager->createUrl('dict/findall')?>";
    var checkusernameUrl = "<?=yii::$app->urlManager->createUrl('admin-manage/check-username')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('admin-manage/add-one')?>";
    var listallUrl = "<?=yii::$app->urlManager->createUrl('admin-manage/list')?>";
</script>
<script type="text/javascript" src="js/admin/admin/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">用&nbsp;户&nbsp;名&nbsp;：</th>
                        <td><input type="text" style="width:250px;" name="username" id="username"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>用户姓名：</th>
                        <td><input type="text" style="width:250px;" name="truename" id="truename"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">用户密码：</th>
                        <td><input type="password" style="width:250px;" name="password" id="password"  value="888888" class="input-text"/></td>
                    </tr>


                    <tr>
                        <th>联系电话：</th>
                        <td><input type="text" style="width:250px;" name="mobilephone" id="mobilephone" class="input-text"/></td>
                    </tr>


                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('admin_add').close();"/>
        </div>
    </div>
</div>