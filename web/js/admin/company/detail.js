//打开修改页面
function openedit(id,name) {
	$.dialog({id:'company_update'}).close();
	var url = editUrl + '&id='+id;
	$.dialog.open(url,{
		title: '修改企业--'+name,
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'company_update',
		drag:true
	});
}
