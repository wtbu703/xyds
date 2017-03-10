<?php
$this->title = '报名详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">培训ID:</th>
                        <td id="trainId"><?=$ectrainEnter->trainId?></td>
                    </tr>
                    <tr>
                        <th width="100">真实姓名:</th>
                        <td id="truename"><?=$ectrainEnter->truename?></td>
                    </tr>
                    <tr>
                        <th width="100">身份证号:</th>
                        <td id="idCardNo"><?=$ectrainEnter->idCardNo?></td>
                    </tr>
                    <tr>
                        <th width="100">手机号:</th>
                        <td id="mobile"><?=$ectrainEnter->mobile?></td>
                    </tr>
                    <tr>
                        <th width="100">地址:</th>
                        <td id="address"><?=$ectrainEnter->address?></td>
                    </tr>
                    <tr>
                        <th width="100">性别:</th>
                        <td id="gender"><?=$ectrainEnter->gender?></td>
                    </tr>
                    <tr>
                        <th width="100">年龄:</th>
                        <td id="age"><?=$ectrainEnter->age?></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('enter_detail').close();" />
                </div>
            </div>
    </form>
</div>
