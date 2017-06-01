
//打开添加页面
function openadd(){
	$.dialog({id:'news_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加新闻',
		width: 700,
		height:500,
		lock: true,
		border: false,
		id: 'news_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#title').val())&&str_is_null($('#keyword').val())&&str_is_null($('#newsdateTime_1').val())&&str_is_null($('#newsdateTime_2').val())) {
		window.top.art.dialog({
			content: '至少有一个查询条件不为空！',
			lock: true,
			width: 250,
			height: 100,
			border: false,
			time: 2
		});
		return ;
	}
	var paraStr = "&title="+$('#title').val()+"&keyword="+$('#keyword').val()+"&newsdateTime_1="+$('#newsdateTime_1').val()+"&newsdateTime_2="+$('#newsdateTime_2').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
