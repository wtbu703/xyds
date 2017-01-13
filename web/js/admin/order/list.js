// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_ORDERSTATE','orderState','状态');
})
//打开添加页面
function openadd(){
	$.dialog({id:'order_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加订单',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'order_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#orderNo').val()) && str_is_null($('#name').val()) && str_is_null($('#orderState').val()) && str_is_null($('#orderdateTime_1').val()) && str_is_null($('orderdateTime_2').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&orderNo="+$('#orderNo').val()+"&name="+$('#name').val()+"&orderState="+$('#orderState').val()+"&orderdateTime_1="+$('#orderdateTime_1').val()+"&orderdateTime_2="+$('#orderdateTime_2').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
