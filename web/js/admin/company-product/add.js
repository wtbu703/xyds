// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_PRODUCT_STATE','state','状态');
})
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称					
	$("#name").formValidator({
		onshow:"请输入产品名称！",
		onfocus:"请输入产品名称！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入产品名称！"})
	$("#price").formValidator({
				onshow:"请输入产品价格！",
				onfocus:"请输入产品价格！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入产品价格！"})
	$("#state").formValidator({
				onshow:"请输入产品状态！",
				onfocus:"请输入产品状态！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入产品状态！"})
})

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "&companyId=" + $("#companyId").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&introduction=" + $("#introduction").val();
		paraStr += "&price=" + $("#price").val();
		paraStr += "&stock=" + $("#stock").val();
		paraStr += "&discount=" + $("#discount").val();
		paraStr += "&state=" + $("#state").val();

		$.ajax({
			url: insertUrl,
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
					window.top.$.dialog.get('product_add').close();
					art.dialog.parent.document.getElementById("iframeId").src=listallUrl;
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