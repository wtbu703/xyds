// 关闭添加页面
function closeWin(){
	window.top.$.dialog.get('menu_add').close();
}

$(function(){
	$.formValidator.initConfig({
		formid:"myform",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj)
		{window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	//校验菜单名称
	$("#menuName").formValidator({
		onshow:"请输入菜单名称",
		onfocus:"菜单名称必须是汉字"})
		.inputValidator({                  //校验不能为空
			min:1,
			onerror:"请输入菜单名称"})
	// 校验菜单排序					
	$("#menuOrder").formValidator({
		onshow:"请输入菜单排序",
		onfocus:"必须是数字"})
		.regexValidator({              //
				regexp:"num1",
				datatype:"enum",
				param:'i',
				onerror:"只能是数字"});	
	})
	
	
//获取页面数据
function addMenu(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr += "menuLevel="+$("#menuLevel").val();
		paraStr += "&menuName="+$("#menuName").val();
		paraStr += "&menuUrl="+$("#menuUrl").val();
		paraStr += "&uplevelMenu="+$("#uplevelMenu").val();
		paraStr += "&orderBy="+$("#orderBy").val();
		$.ajax({
			url: saveoneUrl,
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
					parent.document.getElementById('center_frame').src=treeUrl;
					closeWin();
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