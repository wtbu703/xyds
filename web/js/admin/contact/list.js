
//打开添加页面
function openadd(){
	$.dialog({id:'contact_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加联系信息',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'contact_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#truename').val())) {
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
	var paraStr = "&truename="+$('#truename').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
