
//页面校验
$(function(){
	// 加载字典信息
	generateDict('DICT_COMPANY_CATEGORY','category','企业类别');
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
	//企业管理员账号
	$("#companyUsername").formValidator({
		onshow: "请填写企业管理员用户名",
		onfocus: "只能是2-12的字符，可以汉字，字母下划线开头",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^[0-9a-zA-Z\\u4e00-\\u9fa5_]{2,12}$",
		onerror: "只能是2-12的字符，可以汉字，字母下划线开头!"
	});
	//企业管理员密码
	$("#companyPassword").formValidator({
		onshow: "请填写密码",
		onfocus: "只能输入6-20个字符!",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{6,20}$",
		onerror: "只能输入6-20个字符!"
	});
	//新闻类别下拉框
	$("#category").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择企业类别了!"
	});
});

/**
 * 添加过滤
 * @param path
 * @return
 */
function add() {
	if($.formValidator.pageIsValid()) { // 表单提交进行校验
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
		paraStr += "&username=" + $("#companyUsername").val();
		paraStr += "&password=" + $("#companyPassword").val();


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
					window.top.$.dialog.get('company_add').close();
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