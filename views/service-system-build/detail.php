<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
	            <tr>
		            <th width="100%">项目建设名称：</th>
		            <td><?=$serviceSystemBuild['name']?></td>
	            </tr>
	            <tr>
		            <th>详细地址：</th>
		            <td><?=$serviceSystemBuild['address']?></td>
	            </tr>
	            <tr>
		            <th>主要功能：</th>
		            <td><?=$serviceSystemBuild['function']?></td>
	            </tr>
	            <tr>
		            <th>负责人：</th>
		            <td><?=$serviceSystemBuild['chargeName']?></td>
	            </tr>
	            <tr>
		            <th>联系电话：</th>
		            <td><?=$serviceSystemBuild['chargeMobile']?></td>
	            </tr>
	            <tr>
		            <th>服务站ID：</th>
		            <td><?=$serviceSystemBuild['code']?></td>
	            </tr>
	            <tr>
		            <th>是否与县级物流配送中心共享场地和地点：</th>
		            <td><?=$serviceSystemBuild['isCountyLogistics']?></td>
	            </tr>
	            <tr>
		            <th>是否承担乡镇级（村级）物流服务点功能：</th>
		            <td><?=$serviceSystemBuild['isTownLogistics']?></td>
	            </tr>
	            <tr>
		            <th>设施配置：</th>
		            <td><?=$serviceSystemBuild['config']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金支持建设内容：</th>
		            <td><?=$serviceSystemBuild['centralSupportContent']?></td>
	            </tr>
	            <tr>
		            <th>项目建设进度：</th>
		            <td><?=$serviceSystemBuild['buildProgress']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金支持总金额（万元）：</th>
		            <td><?=$serviceSystemBuild['centralSupport']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金已拨付金额（截止上月底）（万元）：</th>
		            <td><?=$serviceSystemBuild['centralPaid']?></td>
	            </tr>
	            <tr>
		            <th>地方财政配套资金总金额（万元）：</th>
		            <td><?=$serviceSystemBuild['localSupport']?></td>
	            </tr>
	            <tr>
		            <th>企业投入资金总金额（万元）：</th>
		            <td><?=$serviceSystemBuild['companyPaid']?></td>
	            </tr>
	            <tr>
		            <th>项目承办单位：</th>
		            <td><?=$serviceSystemBuild['organizer']?></td>
	            </tr>
	            <tr>
		            <th>承办单位负责人：</th>
		            <td><?=$serviceSystemBuild['chargeName1']?></td>
	            </tr>
	            <tr>
		            <th>联系电话：</th>
		            <td><?=$serviceSystemBuild['chargeMobile1']?></td>
	            </tr>
	            <tr>
		            <th>中央财政资金支持此项目的政府决策单位或领导：</th>
		            <td><?=$serviceSystemBuild['centralDecisionUnit']?></td>
	            </tr>
	            <tr>
		            <th>信息公开网址：</th>
		            <td><?=$serviceSystemBuild['publicInfoUrl']?></td>
	            </tr>
	            <tr>
		            <th>时间：</th>
		            <td><?=$serviceSystemBuild['published']?></td>
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