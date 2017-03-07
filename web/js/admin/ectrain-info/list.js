
//打开添加页面
function openadd(){
	$.dialog({id:'info_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加培训详情',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'info_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#trainId').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&trainId="+$('#trainId').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
