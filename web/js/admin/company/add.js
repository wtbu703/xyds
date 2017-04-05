// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_COMPANY_CATEGORY','category','企业类别');
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
	$("#name").formValidator({
		onshow:"请输入企业名称！",
		onfocus:"请输入企业名称！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入企业名称！"})
	$("#corporate").formValidator({
				onshow:"请输入企业法人！",
				onfocus:"请输入企业法人！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入企业法人！"})
	$("#picUrl").formValidator({
				onshow:"请上传企业logo！",
				onfocus:"请上传企业logo！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请上传企业logo！"})
	$("#category").formValidator({
				onshow:"请输入企业类别！",
				onfocus:"请输入企业类别！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入企业类别！"})
})

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "name=" + $("#name").val();
		paraStr += "&introduction=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&tel=" + $("#tel").val();
		paraStr += "&address=" + $("#address").val();
		paraStr += "&logoUrl=" + $("#picUrl").val();
		paraStr += "&corporate=" + $("#corporate").val();
		paraStr += "&sources=" + $("#sources").val();
		paraStr += "&webSite=" + $("#webSite").val();
		paraStr += "&category=" + $("#category").val();

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
					window.top.$.dialog.get('company_add').close();
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