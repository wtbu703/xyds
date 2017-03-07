<?php
$this->title = '企业详情';
?>

</head>
<body>
<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">企业名称</th>
                        <td id="name"><?=$company->name?></td>
                    </tr>
                    <tr>
                        <th width="100">企业法人</th>
                        <td id="corporate"><?=$company->corporate?></td>
                    </tr>
                    <tr>
                        <th width="100">企业地址</th>
                        <td id="address"><?=$company->address?></td>
                    </tr>
                    <tr>
                        <th width="100">联系电话</th>
                        <td id="tel"><?=$company->tel?></td>
                    </tr>
                    <tr>
                        <th width="100">企业简介</th>
                        <td id="introduction"><textarea style="width:500px;height:100px;"><?=$company->introduction?></textarea></td>
                    </tr>
                    <tr>
                        <th width="100">企业LOGO</th>
                        <td id="logoUrl"><img src="<?=$company->logoUrl?>"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('company_detail').close();" />
                </div>
            </div>
    </form>
</div>
</body>
</html>