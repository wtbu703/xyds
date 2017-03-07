<?php
$this->title = '添加平台招聘信息';
?>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('platform-recruit/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('platform-recruit/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/platform-recruit/add.js"></script>
</head>
<body>
    <div class="pad-lr-10">
        <form name="myform" action="" method="post" id="myform" target="iframeId">
            <div class="pad_10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tr>
                            <th>职位：</th>
                            <td><input type="text" style="width:250px;" name="position" id="position"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>要求：</th>
                            <td><textarea style="width:500px;height:100px;" name="demand" id="demand" ></textarea></td>
                        </tr>
                        <tr>
                            <th>联系手机：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="mobile" id="mobile"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>联系座机：</th>
                            <td><input type="text" style="width:250px;" name="tel" id="tel"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>联系邮箱：</th>
                            <td><input type="text" style="width:250px;" name="email" id="email"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>联系人：</th>
                            <td><input type="text" style="width:250px;" name="contacts" id="contacts"  class="input-text"/></td>
                        </tr>
                    </table>
                </div>
                <div class="bk10"></div>
            </div>
        </form>
        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
                <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('recruit_add').close();"/>
            </div>
        </div>
    </div>
</body>
</html>
