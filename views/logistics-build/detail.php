<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
	            <tr>
		            <th width="200">乡镇快递覆盖率（%）：</th>
		            <td><?=$supportLaunch['townCover']?></td>
	            </tr>
	            <tr>
		            <th>行政村快递覆盖率（%）：</th>
		            <td><?=$supportLaunch['villageCover']?></td>
	            </tr>
	            <tr>
		            <th>当月本县快递收件数量（件）：</th>
		            <td><?=$supportLaunch['receiveNum']?></td>
	            </tr>
	            <tr>
		            <th>排序：</th>
		            <td><?=$supportLaunch['orderBy']?></td>
	            </tr>
	            <tr>
		            <th>时间：</th>
		            <td><?=$supportLaunch['published']?></td>
	            </tr>
            </table>
        </div>
        <div class="bk10"></div>

        <div class="table-list">

           <div class="rightbtn">
               <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('site_detail').close();" />
            </div>
        </div>
</form>
</div>