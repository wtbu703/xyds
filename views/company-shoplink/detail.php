<?php
$this->title = '网店详情';
?>

</head>
<body>
<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">企业ID</th>
                        <td id="companyId"><?=$companyShoplink->companyId?></td>
                    </tr>
                    <tr>
                        <th width="100">网店名称</th>
                        <td id="shopName"><?=$companyShoplink->shopName?></td>
                    </tr>
                    <tr>
                        <th width="100">网店链接</th>
                        <td id="shopLink"><?=$companyShoplink->shopLink?></td>
                    </tr>
                    <tr>
                        <th width="100">网店平台</th>
                        <td id="platform"><?=$companyShoplink->platform?></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('shoplink_detail').close();" />
                </div>
            </div>
    </form>
</div>
</body>
</html>