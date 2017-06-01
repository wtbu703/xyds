$(function(){
	$.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

	$("#GRP").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#socialConsumerTotal").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#area").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#townNum").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#villageNum").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#permanentPopulation").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#urbanPopulation").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#ruralPopulation").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#disposableIncome").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#urbanDisposableIncome").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#ruralDisposableIncome").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#ruralRoadMileage").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#telUser").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#mobileUser").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#34GUser").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#internetAccess").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#individualHousehold").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#registeredCompany").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#onlineStore").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#mobileStore").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#ecTurnover").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	$("#netRetailSales").formValidator({
		onshow: "请输入数据",
		onfocus: "例如：20.1",
		oncorrect: "输入正确"
	}).inputValidator({               //校验不能为空
		min: 1,
		onerror: "请输入数据！"
	});
	//年份类别下拉框
	$("#year").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择年份了!"
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
					window.top.$.dialog.get('economic_add').close();
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