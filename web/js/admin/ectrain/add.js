$(document).ready(function(){

	generateDict('DICT_ECTRAIN_CATEGORY','category','培训类别');
	generateDict('DICT_PERIOD','period','培训期数');
})
//页面校验
$(function(){
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

	// 校验模型名称					
	$("#name").formValidator({
				onshow: "请输入培训名称",
				onfocus: "标题内容不超过32个字",
				oncorrect: "输入正确"
			})
			.regexValidator({
				regexp: "^.{1,32}$",
				onerror: "标题内容不超过32个字!"
			});
	$("#category").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择培训类别了!"
	});
	$("#period").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择第多少期了!"
	});
	$("#dayNum").formValidator({
		onshow: "请输入培训天数",
		onfocus: "不超过3位数",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,3}$",
		onerror: "不超过3位数!"
	});
	$("#peopleNum").formValidator({
		onshow: "请输入培训人数",
		onfocus: "不超过3位数 ",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,3}$",
		onerror: "不超过3位数!"
	});
	$("#publisher").formValidator({
		onshow: "请输入发布人",
		onfocus: "不超过16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,16}$",
		onerror: "不超过16个字!"
	});


});

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