/*$(document).ready(function (){
	// 菜单状态
	var dictArray = new Array();
	$.ajax({
		url:"/admin/getDictMapDictItem.do",
		type:"post", 
		dataType:"xml", 
		data:"dictCode=DICT_STATE",
		async:"false",
		success:function(data){
	       $(data).find("dictItem").each(function(){
	       		var dictItemCode = $(this).find("dictCode").text();
	       		var dictItemValue = $(this).find("dictValue").text();
	       		dictArray.push("<option value='"+ dictItemCode +"' ");
	       		if(curState == dictItemCode){
	       			dictArray.push(" selected='selected' ");
	       		}
	       		dictArray.push(" >"+ dictItemValue +"</option>");
	       });
	       $('#menuState').html(dictArray.join(''));
		}, 
		error:function (data) {
			window.top.art.dialog({content:'加载字典组出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		}
	});
});
*/
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj)
		{window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	// 校验模型名称					
	$("#menuName").formValidator({
		onshow:"请输入菜单名称",
		onfocus:"菜单名称必须是汉字"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入菜单名称"})
	// 校验菜单排序					
	$("#menuOrder").formValidator({
		onshow:"请输入菜单排序",
		onfocus:"必须是数字"})
		.regexValidator({              //
				regexp:"num1",
				datatype:"enum",
				param:'i',
				onerror:"只能是数字"});	
})

function editMenu(targetUrl){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "id="+$("#id").val();
		paraStr += "&menuName="+$("#menuName").val();
		paraStr += "&menuUrl="+$("#menuUrl").val();
		paraStr += "&state="+$("#state").val();
		paraStr += "&orderBy="+$("#orderBy").val();
		$.ajax({
			url: saveUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
			async: "false",
			success: function (data) {
				if(data == "success"){
					window.top.art.dialog({
						content: '修改成功！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
					parent.document.getElementById('center_frame').src=treeUrl;
				}else{
					window.top.art.dialog({
						content: '修改失败！',
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
					content: '修改失败！',
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
	
// 删除菜单
function del(menuId){
	var paraStr = "";
	paraStr = "menuId="+menuId;
	$.ajax({
		url: deleteUrl,
		type: "post",
		dataType: "text",
		data:paraStr ,
		async: "false",
		success: function (data) {
			if (data != "success") {
				window.top.art.dialog({
					content: '删除失败！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
				});
			} else {
				window.top.art.dialog({
					content: '删除成功！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
				});
				parent.document.getElementById('center_frame').src = treeUrl;
				parent.document.getElementById('rightMain').src = "";
			}

		},
		error:function(data){
			window.top.art.dialog({
				content: '修改失败！',
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

