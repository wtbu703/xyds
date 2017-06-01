// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_SIGN','sign','视频类别');
});
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
	$("#name").formValidator({
		onshow: "请输入名字",
		onfocus: "不超过32个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,32}$",
		onerror: "名字不超过32个字!"
	});
	$("#attachUrls").formValidator({
		onshow: "请输入视频链接",
		onfocus: "例如：https://www.baidu.com/",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"[a-zA-z]+://[^\\s]*",
		onerror: "视频链接格式错误!"
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
		min: 1,  //开始索引
		onerror: "你是不是忘记选择视频类别了!"
	});
});

/**
 * 添加过滤
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "sign=" + $("#sign").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&source=" + $("#source").val();
		paraStr += "&attachUrls=" + $("#attachUrls").val();
		paraStr += "&content=" + $("#content").val();
		paraStr += "&picUrl=" + $("#picUrl").val();
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
					window.top.$.dialog.get('video_add').close();
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