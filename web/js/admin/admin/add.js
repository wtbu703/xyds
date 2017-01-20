
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称					
	$("#username").formValidator({
		onshow:"请输入用户名！",
		onfocus:"请输入用户名！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入用户名！"})
		.regexValidator({              
				regexp:"username",
				datatype:"enum",
				param:'i',
				onerror:"名称中不能含有特殊字符"})
		.ajaxValidator({					// 校验不许重复
				type:"get",
				url:checkusernameUrl,
				data:{
					'username':$("#username").val(),
				},
				datatype:"text",
				async:'true',
				success:function(data){
                    return data != "exist";
				},
				buttons: $("#dosubmit"),  // 页面提示----"输入正确"
				onerror : "用户名已存在",
				onwait : "正在连接，请稍候。"});
	$("#password").formValidator({
		onshow:"密码默认为888888！",
		onfocus:"请输入密码！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入密码！"})
		.regexValidator({              
				regexp:"username",
				datatype:"enum",
				param:'i',
				onerror:"密码中不能含有特殊字符"})
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
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = '';
		paraStr = "username=" + $('#username').val() + "&truename=" + $('#truename').val() + "&password=" + $('#password').val() + "&mobilephone=" + $('#mobilephone').val();
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
                    art.dialog.parent.location.href = listallUrl;
					window.top.$.dialog.get('admin_add').close();
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