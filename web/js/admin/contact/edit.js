$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
			window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称
	$("#truename").formValidator({
		onshow: "（必填）",
		onfocus: "（必填）",
		oncorrect: "（正确）"
	}).inputValidator({               //校验不能为空
		min:1,
		onerror:"请输入姓名！"
	}).regexValidator({
		regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,4}$",
		onerror:"不能超过4个字"
	});
	$("#gender").formValidator({
		onshow: "（必填）",
		onfocus: "（必填）",
		oncorrect: "（正确）"
	}).inputValidator({               //校验不能为空
		min:1,
		onerror:"请输入性别！"
	}).regexValidator({
		regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,1}$",
		onerror:"不能超过1个字"
	});
	$("#mobile").formValidator({
		onshow: "请输入电话号码",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^1(3|4|5|7|8)\\d{9}$ ",
		onerror: "您输入的电话号码格式错误!"
	});

	$("#email").formValidator({
		onshow: "请输入电子邮箱",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"[\\w!#$%&'*+/=?^_`{|}~-]+(?:\\.[\\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\\w](?:[\\w-]*[\\w])?\\.)+[\\w](?:[\\w-]*[\\w])?",
		onerror: "您输入的格式错误!"
	});

})


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "id="+$("#id").val();
		paraStr += "&truename=" + $("#truename").val();
		paraStr += "&gender=" + $("#gender").val();
		paraStr += "&mobile=" + $("#mobile").val();
		paraStr += "&QQ=" + $("#QQ").val();
		paraStr += "&email=" + $("#email").val();
		paraStr += "&content=" + encodeURIComponent(contentEditor.getData());

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
				window.top.$.dialog.get('contact_update').close();
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
