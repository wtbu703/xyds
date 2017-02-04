<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
	            <?if(!is_null($buyCategorys)){
		            if(!is_null($buySums)) {
			            foreach ($buyCategorys as $key => $value) {
				            foreach($buySums as $index => $val){
					            if($key == $index){?>
						            <tr>
							            <th width="100">代买商品类别<?= $key+1 ?></th>
							            <td><?= $value ?></td>
						            </tr>
						            <tr>
							            <th width="100">代买总金额<?= $index+1 ?></th>
							            <td><?= $val ?></td>
						            </tr>
			                    <?}
				            }
			            }
		            }
	            }?>
				<?if(!is_null($buyOrderTotal)){?>
					<tr>
						<th width="100">代买总订单数</th>
						<td><?= $buyOrderTotal ?></td>
					</tr>
	            <?}?>
	            <?if(!is_null($sellCategory)){
		            if(!is_null($sellSums)) {
			            foreach ($sellCategory as $key => $value) {
				            foreach($sellSums as $index => $val){
					            if($key == $index){?>
						            <tr>
							            <th width="100">销售商品类别<?= $key+1 ?></th>
							            <td><?= $value ?></td>
						            </tr>
						            <tr>
							            <th width="100">销售总金额<?= $index+1 ?></th>
							            <td><?= $val ?></td>
						            </tr>
					            <?}
				            }
			            }
		            }
	            }?>
	            <?if(!is_null($sellOrderTotal)){?>
		            <tr>
			            <th width="100">销售总订单数</th>
			            <td><?= $sellOrderTotal ?></td>
		            </tr>
	            <?}?>
            </table>
        </div>

        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('site_deal').close();" />
            </div>
        </div>
</form>
</div>