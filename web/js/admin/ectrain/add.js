$(document).ready(function(){

	generateDict('DICT_ECTRAIN_CATEGORY','category','培训类别');
	generateDict('DICT_PERIOD','period','培训期数');
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
		onshow:"请输入培训名！",
		onfocus:"请输入培训名！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入培训名！"})
	$("#category").formValidator({
				onshow:"请输入培训类别！",
				onfocus:"请输入培训类别！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入培训类别！"})
	$("#period").formValidator({
				onshow:"请输入培训期数！",
				onfocus:"请输入培训期数！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入培训期数！"})
	$("#dayNum").formValidator({
				onshow:"请输入培训天数！",
				onfocus:"请输入培训天数！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入培训天数！"})
	$("#peopleNum").formValidator({
				onshow:"请输入培训人数！",
				onfocus:"请输入培训人数！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入培训人数！"})
	$("#target").formValidator({
				onshow:"请输入针对人群！",
				onfocus:"请输入针对人群！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入针对人群！"})
	$("#publisher").formValidator({
				onshow:"请输入发布人！",
				onfocus:"请输入发布人！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入发布人！"})


})

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
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
					window.top.$.dialog.get('ectrain_add').close();
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