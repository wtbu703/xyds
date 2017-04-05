
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称					
	$("#trainId").formValidator({
		onshow:"请输入培训ID！",
		onfocus:"请输入培训ID！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入培训ID！"})
	$("#organizer").formValidator({
				onshow:"请输入项目承办单位！",
				onfocus:"请输入项目承办单位！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入项目承办单位！"})
	$("#chargeName").formValidator({
				onshow:"请输入项目承办单位负责人！",
				onfocus:"请输入项目承办单位负责人！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入项目承办单位负责人！"})
	$("#chargeMobile").formValidator({
				onshow:"请输入负责人联系电话！",
				onfocus:"请输入负责人联系电话！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入负责人联系电话！"})


})

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "trainId=" + $("#trainId").val();
		paraStr += "&centralSupport=" + $("#centralSupport").val();
		paraStr += "&centralPaid=" + $("#centralPaid").val();
		paraStr += "&localSupport=" + $("#localSupport").val();
		paraStr += "&companyPaid=" + $("#companyPaid").val();
		paraStr += "&organizer=" + $("#organizer").val();
		paraStr += "&chargeName=" + $("#chargeName").val();
		paraStr += "&chargeMobile=" + $("#chargeMobile").val();
		paraStr += "&centralDecisionUnit=" + $("#centralDecisionUnit").val();
		paraStr += "&attachUrls=" + $("#attachUrls").val();
		paraStr += "&attachName=" + $("#attachName").val();
		paraStr += "&publicInfoUrl=" + $("#publicInfoUrl").val();
		paraStr += "&signSheetUrl=" + $("#signSheetUrl").val();
		paraStr += "&signSheetName=" + $("#signSheetName").val();
		paraStr += "&published=" + $("#published").val();

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
					window.top.$.dialog.get('info_add').close();
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