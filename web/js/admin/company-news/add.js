// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_NEW_CATEGORY','category','企业类别');
});
//页面校验
$(function(){
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });
	//新闻标题
	$("#title").formValidator({
		onshow: "请输入新闻标题",
		onfocus: "标题内容不超过32个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,32}$",
		onerror: "标题内容不超过32个字!"
	});
	//新闻来源
	$("#author").formValidator({
		onshow: "请输入新闻来源",
		onfocus: "标题内容不超过16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,16}$",
		onerror: "标题内容不超过16个字!"
	});
	//关键词
	$("#keyword").formValidator({
		onshow: "请输入关键词",
		onfocus: "例如：农村电商 农村创业",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{2,18}$",
		onerror: "关键词2-18个字!"
	});
	//新闻类别下拉框
	$("#category").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择新闻类别了!"
	});
});

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()) { // 表单提交进行校验
		var paraStr = "";
		paraStr += "companyId=" + $("#companyId").val();
		paraStr += "&title=" + $("#title").val();
		paraStr += "&category=" + $("#category").val();
		paraStr += "&author=" + $("#author").val();
		paraStr += "&content=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&keyword=" + $("#keyword").val();
		paraStr += "&attachUrl=" + $("#attachUrls").val();
		paraStr += "&attachName=" + $("#attachNames").val();
		paraStr += "&picUrl=" + $("#picUrl").val();

		$.ajax({
			url: insertUrl,
			type: "post",
			dataType: "text",
			data: paraStr,
			async: "false",
			success: function (data) {
				if (data == "success") {
					window.top.art.dialog({
						content: '添加成功！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
					window.top.$.dialog.get('news_add').close();
					art.dialog.parent.document.getElementById("iframeId").src = listallUrl;
				} else {
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
			error: function (data) {
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