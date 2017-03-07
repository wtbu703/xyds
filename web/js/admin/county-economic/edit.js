$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称

	//验证标题是否为空
	$("#year").formValidator({
				onshow:"请输入年份！",
				onfocus:"请输入年份！"})
			.inputValidator({               //校验不能为空
				min:1,
				onerror:"请输入年份！"})


})


function edit(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "id="+$("#id").val();
		paraStr += "&year=" + $("#year").val();
		paraStr += "&GRP=" + $("#GRP").val();
		paraStr += "&socialConsumerTotal=" + $("#socialConsumerTotal").val();
		paraStr += "&area=" + $("#area").val();
		paraStr += "&townNum=" + $("#townNum").val();
		paraStr += "&villageNum=" + $("#villageNum").val();
		paraStr += "&permanentPopulation=" + $("#permanentPopulation").val();
		paraStr += "&urbanPopulation=" + $("#urbanPopulation").val();
		paraStr += "&ruralPopulation=" + $("#ruralPopulation").val();
		paraStr += "&disposableIncome=" + $("#disposableIncome").val();
		paraStr += "&urbanDisposableIncome=" + $("#urbanDisposableIncome").val();
		paraStr += "&ruralDisposableIncome=" + $("#ruralDisposableIncome").val();
		paraStr += "&ruralRoadMileage=" + $("#ruralRoadMileage").val();
		paraStr += "&telUser=" + $("#telUser").val();
		paraStr += "&mobileUser=" + $("#mobileUser").val();
		paraStr += "&34GUser=" + $("#34GUser").val();
		paraStr += "&internetAccess=" + $("#internetAccess").val();
		paraStr += "&individualHousehold=" + $("#individualHousehold").val();
		paraStr += "&registeredCompany=" + $("#registeredCompany").val();
		paraStr += "&onlineStore=" + $("#onlineStore").val();
		paraStr += "&mobileStore=" + $("#mobileStore").val();
		paraStr += "&ecTurnover=" + $("#ecTurnover").val();
		paraStr += "&netRetailSales=" + $("#netRetailSales").val();

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
				window.top.$.dialog.get('economic_update').close();
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