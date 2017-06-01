// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_ARTICLE_CATEGORY','category','文章类别');
})
//页面校验
$(function() {
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

	// 校验模型名称					
	$("#title").formValidator({
				onshow: "请输入文章标题",
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
		onerror: "你是不是忘记选择文章类别了!"
	});

	$("#author").formValidator({
		onshow: "请输入文章作者",
		onfocus: "不超过16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,16}$",
		onerror: "不超过16个字!"
	});
	$("#sourceUrl").formValidator({
		onshow: "请输入文章来源",
		onfocus: "不超过16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,16}$",
		onerror: "不超过16个字!"
	});
	//关键词
	$("#keyword").formValidator({
		onshow: "请输入关键词",
		onfocus: "例如：农村电商 农村创业",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{2,18}$",
		onerror: "您输入的格式错误!"
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
		paraStr += "title=" + $("#title").val();
		paraStr += "&author=" + $("#author").val();
		paraStr += "&sourceUrl=" + $("#sourceUrl").val();
		paraStr += "&keyword=" + $("#keyword").val();
		paraStr += "&content=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&category=" + $("#category").val();
		paraStr += "&attachUrls=" + $("#attachUrls").val();
		paraStr += "&attachNames=" + $("#attachNames").val();
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
					window.top.$.dialog.get('article_add').close();
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