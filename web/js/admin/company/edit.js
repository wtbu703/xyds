$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称

	//验证标题是否为空
	$("#name").formValidator({
				onshow:"请输入企业名称！",
				onfocus:"请输入企业名称！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入企业名称！"})


})


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "id="+$("#id").val();
		paraStr += "&name="+$("#name").val();
		paraStr += "&address=" + $("#address").val();
		paraStr += "&tel=" + $("#tel").val();
		paraStr += "&corporate=" + $("#corporate").val();
		paraStr += "&introduction=" + $("#introduction").val();
		paraStr += "&logoUrl=" + $("#picUrl").val();

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
				window.top.$.dialog.get('company_update').close();
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