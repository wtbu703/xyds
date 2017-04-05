// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_STATE','state','状态');
	generateDict('DICT_SIGN','sign','来源种类');
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

	//验证标题是否为空
	$("#title").formValidator({
				onshow:"请选择来源种类！",
				onfocus:"请选择来源种类！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请选择来源种类！"})


})


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "&id="+$("#id").val();
		paraStr += "&sign=" + $("#sign").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&source=" + $("#source").val();
		paraStr += "&url=" + $("#url").val();
		paraStr += "&content=" + $("#content").val();
		paraStr += "&picUrl=" + $("#picUrl").val();
		paraStr += "&duration=" + $("#duration").val();
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