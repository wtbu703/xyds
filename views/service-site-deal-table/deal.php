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
                <table width="100%" cellspacing="0" class="table_form contentWrap" id="deal">
	                <tbody id="categoryAdd">
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
				                <select name="categoryBuy">
					                <option value="0">请选择商品大类</option>
					                <?if(!is_null($categorys)){?>
						                <?foreach($categorys as $key => $value){?>
							                <option value="<?=$value['categoryCode']?>" name="categoryCode"><?=$value['categoryName']?></option>
						                <?}?>
					                <?}?>
				                </select>
				                <select name="categoryFullBuy">

				                </select>
			                </td>
		                </tr>
		                <tr>
			                <th>代买金额：</th>
			                <td><input type="text" style="width:250px;height: 30px;" name="buySum" id="buySum"  class="input-text"/></td>
		                </tr>

		                <tr>
			                <th></th>
			                <td><input type="button" style="width:100px;height: 30px;color: #44ff19;" value="增加商品类别" onclick="addRow()"/></td>
		                </tr>
		                <tr>
			                <th>代买总订单数：</th>
			                <td><input type="text" style="width:250px;height: 30px;" name="buyTotal" id="buyTotal"  class="input-text"/></td>
		                </tr>
		                <tr>
			                <th>销售商品类别：</th>
			                <td>
				                <select name="categorySell">
					                <option value="0">请选择商品大类</option>
					                <?if(!is_null($categorys)){?>
						                <?foreach($categorys as $key => $value){?>
							                <option value="<?=$value['categoryCode']?>" name="categoryCode"><?=$value['categoryName']?></option>
						                <?}?>
					                <?}?>
				                </select>
				                <select name="categoryFullSell">

				                </select>
			                </td>
		                </tr>
		                <tr>
			                <th>销售金额：</th>
			                <td><input type="text" style="width:250px;height: 30px;" name="sellSum" id="sellSum"  class="input-text"/></td>
		                </tr>
		                <tr>
			                <th></th>
			                <td><input type="button" style="width:100px;height: 30px;color: #44ff19;" value="增加商品类别" onclick="addRow2()"/></td>
		                </tr>
		                <tr>
			                <th>销售总订单数：</th>
			                <td><input type="text" style="width:250px;height: 30px;" name="sellTotal" id="sellTotal"  class="input-text"/></td>
		                </tr>
	                </tbody>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" style="width:50px;height: 30px;" value="提交" name="dosubmit" onclick="saveDealTable()" />
            <input type="button" class="buttonclose" style="width:50px;height: 30px;" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('site_deal').close();"/>
        </div>
    </div>
</div>
<script type="text/javascript">
	//代买商品类别
	$("select[name=categoryBuy]").change(function(){
		var selectValue="categoryCode="+$(this).val();

		var categoryFull=$(this).next();
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

	//销售商品类别
	$("select[name=categorySell]").change(function(){
		var selectValue2="categoryCode="+$(this).val();

		var categoryFull2=$(this).next();
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

	//新增代买商品大类
	function addRow(){
		var categoryAdd=$('#categoryAdd');
		var rowId=Math.random();
		var html = [];
		html.push('<tr id="'+rowId+'">');
		html.push('<th>代买商品类别：</th>');
		html.push('<td>');
		html.push('<select name="categoryBuy">');
		html.push('<option value="0">请选择商品大类</option>');
		html.push('<?if(!is_null($categorys)){?>');
		html.push('<?foreach($categorys as $key => $value){?>');
		html.push('<option value="<?=$value['categoryCode']?>" name="categoryCode"><?=$value['categoryName']?></option>');
	    html.push('<?}?>');
	    html.push('<?}?>');
	    html.push('</select>');
	    html.push('<select name="categoryFullBuy">');
	    html.push('</select>');
	    html.push('</td>');
	    html.push('</tr>');
	    html.push('<tr id="'+rowId+'">');
	    html.push('<th>代买金额：</th>');
	    html.push('<td><input type="text" style="width:250px;height: 30px;" name="buySum" id="buySum"  class="input-text"/></td>');
	    html.push('</tr>');
	    html.push('<tr id="'+rowId+'">');
	    html.push('<th></th>');
	    html.push('<td><input type="button" style="width:100px;height: 30px;color: #ff1f30;" value="删除商品类别" onclick="deleteRow(\''+rowId+'\')"/></td>');
	    html.push('</tr>');

	    var addButton = categoryAdd.children('tr').eq(4);
	    $(html.join('')).insertBefore(addButton);

		$("select[name=categoryBuy]").change(function(){
			var selectValue="categoryCode="+$(this).val();

			var categoryFull=$(this).next();
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
	}

	//新增销售商品大类
	function addRow2(){
		var categoryAdd=$('#categoryAdd');
		var rowId=Math.random();
		var html = [];
		html.push('<tr id="'+rowId+'">');
		html.push('<th>销售商品类别：</th>');
		html.push('<td>');
		html.push('<select name="categorySell">');
		html.push('<option value="0">请选择商品大类</option>');
		html.push('<?if(!is_null($categorys)){?>');
		html.push('<?foreach($categorys as $key => $value){?>');
		html.push('<option value="<?=$value['categoryCode']?>" name="categoryCode"><?=$value['categoryName']?></option>');
		html.push('<?}?>');
		html.push('<?}?>');
		html.push('</select>');
		html.push('<select name="categoryFullSell">');
		html.push('</select>');
		html.push('</td>');
		html.push('</tr>');
		html.push('<tr id="'+rowId+'">');
		html.push('<th>销售金额：</th>');
		html.push('<td><input type="text" style="width:250px;height: 30px;" name="sellSum" id="sellSum"  class="input-text"/></td>');
		html.push('</tr>');
		html.push('<tr id="'+rowId+'">');
		html.push('<th></th>');
		html.push('<td><input type="button" style="width:100px;height: 30px;color: #ff1f30;" value="删除商品类别" onclick="deleteRow(\''+rowId+'\')"/></td>');
		html.push('</tr>');

		var addButton2 = categoryAdd.children('tr').eq(-2);
		$(html.join('')).insertBefore(addButton2);
		//销售商品类别
		$("select[name=categorySell]").change(function(){
			var selectValue2="categoryCode="+$(this).val();

			var categoryFull2=$(this).next();
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

	}
</script>