// 加载字典信息
function dict(sid){
	generateDict('DICT_PLATFORM', sid, '网店平台');
}

//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"dictForm",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj)
		{window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	});
//增加字典组项过滤
function add(){
	if($.formValidator.pageIsValid()){
		var ids = $("input[name='shopName']");
		var message = "";
		var paraStr = "";
		/*//增加字典项
		if(ids != null){
			var platform = $("input[name='platform']");
			var shopLink = $("input[name='shopLink']");
			var narry = new Array();
			for(var i=0;i<shopLink.length;i++){
				narry[i] = shopLink[i].value;
			}
			narry.sort();
			for(var i=0;i<shopLink.length-1;i++){
				if(narry[i] == narry[i+1]){
					window.top.art.dialog({content:'网店链接重复！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
					message = "message";
				}
			}
			$("input[name='shopLink']").each(function(i,id){
				if(shopLink[i].value == ""){
					window.top.art.dialog({content:'网店链接不能为空!',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
					message = "message";
				}
			});
		}*/
		//if(message == "") {
/*
			paraStr += "shopName="+$("#shopName").val();
			paraStr += "&platform="+$("#platform").val();
			paraStr += "&shopLink="+$("#shopLink").val();*/
			var shopName = $("input[name='shopName']");
			var platform = $("select[name='platform']");
			var shopLink = $("input[name='shopLink']");
			if(typeof(shopName) != "undefined"){
				var name = shopName[0].value;
				var form = platform[0].value;
				var link = shopLink[0].value;
				for(var n=1;n<shopLink.length;n++){
					name += "-" + shopName[n].value;
					form += "-" + platform[n].value;
					link += "-" + shopLink[n].value;
				}
				paraStr += "&shopName="+name;
				paraStr += "&platform="+form;
				paraStr += "&shopLink="+link;
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
						window.top.$.dialog.get('shoplink_add').close();
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
	//}
}
var i = 0;
function addrow(){
	var modelTplBody=$('#modelTplTB');
	var rowId=Math.random();
	var sid = 'platform'+i;
	var html = new Array();
	html.push('<tr id="'+rowId+'">');
	html.push(' <td align="left"><input name="shopName" type="text" value="" size="16" /></td>');
	html.push('	<td align="left"><select style="width:130px;" id="'+sid+'" name="platform"></select></td>');
	var p ='document.dictForm.shopLink.value';
	html.push(' <td align="left"><input name="shopLink" type="text" onmouseout= "IsUrl('+p+')"  value="" size="25" />以http://开头</td>');
	html.push('	<td align="left"><a href="javascript:delrow(\''+rowId+'\')">[删除]</a></td>');
	html.push('</tr>');
	modelTplBody.append(html.join(''));
	dict(sid);
	i++;
	$(":text").addClass('input-text');
}

//删除行
function delrow(rowId){
	var row=document.getElementById(rowId);
	var index=row.rowIndex;
	var objTable=document.getElementById('modelTplTable');
	objTable.deleteRow(index);
}

