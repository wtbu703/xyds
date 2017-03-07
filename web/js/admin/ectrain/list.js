
//打开添加页面
function openadd(){
	$.dialog({id:'contact_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加培训信息',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'ectrain_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#name').val())) {
        $('.checkTip').html('查询条件不为空');
		return ;
	}
	var paraStr = "&name="+$('#name').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
