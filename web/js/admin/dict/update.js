
var delId = new Array();
// 获取字典
$(function(){
	$.ajax ({
		type:"post",
		url:listdictUrl,
		dataType:"json",
		data:"dictCode=DICT_STATE",
		async:true,
		error: function () {
			window.top.art.dialog({content:'获取字典类型出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		},
		success: function(data) {
			var selectarray =  new Array();
			$.each(data,function(i,n){
				if(n.dictItemCode == state){
					selectarray.push("<option value='"+ n.dictItemCode +"' selected='selected'>"+ n.dictItemName +"</option>");
				}else{
					selectarray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
				}
			});
			$('#state').html(selectarray.join(''));
		}
	});

	$.formValidator.initConfig({
		formid:"dictForm",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj)
		{window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});

	// 校验模型名称
	$("#dictName").formValidator({
				onshow:"请输入字典组名称",
				onfocus:"模型名称必须是汉字"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"字典组名称不能为空"})
			.regexValidator({              //校验必须是汉字
				regexp:"chinese",
				datatype:"enum",
				param:'i',
				onerror:"只能是汉字"})
})

// 修改字典
function update(){
	if($.formValidator.pageIsValid()){
		var ids = $("input[name='dictItemOrders']");
		var message = "";
		var paraStr = "";
		//增加字典项
		if(ids != null && ids.length != 0){
			var dictItemCodes = $("input[name='dictItemCodes']");
			var dictItemValues = $("input[name='dictItemValues']");
			var narry = new Array();
			for(var i=0;i<dictItemValues.length;i++){
				narry[i] = dictItemValues[i].value;
			}
			narry.sort();
			for(var i=0;i<dictItemValues.length-1;i++){
				if(narry[i] == narry[i+1]){
					window.top.art.dialog({content:'字典项值重复！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
					message = "message";
				}
			}
			$("input[name='dictItemValues']").each(function(i,id){
				if(dictItemValues[i].value == ""){
					window.top.art.dialog({content:'字典项名不能为空!',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
					message = "message";
				}
				if(dictItemCodes[i].value == ""){
					window.top.art.dialog({content:'字典项值不能为空!',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
					message = "message";
				}
			});
		}
		if(message == "") {
			for(var i=0;i<delId.length;i++){
				if(delId[i] != '1'){
					delDictItem(delId[i]);
				}
			}
			paraStr += "dictCode="+$("#dictCode").val();
			paraStr += "&dictName="+$("#dictName").val();
			paraStr += "&intro="+$("#intro").val();
			paraStr += "&state="+$("#state").val();
			var dictItemCodes = $("input[name='dictItemCodes']");
			var dictItemValues = $("input[name='dictItemValues']");
			var dictItemOrders = $("input[name='dictItemOrders']");
			var dictItemIds = $("input[name='dictItemIds']");
			if(typeof(dictItemCodes) != "undefined"){
				var dictItemCodesStr = dictItemCodes[0].value;
				var dictItemValuesStr = dictItemValues[0].value;
				var dictItemOrdersStr = dictItemOrders[0].value;
				var dictItemIdsStr = dictItemIds[0].value;
				for(var i=1;i<dictItemValues.length;i++){
					dictItemValuesStr += "-" + dictItemValues[i].value;
					dictItemCodesStr += "-" + dictItemCodes[i].value;
					dictItemOrdersStr += "-" + dictItemOrders[i].value;
					dictItemIdsStr += "-" + dictItemIds[i].value;
				}
				paraStr += "&dictItemCodes="+dictItemCodesStr;
				paraStr += "&dictItemOrders="+dictItemOrdersStr;
				paraStr += "&dictItemValues="+dictItemValuesStr;
				paraStr += "&dictItemIds="+dictItemIdsStr;
			}
			$.ajax({
				url: updateUrl,
				type: "post",
				dataType: "text",
				data:paraStr ,
				async: "false",
				success: function (data) {
					if(data == "success"){
						window.top.art.dialog({
							content: '添加成功！',
							lock: true,
							width: 250,
							height: 80,
							border: false,
							time: 2
						}, function () {
						});
						art.dialog.parent.$('#pageForm').submit();
						window.top.$.dialog.get('dict_edit').close();
					}else{
						window.top.art.dialog({
							content: '添加失败！',
							lock: true,
							width: 250,
							height: 80,
							border: false,
							time: 2
						}, function () {
						});
					}

				},
				error:function(data){
					window.top.art.dialog({
						content: '添加失败！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
				}
			});

		}
	}
}

function addrow(){
	var modelTplBody=$('#modelTplTB');
	var rowId=Math.random();
	var html = new Array();
	html.push('<tr id="'+rowId+'">');
	html.push(' <td align="left"><input name="dictItemOrders" type="text" value="0" size="5" /><input name="dictItemIds" value="1" type="hidden"/></td>');
	html.push('	<td align="left"><input name="dictItemCodes" type="text" value="" size="25" /></td>');
	html.push(' <td align="left"><input name="dictItemValues" type="text" value="" size="25" /></td>');
	html.push('	<td align="left"><a href="javascript:delrow(\''+rowId+'\',\'1\')">[删除]</a></td>');
	html.push('</tr>');
	modelTplBody.append(html.join(''));
	$(":text").addClass('input-text');
}

//删除行
function delrow(rowId,id){
	delId.push(id);
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('modelTplTable');
	objTable.deleteRow(index);
}
//删除行中对应的字典项
function delDictItem(id){
	var paraStr = '&id='+id;
	$.ajax({
		url: deleteUrl,
		type: "post",
		dataType: "text",
		data:paraStr ,
		async: "false",
		success: function (data) {

		},
	});
}