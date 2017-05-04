
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称

	//验证培训名是否为空
	$("#name").formValidator({
				onshow:"请输入培训名！",
				onfocus:"请输入培训名！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入培训名！"})

})


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "&id=" + $("#id").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&category=" + $("#category").val();
		paraStr += "&content=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&dayNum=" + $("#dayNum").val();
		paraStr += "&period=" + $("#period").val();
		paraStr += "&peopleNum=" + $("#peopleNum").val();
		paraStr += "&target=" + $("#target").val();
		paraStr += "&publisher=" + $("#publisher").val();
		paraStr += "&picUrl=" + $("#picUrl").val();
		paraStr += "&thumbnailUrl=" + $("#thumbnailUrl").val();
		paraStr += "&beginTime=" + $('#beginTime').val();
		paraStr += "&endTime=" + $('#endTime').val();
		paraStr += "&time=" + $('#time').val();

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
				window.top.$.dialog.get('ectrain_update').close();
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