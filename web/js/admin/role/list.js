

//打开添加页面
function openadd(){
	$.dialog({id:'role_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加新角色',
		width: 700,
		height:100,
		lock: true,
		border: false,
		id: 'role_add',
		drag:true
	});
}

