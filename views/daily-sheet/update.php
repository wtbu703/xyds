<script type="text/javascript">
	var indexUrl = '<?=Yii::$app->urlManager->createUrl('daily-sheet/index')?>';
	var saveUrl = '<?=Yii::$app->urlManager->createUrl('daily-sheet/update')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/daily-sheet/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
	        <input type="hidden" id="id" value="<?=$id?>">
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
							<td rowspan="<?=$i?>"><input type="text" style="width: 50px;" name="code" value="<?=$value?>"></td>
				            <td rowspan="<?=$i?>"><input type="text"  style="width: 150px;" name="name" value="<?=$names[$key]?>"></td>
				            <td rowspan="<?=$i?>"><input type="text" style="width: 20px;" name="countyType" value="<?=$countyTypes[$key]?>"></td>
				            <td rowspan="1"><?=$buyGoodCategorys[$key][0]?></td>
				            <td rowspan="1"><?=$buyMoneySums[$key][0]?></td>
				            <td rowspan="<?=$i?>"><input type="text" style="width: 40px;" name="buyOrderTotal" value="<?=$buyOrderTotals[$key]?>"></td>
				            <td rowspan="1"><?=$sellGoodCategorys[$key][0]?></td>
				            <td rowspan="1"><?=$sellMoneySums[$key][0]?></td>
				            <td rowspan="<?=$i?>"><input type="text" style="width: 40px;" name="sellOrderTotal" value="<?=$sellOrderTotals[$key]?>"></td>
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
	            <input type="button" class="buttonadd" name="dosubmit" value="保存" onclick="save()"/>
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('sheet_update').close();" />
            </div>
        </div>
</form>
</div>