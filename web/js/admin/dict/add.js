//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"dictForm",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj)
		{window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	
	//校验模型标识
	$("#dictCode").formValidator({
		onshow:"请输入字典组标识",
		onfocus:"字典组标识必须是英文字母！"})
		.inputValidator({                  //校验不能为空
			min:1,
			onerror:"字典组标识不能为空！"})
		.ajaxValidator({					// 校验不许重复
				type:"get",
				url:findidUrl,
				async:false,
				data:{
					'dictCode':$("#dictCode").val()
				},
				datatype:"text", //必须是html
				success : function(data){
                    return data != "exist";
				},
				buttons: $("#dosubmit"),  // 页面提示----"输入正确"
				onerror : "字典标识已存在",
				onwait : "正在连接，请稍候。"});
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


//增加字典组项过滤
function add(){
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

			paraStr += "dictCode="+$("#dictCode").val();
			paraStr += "&dictName="+$("#dictName").val();
			paraStr += "&intro="+$("#intro").val();
			var dictItemCodes = $("input[name='dictItemCodes']");
			var dictItemValues = $("input[name='dictItemValues']");
			var dictItemOrders = $("input[name='dictItemOrders']");
			if(typeof(dictItemCodes) != "undefined"){
				var dictItemCodesStr = dictItemCodes[0].value;
				var dictItemValuesStr = dictItemValues[0].value;
				var dictItemOrdersStr = dictItemOrders[0].value;
				for(var i=1;i<dictItemValues.length;i++){
					dictItemValuesStr += "-" + dictItemValues[i].value;
					dictItemCodesStr += "-" + dictItemCodes[i].value;
					dictItemOrdersStr += "-" + dictItemOrders[i].value;
				}
				paraStr += "&dictItemCodes="+dictItemCodesStr;
				paraStr += "&dictItemOrders="+dictItemOrdersStr;
				paraStr += "&dictItemValues="+dictItemValuesStr;
			}
			$.ajax({
				url: saveUrl,
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
						art.dialog.parent.location.href = listUrl;
						window.top.$.dialog.get('dict_add').close();
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
	html.push(' <td align="left"><input name="dictItemOrders" type="text" value="0" size="5" /></td>');
	html.push('	<td align="left"><input name="dictItemCodes" type="text" value="" size="25" /></td>');
	html.push(' <td align="left"><input name="dictItemValues" type="text" value="" size="25" /></td>');
	html.push('	<td align="left"><a href="javascript:delrow(\''+rowId+'\')">[删除]</a></td>');
	html.push('</tr>');
	modelTplBody.append(html.join(''));
	$(":text").addClass('input-text');
}

//删除行
function delrow(rowId){
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('modelTplTable');
    objTable.deleteRow(index);
}

