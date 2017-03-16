//打开添加页面
function openadd(){
	$.dialog({id:'build_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加第三方服务',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'build_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#companyName').val())) {
        $('.checkTip').html('查询条件不能为空');
		return ;
	}
	var paraStr = "&companyName="+$('#companyName').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
