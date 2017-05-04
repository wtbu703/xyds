// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_STATE','dictState','状态');
})

//打开添加页面
function openadd(){
	$.dialog({id:'dict_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加字典组',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'dict_add',
		drag:true
	});
}
//查询功能
function search(){
	if(str_is_null($('#dictName').val()) && str_is_null($('#dictState').val())) {
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
	var paraStr = "&dictName="+$('#dictName').val()+"&state="+$('#dictState').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
