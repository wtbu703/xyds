// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_PLATFORM','platform','网店平台');
});
//打开添加页面
function openadd(){
	$.dialog({id:'shoplink_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加网店链接',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'shoplink_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#shopName').val())&& str_is_null($('#platform').val())) {
        $('.checkTip').html('至少有一个查询条件不为空')
		return ;
	}
	var paraStr = "&shopName="+$('#shopName').val()+"&platform="+$('#platform').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
