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
	var paraStr = "&categoryName="+$('#categoryName').val()+"&state="+$('#categoryState').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
