<?php
$this->title = '培训详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th >培训名：</th>
                        <td id="name"><?=$ectrain->name?></td>
                    </tr>
                    <tr>
                        <th>培训类别：</th>
                        <td id="category"><?=$ectrain->category?></td>
                    </tr>
                    <tr>
                        <th>内容：</th>
                        <td id="content"><?=$ectrain->content?></td>
                    </tr>
                    <tr>
                        <th>天数：</th>
                        <td id="dayNum"><?=$ectrain->dayNum?></td>
                    </tr>
                    <tr>
                        <th>期数：</th>
                        <td id="period"><?=$ectrain->period?></td>
                    </tr>
                    <tr>
                        <th>人数：</th>
                        <td id="peopleNum"><?=$ectrain->peopleNum?></td>
                    </tr>
                    <tr>
                        <th>针对人群：</th>
                        <td id="target"><?=$ectrain->target?></td>
                    </tr>
                    <tr>
                        <th>发布人：</th>
                        <td id="publisher"><?=$ectrain->publisher?></td>
                    </tr>
                    <tr>
                        <th>发布时间：</th>
                        <td id="published"><?=$ectrain->published?></td>
                    </tr>
                    <tr>
                        <th>产品大图：</th>
                        <td id="thumbnailUrl"> <img src="<?=$ectrain->thumbnailUrl?>"></td>
                    </tr>
                    <tr>
                        <th>产品缩略图：</th>
                        <td id="picUrl">
                            <?$picUrl_array = explode(';',$ectrain->picUrl);
                            foreach($picUrl_array as $key=>$data){?>
                                <img src="<?=$data?>">
                            <?} ?>
                        </td>
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