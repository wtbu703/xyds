//页面校验
$(function(){
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });
	//名称
	$("#name").formValidator({
		onshow: "请输入企业名称",
		onfocus: "企业名称1-16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,16}$",
		onerror: "企业名称1-16个字!"
	});
	//法人
	$("#corporate").formValidator({
		onshow: "请输入法人名字",
		onfocus: "法人名字不超过8个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,8}$",
		onerror: "法人名字不超过8个字!"
	});
	//地址
	$("#address").formValidator({
		onshow: "请输入地址",
		onfocus: "地址字数6-64个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{6,64}$",
		onerror: "地址字数6-64个字!"
	});
	//网址
	$("#webSite").formValidator({
		onshow: "请输入网址",
		onfocus: "例如：https://www.baidu.com/",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"[a-zA-z]+://[^\\s]*",
		onerror: "您输入的格式错误!"
	});
	//来源
	$("#sources").formValidator({
		onshow: "请输入来源",
		onfocus: "来源1-16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,16}$",
		onerror: "来源1-16个字!"
	});
	//电话
	$("#tel").formValidator({
		onshow: "请输入电话",
		onfocus: "例如：010-12345678或者13343411562",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"(^(\\d{2,4}[-_－—]?)?\\d{3,8}([-_－—]?\\d{3,8})?([-_－—]?\\d{1,7})?$)|(^0?1[3|4|5|7|8]\\d{9}$)",
		onerror: "您输入的格式错误!"
	});
	//新闻类别下拉框
	$("#category").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 0,  //开始索引
		onerror: "你是不是忘记选择新闻类别了!"
	});
});
function edit(type){
	if($.formValidator.pageIsValid()) { // 表单提交进行校验
		var paraStr = "";
		paraStr += "id=" + $("#id").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&address=" + $("#address").val();
		paraStr += "&tel=" + $("#tel").val();
		paraStr += "&corporate=" + $("#corporate").val();
		paraStr += "&introduction=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&logoUrl=" + $("#picUrl").val();
		paraStr += "&sources=" + $("#sources").val();
		paraStr += "&webSite=" + $("#webSite").val();
		paraStr += "&category=" + $("#category").val();
		$.ajax({
			url: updateUrl,
			type: "post",
			dataType: "text",
			data: paraStr,
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
				if (type == '0') {

					art.dialog.parent.location.reload();
					window.top.$.dialog.get('company_update').close();
				} else {
					art.dialog.parent.$('#pageForm').submit();
					window.top.$.dialog.get('company_update').close();
				}

			},
			error: function (data) {
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
