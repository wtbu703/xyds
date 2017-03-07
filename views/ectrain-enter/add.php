<?php
$this->title = '添加培训报名信息';
?>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('ectrain-enter/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('ectrain-enter/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/ectrain-enter/add.js"></script>
</head>
<body>
    <div class="pad-lr-10">
        <form name="myform" action="" method="post" id="myform" target="iframeId">
            <div class="pad_10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tr>
                            <th >培训ID：</th>
                            <td><input type="text" style="width:250px;" name="trainId" id="trainId"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>真实姓名：</th>
                            <td><input type="text" style="width:250px;" name="truename" id="truename"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>身份证号：</th>
                            <td><input type="text" style="width:250px;" name="idCardNo" id="idCardNo" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>手机号：</th>
                            <td><input type="text" style="width:250px;" name="mobile" id="mobile" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>地址：</th>
                            <td><input type="text" style="width:250px;" name="address" id="address" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>性别：</th>
                            <td><select type="text" style="width:250px;height: 30px;" name="gender" id="gender" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>年龄：</th>
                            <td><input type="text" style="width:250px;" name="age" id="age" class="input-text"/></td>
                        </tr>
                    </table>
                </div>
                <div class="bk10"></div>
            </div>
        </form>
        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
                <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('enter_add').close();"/>
            </div>
        </div>
    </div>
</body>
</html>
