<?php
$this->title = '联系信息详情';
?>

</head>
<body>
<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">姓名</th>
                        <td id="truename"><?=$contact->truename?></td>
                    </tr>
                    <tr>
                        <th width="100">手机</th>
                        <td id="mobile"><?=$contact->mobile?></td>
                    </tr>
                    <tr>
                        <th width="100">邮箱</th>
                        <td id="email"><?=$contact->email?></td>
                    </tr>
                    <tr>
                        <th width="100">QQ</th>
                        <td id="QQ"><?=$contact->QQ?></td>
                    </tr>
                    <tr>
                        <th width="100">内容</th>
                        <td id="content"><?=$contact->content?></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('contact_detail').close();" />
                </div>
            </div>
    </form>
</div>
</body>
</html>