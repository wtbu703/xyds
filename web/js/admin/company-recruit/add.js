
//页面校验
$(function(){
	// 加载字典信息
	generateDict('DICT_RECORD','record','学历要求');
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });
	//职位名称
	$("#position").formValidator({
		onshow: "请填写职位名称!",
		onfocus: "职位名称最多16个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,16}$",
		onerror: "职位名称最多16个字!"
	});
	//薪资
	$("#salary").formValidator({
		onshow: "请填写薪资!",
		onfocus: "例如：面谈或3.0k-5.2k",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^\\d\\d?(\\.\\d)?((k|K)-){1}\\d\\d?(\\.\\d)?(k|K){1}$|^(\\u9762\\u8c08){1}$",
		onerror: "您输入的格式错误!"
	});
	//地址
	$("#workPlace").formValidator({
		onshow: "请输入地址!",
		onfocus: "地址字数6-64个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{6,64}$",
		onerror: "地址字数6-64个字!"
	});
	//经验要求
	$("#exp").formValidator({
		onshow: "请输入经验要求!",
		onfocus: "例如：不限或1年-3年",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^\\d\\d?((\\u5e74)-){1}\\d\\d?(\\u5e74){1}$|^(\\u4e0d\\u9650){1}$",
		onerror: "您输入的格式错误!"
	});
	//手机
	$("#mobile").formValidator({
		onshow: "请填写手机号码!",
		onfocus: "例如：13343411562",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^1(3|4|5|7|8)\\d{9}$",
		onerror: "您输入的格式错误!"
	});
	//电话
	$("#tel").formValidator({
		onshow: "请输入电话!",
		onfocus: "例如：010-12345678",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^(\\(\\d{3,4}\\)|\\d{3,4}-)?\\d{7,8}$",
		onerror: "您输入的格式错误!"
	});
	//学历下拉框
	$("#record").formValidator({
		onshow: "选择不能为空!",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择学历了!"
	});
	//邮箱
	$("#email").formValidator({
		onshow: "请填写邮箱!",
		onfocus: "例如：1234556789@qq.com",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"[\\w!#$%&'*+/=?^_`{|}~-]+(?:\\.[\\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\\w](?:[\\w-]*[\\w])?\\.)+[\\w](?:[\\w-]*[\\w])?",
		onerror: "您输入的格式错误!"
	});
	//联系人
	$("#contacts").formValidator({
		onshow: "请填写联系人!",
		onfocus: "联系人姓名不超过5个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^.{1,5}$",
		onerror: "联系人姓名不超过5个字!"
	});
});
//页面校验
/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()) { // 表单提交进行校验
			var paraStr = "";
			paraStr += "&position=" + $("#position").val();
			paraStr += "&demand=" + encodeURIComponent(contentEditor.getData());
			paraStr += "&mobile=" + $("#mobile").val();
			paraStr += "&tel=" + $("#tel").val();
			paraStr += "&email=" + $("#email").val();
			paraStr += "&contacts=" + $("#contacts").val();
			paraStr += "&place=" + $("#city").val();
			paraStr += "&workPlace=" + $("#workPlace").val();
			paraStr += "&record=" + $("#record").val();
			paraStr += "&salary=" + $("#salary").val();
			paraStr += "&exp=" + $("#exp").val();

			var city = $("#city").val();
			if(city == ''){
				alert('工作地区不能为空');
			}else{
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
							window.top.$.dialog.get('recruit_add').close();
							art.dialog.parent.document.getElementById("iframeId").src = listallUrl + "&type=0";
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


}