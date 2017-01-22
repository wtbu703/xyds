<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
                <tr>
                    <th>站点编码：</th>
                    <td><?=$serviceSite['code']?></td>
                </tr>
                <tr>
                    <th>站点名称：</th>
                    <td><?=$serviceSite['name']?></td>
                </tr>
                <tr>
                    <th>站点类型：</th>
                    <td><?=$serviceSite['countyType']?></td>
                </tr>
                <tr>
                    <th>负责人：</th>
                    <td><?=$serviceSite['chargeName']?></td>
                </tr>
	            <tr>
		            <th>联系电话：</th>
		            <td><?=$serviceSite['chargeMobile']?></td>
	            </tr>
	            <tr>
		            <th>地址：</th>
		            <td><?=$serviceSite['address']?></td>
	            </tr>
	            <tr>
		            <th>站点照片：</th>
		            <td><img src="<?=$serviceSite['picUrl']?>"></td>
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