<?php
$this->title = '培训详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right">培训名：</th>
                        <td id="name"><?=$ectrain->name?></td>
                    </tr>
                    <tr>
                        <th align="right">培训类别：</th>
                        <td id="category"><?=$ectrain->category?></td>
                    </tr>
                    <tr>
                        <th align="right">内容：</th>
                        <td id="content"><?=$ectrain->content?></td>
                    </tr>
                    <tr>
                        <th align="right">天数：</th>
                        <td id="dayNum"><?=$ectrain->dayNum?></td>
                    </tr>
                    <tr>
                        <th align="right">期数：</th>
                        <td id="period"><?=$ectrain->period?></td>
                    </tr>
                    <tr>
                        <th align="right">人数：</th>
                        <td id="peopleNum"><?=$ectrain->peopleNum?></td>
                    </tr>
                    <tr>
                        <th align="right">已报名人数：</th>
                        <td id="peopleNum"><?=$peo?></td>
                    </tr>
                    <tr>
                        <th align="right">报名时间：</th>
                        <td><?=$ectrain->beginTime?>至<?=$ectrain->endTime?></td>
                    </tr>
                    <tr>
                        <th align="right">针对人群：</th>
                        <td id="target"><?=$ectrain->target?></td>
                    </tr>
                    <tr>
                        <th align="right">发布人：</th>
                        <td id="publisher"><?=$ectrain->publisher?></td>
                    </tr>
                    <tr>
                        <th align="right">发布时间：</th>
                        <td id="published"><?=$ectrain->published?></td>
                    </tr>
                    <tr>
                        <th align="right">培训开始时间：</th>
                        <td id="time"><?=$ectrain->time?></td>
                    </tr>
                    <tr>
                        <th align="right">大图：</th>
                        <td id="thumbnailUrl"> <img src="<?=$ectrain->thumbnailUrl?>" width="60%"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('ectrain_detail').close();" />
                </div>
            </div>
    </form>
</div>