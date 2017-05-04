//打开添加页面
function openadd(){
	$.dialog({id:'build_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加第三方服务',
		width: 800,
		height:600,
		lock: true,
		border: false,
		id: 'build_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#companyName').val())) {
        window.top.art.dialog({
            content: '查询条件不能为空',
            lock: true,
            width: 250,
            height: 80,
            border: false,
            time: 2
        }, function () {});
		return ;
	}
	var paraStr = "&companyName="+$('#companyName').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
