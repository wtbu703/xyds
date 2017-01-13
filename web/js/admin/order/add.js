// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_ORDERSTATE','orderState','状态');
})
//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
		window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
		}});
	// 校验模型名称					
	$("#title").formValidator({
		onshow:"请输入名字！",
		onfocus:"请输入名字！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入名字！"})


})

/**
 * 添加过滤
 * @param path
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "userID=" + $("#userID").val();
		paraStr += "&name=" + $("#name").val();
		paraStr += "&mobile=" + $("#mobile").val();
		paraStr += "&postCode=" + $("#postCode").val();
		paraStr += "&address=" + $("#address").val();
		paraStr += "&cost=" + $("#cost").val();
		paraStr += "&orderState="+$('#orderState').val();
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
					window.top.$.dialog.get('order_add').close();
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