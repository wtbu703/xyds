
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称

	//验证真实姓名是否为空
	$("#truename").formValidator({
				onshow:"请输入真实姓名！",
				onfocus:"请输入真实姓名！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入真实姓名！"})

	//验证电话号码
	$("#mobilephone").formValidator({
		onshow:"请输入联系电话！",
		onfocus:"请输入联系电话！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入联系电话！"})
		.regexValidator({
				regexp:"mobile",
				datatype:"enum",
				param:'i',
				onerror:"联系电话填写不对！"})
})

/**
 * 添加过滤
 * @param path
 * @return
 */
function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr +="id="+$("#id").val();
		paraStr +="&truename="+$("#truename").val();
		paraStr +="&mobilephone="+$("#mobilephone").val();
		paraStr +="&sex="+$("#sex").val();
		paraStr +="&userState="+$("#userState").val();
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
				window.top.$.dialog.get('user_update').close();
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