<script type="text/javascript">
	var saveUrl = "<?=Yii::$app->urlManager->createUrl('service-site-deal-table/add-one')?>";
	var indexUrl = "<?=Yii::$app->urlManager->createUrl('service-site-deal-table/index')?>";
	var findFullUrl = "<?=Yii::$app->urlManager->createUrl('category/find-one-full')?>";
</script>
<script type="text/javascript" src="js/admin/deal-table/deal.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th>站点编码：</th>
                        <td><?=$serviceSite['code']?></td>
	                    <input type="hidden" id="id" value="<?=$serviceSite['id']?>" />
                    </tr>
                    <tr>
                        <th>站点名称：</th>
                        <td><?=$serviceSite['name']?></td>
                    </tr>
	                <tr>
		                <th>代买商品类别：</th>
		                <td>
			                <select id="categoryBuy">
				                <option value="0">请选择商品大类</option>
				                <?if(!is_null($categorys)){?>
					                <?foreach($categorys as $key => $value){?>
						                <option value="<?=$value['categoryCode']?>" name="categoryCode"><?=$value['categoryName']?></option>
					                <?}?>
				                <?}?>
			                </select>
			                <select id="categoryFullBuy">

			                </select>
		                </td>
	                </tr>
	                <tr>
		                <th>代买总金额：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="buySum" id="buySum"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>代买订单数：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="buyTotal" id="buyTotal"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>销售商品类别：</th>
		                <td>
			                <select id="categorySell">
				                <option value="0">请选择商品大类</option>
				                <?if(!is_null($categorys)){?>
					                <?foreach($categorys as $key => $value){?>
						                <option value="<?=$value['categoryCode']?>" name="categoryCode"><?=$value['categoryName']?></option>
					                <?}?>
				                <?}?>
			                </select>
			                <select id="categoryFullSell">

			                </select>
		                </td>
	                </tr>
	                <tr>
		                <th>销售总金额：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="sellSum" id="sellSum"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>销售订单数：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="sellTotal" id="sellTotal"  class="input-text"/></td>
	                </tr>

                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="提交" name="dosubmit" onclick="saveDealTable()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('site_deal').close();"/>
        </div>
    </div>
</div>
<script type="text/javascript">
	//代买商品类别
	$("#categoryBuy").change(function(){
		var selectValue="categoryCode="+$("#categoryBuy").val();

		var categoryFull=$('#categoryFullBuy');
		categoryFull.children().remove();
		var html = [];
		html.push(" <option value='' selected>请选择具体类别</option>");

		$.ajax({
			url: findFullUrl,
			type: "post",
			dataType: "json",
			data: selectValue,
			async: false,
			success:function(data){
				$.each(data,function(i,n){
					html.push(" <option value='"+ n.buyCode +"'>"+ n.categoryFullName +"</option>");
				});
				categoryFull.append(html.join(''));
			},
			error:function(){
				window.top.art.dialog({
					content:'加载商品类别出错！',
					lock:true,
					width:'250',
					height:'50',
					border: false,
					time:1.5
				},function(){});
			}
		});
	});
	$("#categorySell").change(function(){
		var selectValue2="categoryCode="+$("#categorySell").val();

		var categoryFull2=$('#categoryFullSell');
		categoryFull2.children().remove();
		var html = [];
		html.push(" <option value='' selected>请选择具体类别</option>");

		$.ajax({
			url: findFullUrl,
			type: "post",
			dataType: "json",
			data: selectValue2,
			async: false,
			success:function(data){
				$.each(data,function(i,n){
					html.push(" <option value='"+ n.sellCode +"'>"+ n.categoryFullName +"</option>");
				});
				categoryFull2.append(html.join(''));
			},
			error:function(){
				window.top.art.dialog({
					content:'加载商品类别出错！',
					lock:true,
					width:'250',
					height:'50',
					border: false,
					time:1.5
				},function(){});
			}
		});
	});
</script>