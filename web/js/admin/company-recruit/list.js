
//打开添加页面
function openadd(){
	$.dialog({id:'recruit_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加招聘信息',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'recruit_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#position').val())) {
        $('.checkTip').html('查询条件不为空');
		return ;
	}
	var paraStr = "&position="+$('#position').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
