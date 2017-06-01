//页面校验
$(function(){
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });
	//网店名称
	$("#shopName").formValidator({
		onshow: "请填写网店名称!",
		onfocus: "网店名称最多18个字",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,18}$",
		onerror: "网店名称最多18个字!"
	});
	//网店链接
	$("#shopLink").formValidator({
		onshow: "请填写网店链接!",
		onfocus: "例如：https://www.baidu.com/",
		oncorrect: "输入正确"
	}).regexValidator({
		regexp:"[a-zA-z]+://[^\\s]*",
		onerror: "您输入的格式错误!"
	});
	//网店平台下拉框
	$("#platform").formValidator({
		onshow: "选择不能为空!",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 0,  //开始索引
		onerror: "你是不是忘记选择平台了!"
	});
});


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "id=" + $("#id").val();
		paraStr += "&shopName=" + $("#shopName").val();
		paraStr += "&shopLink=" + $("#shopLink").val();
		paraStr += "&platform=" + $("#platform").val();

				$.ajax({
					url: updateUrl,
					type: "post",
					dataType: "text",
					data:paraStr ,
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
						art.dialog.parent.$('#pageForm').submit();
						window.top.$.dialog.get('shoplink_update').close();
					},
					error:function(data){
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