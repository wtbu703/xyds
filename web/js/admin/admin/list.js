// 加载字典信息
$(document).ready(function(){
    generateDict('DICT_STATE','state','状态');
});

//打开添加页面
function openadd(){
	$.dialog({id:'admin_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加管理员',
		width: 700,
		height:300,
		lock: true,
		border: false,
		id: 'admin_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#username').val()) && str_is_null($('#truename').val())  && str_is_null($('#state').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&username="+$('#username').val()+"&truename="+$('#truename').val()+"&state="+$('#state').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
