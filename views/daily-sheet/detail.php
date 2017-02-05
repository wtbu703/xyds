<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table border="1" width="100%" cellspacing="0" class="table_form contentWrap">
	            <tr align="center">
		            <th>序号</th>
		            <th>站点编码</th>
		            <th>站点名称</th>
		            <th>站点类型</th>
		            <th>代买商品类别</th>
		            <th>代买总金额</th>
		            <th>代买总订单数</th>
		            <th>销售商品类别</th>
		            <th>销售总金额</th>
		            <th>销售总订单数</th>
	            </tr>
	            <?if(!is_null($codes)){
		            foreach($codes as $key => $value){
			            $i = 0;
			            foreach($buyGoodCategorys[$key] as $index => $data){
				            $i++;
			            } ?>
			            <tr align="center">
				            <td rowspan="<?=$i?>"><?=$key+1?></td>
							<td rowspan="<?=$i?>"><?=$value?></td>
				            <td rowspan="<?=$i?>"><?=$names[$key]?></td>
				            <td rowspan="<?=$i?>"><?=$countyTypes[$key]?></td>
				            <td rowspan="1"><?=$buyGoodCategorys[$key][0]?></td>
				            <td rowspan="1"><?=$buyMoneySums[$key][0]?></td>
				            <td rowspan="<?=$i?>"><?=$buyOrderTotals[$key]?></td>
				            <td rowspan="1"><?=$sellGoodCategorys[$key][0]?></td>
				            <td rowspan="1"><?=$sellMoneySums[$key][0]?></td>
				            <td rowspan="<?=$i?>"><?=$sellOrderTotals[$key]?></td>
			            </tr>
			            <?if($i>=1){
			                for($a=1;$a<$i;$a++){?>
				            <tr align="center">
					            <td><?=$buyGoodCategorys[$key][$a]?></td>
					            <td><?=$buyMoneySums[$key][$a]?></td>
					            <td><?=$sellGoodCategorys[$key][$a]?></td>
					            <td><?=$sellMoneySums[$key][$a]?></td>
				            </tr>
			                <?}
			            }
		            }
				}?>

            </table>
        </div>
        <div class="bk10"></div>

        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('sheet_detail').close();" />
            </div>
        </div>
</form>
</div>