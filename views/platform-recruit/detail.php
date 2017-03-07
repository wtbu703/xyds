<?php
$this->title = '职位详情';
?>

</head>
<body>
<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">职位</th>
                        <td id="position"><?=$platformRecruit->position?></td>
                    </tr>
                    <tr>
                        <th width="100">要求</th>
                        <td id="demand"><?=$platformRecruit->demand?></td>
                    </tr>
                    <tr>
                        <th width="100">手机</th>
                        <td id="mobile"><?=$platformRecruit->mobile?></td>
                    </tr>
                    <tr>
                        <th width="100">座机</th>
                        <td id="tel"><?=$platformRecruit->tel?></td>
                    </tr>
                    <tr>
                        <th width="100">邮箱</th>
                        <td id="email"><?=$platformRecruit->email?></td>
                    </tr>
                    <tr>
                        <th width="100">联系人</th>
                        <td id="contacts"><?=$platformRecruit->contacts?></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('recruit_detail').close();" />
                </div>
            </div>
    </form>
</div>
</body>
</html>