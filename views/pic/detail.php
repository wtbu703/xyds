<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
                <tr>
                    <th width="200">前台栏目：</th>
                    <td><?=$pic->category?></td>
                </tr>
                <tr>
                    <th width="200">图片：</th>
                    <td><img src="<?=$pic->url?>" /></td>
                </tr>
            </table>
        </div>
        <div class="bk10"></div>

        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('category_detail').close();" />
            </div>
        </div>
</form>
</div>