
//打开添加页面
function openadd(){
	$.dialog({id:'info_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加培训详情',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'info_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#trainId').val())) {
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
	var paraStr = "&trainId="+$('#trainId').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
