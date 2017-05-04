// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_PIC_CATEGORY','category','栏目');
});

//打开添加页面
function openadd(){
	$.dialog({id:'category_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加图片大类',
		width: 600,
		height:300,
		lock: true,
		border: false,
		id: 'category_add',
		drag:true
	});
}
//查询功能
function search(){
	if(str_is_null($('#category').val()) && str_is_null($('#category').val())) {
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
	var paraStr = "&category="+$('#category').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
