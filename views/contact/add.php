<?php
$this->title = '添加联系信息';
?>
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('contact/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('contact/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/contact/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="50px" align="right">姓名：</th>
                        <td><input type="text" style="width:250px;" name="truename" id="truename"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th  align="right">性别：</th>
                        <td><input type="text" style="width:250px;" name="gender" id="gender"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right">手机：</th>
                        <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="mobile" id="mobile"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right">邮箱：</th>
                        <td><input type="text" style="width:250px;" name="email" id="email"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right">QQ：</th>
                        <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="QQ" id="QQ"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right">内容：</th>
                        <td><textarea style="width:500px;height:100px;" name="content" id="content" ></textarea></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('contact_add').close();"/>
        </div>
    </div>
</div>
<script type="text/javascript">
    var contentEditor=genEditor('','content','');
</script>