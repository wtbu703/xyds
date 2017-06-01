
//页面校验
$(function(){
	// 加载字典信息
	generateDict('DICT_PRODUCT_STATE','state','状态');
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });
	//产品名称
	$("#name").formValidator({
		onshow: "请填写产品名称!",
		onfocus: "产品名称最多18个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,18}$",
		onerror: "产品名称最多18个字!"
	});
	//产品价格
	$("#price").formValidator({
		onshow: "请填写产品价格!",
		onfocus: "产品价格最多保留2位小数",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^(0|[1-9][0-9]{0,9})(\\.[0-9]{1,2})?$",
		onerror: "产品价格最多保留2位小数!"
	});
	//折扣
	$("#discount").formValidator({
		onshow: "请填写产品折扣!",
		onfocus: "产品折扣范围是0-10！",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^((?!0)\\d(\\.\\d{0,1})?|10)$",
		onerror: "产品折扣范围是0-10!"
	});
	//产品状态下拉框
	$("#state").formValidator({
		onshow: "选择不能为空!",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择产品类别了!"
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
		paraStr += "&name=" + $("#name").val();
		paraStr += "&introduction=" + encodeURIComponent(contentEditor.getData());
		paraStr += "&price=" + $("#price").val();
		paraStr += "&discount=" + $("#discount").val();
		paraStr += "&state=" + $("#state").val();
		paraStr += "&thumbnailUrl=" + $("#picUrl").val();


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
					window.top.$.dialog.get('product_add').close();
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