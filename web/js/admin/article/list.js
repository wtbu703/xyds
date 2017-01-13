
//打开添加页面
function openadd(){
	$.dialog({id:'article_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加文章',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'article_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#title').val()) && str_is_null($('#author').val()) ) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&title="+$('#title').val()+"&author="+$('#author').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
