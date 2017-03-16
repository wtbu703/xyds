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
		            <th>LOGO：</th>
		            <td><img src="<?=$ThirdPartyService['logoUrl']?>" /></td>
	            </tr>
	            <tr>
		            <th>简介：</th>
		            <td><?=$ThirdPartyService['introduction']?></td>
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