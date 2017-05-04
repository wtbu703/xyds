<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
	            <tr>
		            <th width="100">企业名：</th>
		            <td><?=$ThirdPartyService['companyName']?></td>
	            </tr>
				<tr>
					<th width="100px">企业类别</th>
					<td id="category"><?=$ThirdPartyService->category?></td>
				</tr>
	            <tr>
		            <th>LOGO：</th>
		            <td><img src="<?=$ThirdPartyService['logoUrl']?>" /></td>
	            </tr>
	            <tr>
					<th>服务名称：</th>
					<td><?=$ThirdPartyService['introduction']?></td>
				</tr>
				<tr>
					<th>内容来源：</th>
					<td><?=$ThirdPartyService['sources']?></td>
				</tr>
				<tr>
					<th>内容：</th>
					<td><?=$ThirdPartyService['content']?></td>
				</tr>
				<tr>
					<th>联系人：</th>
					<td><?=$ThirdPartyService['contact']?></td>
				</tr>
	            <tr>
		            <th>电话：</th>
		            <td><?=$ThirdPartyService['tel']?></td>
	            </tr>
	            <tr>
		            <th>电子邮箱：</th>
		            <td><?=$ThirdPartyService['email']?></td>
	            </tr>
	            <tr>
		            <th>地址：</th>
		            <td><?=$ThirdPartyService['address']?></td>
	            </tr>
	            <tr>
		            <th>传真：</th>
		            <td><?=$ThirdPartyService['fax']?></td>
	            </tr>
	            <tr>
		            <th>邮编：</th>
		            <td><?=$ThirdPartyService['postcode']?></td>
	            </tr>
				<tr>
					<th>发布时间：</th>
					<td><?=$ThirdPartyService['publicTime']?></td>
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