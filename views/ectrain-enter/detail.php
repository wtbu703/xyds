<?php
$this->title = '报名详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right">真实姓名:</th>
                        <td id="truename"><?=$ectrainEnter->truename?></td>
                    </tr>
                    <tr>
                        <th align="right">状态:</th>
                        <td id="state"><?=$ectrainEnter->state?></td>
                    </tr>
                    <tr>
                        <th align="right">身份证号:</th>
                        <td id="idCardNo"><?=$ectrainEnter->idCardNo?></td>
                    </tr>
                    <tr>
                        <th align="right">手机号:</th>
                        <td id="mobile"><?=$ectrainEnter->mobile?></td>
                    </tr>
                    <tr>
                        <th align="right">地址:</th>
                        <td id="address"><?=$ectrainEnter->address?></td>
                    </tr>
                    <tr>
                        <th align="right">性别:</th>
                        <td id="gender"><?=$ectrainEnter->gender?></td>
                    </tr>
                    <tr>
                        <th align="right">年龄:</th>
                        <td id="age"><?=$ectrainEnter->age?></td>
                    </tr>
                    <tr>
                        <th align="right">报名时间:</th>
                        <td id="created"><?=$ectrainEnter->created?></td>
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
