// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_STATE','categoryState','状态');
});

//打开添加页面
function openadd(){
	$.dialog({id:'category_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加商品大类',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'category_add',
		drag:true
	});
}
//查询功能
function search(){
	if(str_is_null($('#categoryName').val()) && str_is_null($('#categoryState').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&categoryName="+$('#categoryName').val()+"&state="+$('#categoryState').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
