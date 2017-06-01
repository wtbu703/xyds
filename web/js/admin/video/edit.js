
//页面校验
$(function(){
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

	$("#source").formValidator({
		onshow: "请输入来源",
		onfocus: "不超过16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,16}$",
		onerror: "来源不超过16个字!"
	});
	$("#category").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 0,  //开始索引
		onerror: "你是不是忘记选择来源类型了!"
	});
	$("#sign").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 0,  //开始索引
		onerror: "你是不是忘记选择文章类别了!"
	});
	$("#name").formValidator({
		onshow: "请输入名字",
		onfocus: "不超过32个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,32}$",
		onerror: "名字不超过32个字!"
	});
});


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "&id="+$("#id").val();
		paraStr += "&sign=" + $("#sign").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&source=" + $("#source").val();
		paraStr += "&url=" + $("#attachUrls").val();
		paraStr += "&content=" + $("#content").val();
		paraStr += "&picUrl=" + $("#picUrl").val();
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
				window.top.$.dialog.get('video_update').close();
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