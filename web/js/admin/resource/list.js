//打开添加页面
function openadd(){
	$.dialog({id:'resource_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加资源组',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'resource_add',
		drag:true
	});
}

//查询功能
function search(){
    if(str_is_null($('#tableName').val())) {
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
    var paraStr = "&tableName="+$('#tableName').val();
    $('#iframeId').attr('src',listallUrl+paraStr);
}