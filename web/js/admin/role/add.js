// 加载字典信息
$(document).ready(function(){
	//generateState();
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
	$("#name").formValidator({
		onshow:"请输入角色名称！",
		onfocus:"请输入角色名称！"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入角色名称！"})
		.ajaxValidator({					// 校验不许重复
				type:"get",
				url:checknameUrl,
				data:{
					'name':$("#name").val()
				},
				datatype:"text",
				async:'true',
				success:function(data){
                    return data != "exist";
				},
				buttons: $("#dosubmit"),  // 页面提示----"输入正确"
				onerror : "角色名称已存在",
				onwait : "正在连接，请稍候。"});


});


/**
 * 添加过滤
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = '';
		paraStr = "name=" + $('#name').val();
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
					art.dialog.parent.location.href = listUrl;
					window.top.$.dialog.get('role_add').close();

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