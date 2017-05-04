
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称					
	$("#position").formValidator({
		onshow:"请输入职位！",
		onfocus:"请输入职位！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入职位！"})

})

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "&position=" + $("#position").val();
		paraStr += "&demand=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&mobile=" + $("#mobile").val();
		paraStr += "&tel=" + $("#tel").val();
		paraStr += "&email=" + $("#email").val();
		paraStr += "&contacts=" + $("#contacts").val();
		paraStr += "&workPlace=" + $("#workPlace").val();
		paraStr += "&record=" + $("#record").val();
		paraStr += "&salary=" + $("#salary").val();
		paraStr += "&exp=" + $("#exp").val();
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
					window.top.$.dialog.get('recruit_add').close();
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