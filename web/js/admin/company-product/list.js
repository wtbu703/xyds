// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_PRODUCT_STATE','state','产品状态');
})
//打开添加页面
function openadd(){
	$.dialog({id:'product_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加产品',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'product_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#name').val())&& str_is_null($('#state').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&name="+$('#name').val()+"&state="+$('#state').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
