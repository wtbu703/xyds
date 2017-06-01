
//打开添加页面
function openadd(){
	$.dialog({id:'company_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加企业',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'company_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#name').val())) {
		window.top.art.dialog({
		content: '至少有一个查询条件不为空！',
		lock: true,
		width: 250,
		height: 100,
		border: false,
		time: 2
	});
		return ;
	}
	var paraStr = "&name="+$('#name').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
