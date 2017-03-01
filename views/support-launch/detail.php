<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
	            <tr>
		            <th width="100%">项目建设名称：</th>
		            <td><?=$supportLaunch['name']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金支持建设内容：</th>
		            <td><?=$supportLaunch['centralSupportContent']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金支持总金额（万元）：</th>
		            <td><?=$supportLaunch['centralSupport']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金已拨付金额（截止上月底）（万元）：</th>
		            <td><?=$supportLaunch['centralPaid']?></td>
	            </tr>
	            <tr>
		            <th>地方财政配套资金总金额（万元）：</th>
		            <td><?=$supportLaunch['localSupport']?></td>
	            </tr>
	            <tr>
		            <th>企业投入资金总金额（万元）：</th>
		            <td><?=$supportLaunch['companyPaid']?></td>
	            </tr>
	            <tr>
		            <th>项目承办单位：</th>
		            <td><?=$supportLaunch['organizer']?></td>
	            </tr>
	            <tr>
		            <th>承办单位负责人：</th>
		            <td><?=$supportLaunch['chargeName1']?></td>
	            </tr>
	            <tr>
		            <th>联系电话：</th>
		            <td><?=$supportLaunch['chargeMobile1']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金支持此项目的政府决策单位或领导：</th>
		            <td><?=$supportLaunch['centralDecisionUnit']?></td>
	            </tr>
	            <tr>
		            <th>信息公开网址：</th>
		            <td><?=$supportLaunch['publicInfoUrl']?></td>
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