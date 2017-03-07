<?php
$this->title = '添加企业';
?>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/company/add.js"></script>
</head>
<body>
    <div class="pad-lr-10">
        <form name="myform" action="" method="post" id="myform" target="iframeId">
            <div class="pad_10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tr>
                            <th >企业名称：</th>
                            <td><input type="text" style="width:250px;" name="name" id="name"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>联系电话：</th>
                            <td><input type="text" style="width:250px;" name="tel" id="tel"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>企业地址：</th>
                            <td><input type="text" style="width:250px;" name="address" id="address"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>企业法人：</th>
                            <td><input type="text" style="width:250px;" name="corporate" id="corporate"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>企业简介：</th>
                            <td><textarea style="width:500px;height:100px;" name="introduction" id="introduction" ></textarea></td>
                        </tr>
                       <tr>
                            <th>企业LOGO：</th>
                            <td>
                                <input type="text" style="display:none;" name="picUrl" id="picUrl" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="bk10"></div>
            </div>
        </form>
        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
                <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('company_add').close();"/>
            </div>
        </div>
    </div>
</body>
</html>
