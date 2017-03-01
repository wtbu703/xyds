//打开添加页面
function openadd(){
	$.dialog({id:'build_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加支持开展农村电商情况',
		width: 1000,
		height:700,
		lock: true,
		border: false,
		id: 'build_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#name').val())) {
        $('.checkTip').html('查询条件不能为空');
		return ;
	}
	var paraStr = "&name="+$('#name').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
