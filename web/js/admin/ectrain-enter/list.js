
//打开添加页面
function openadd(){
	$.dialog({id:'enter_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加培训报名信息',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'enter_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#truename').val())) {
        $('.checkTip').html('查询条件不为空');
		return ;
	}
	var paraStr = "&truename="+$('#truename').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
