$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称

	//验证标题是否为空
	$("#trainId").formValidator({
				onshow:"请输入培训ID！",
				onfocus:"请输入培训ID！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入培训ID！"})


})


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "id="+$("#id").val();
		paraStr += "&trainId="+$("#trainId").val();
		paraStr += "&centralSupport=" + $("#centralSupport").val();
		paraStr += "&centralPaid=" + $("#centralPaid").val();
		paraStr += "&localSupport=" + $("#localSupport").val();
		paraStr += "&companyPaid=" + $("#companyPaid").val();
		paraStr += "&organizer=" + $("#organizer").val();
		paraStr += "&chargeName=" + $("#chargeName").val();
		paraStr += "&chargeMobile=" + $("#chargeMobile").val();
		paraStr += "&centralDecisionUnit=" + $("#centralDecisionUnit").val();
		paraStr += "&attachUrls=" + $("#attachUrls").val();
		paraStr += "&publicInfoUrl=" + $("#publicInfoUrl").val();
		paraStr += "&signSheetUrl=" + $("#signSheetUrl").val();
		paraStr += "&published=" + $("#published").val();

		$.ajax({
			url: updateUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
			async: "false",
			success: function (data) {
				window.top.art.dialog({
					content: '修改成功！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
				});
				art.dialog.parent.$('#pageForm').submit();
				window.top.$.dialog.get('info_update').close();
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