// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_ARTICLE_CATEGORY','category','文章类别');
})
//打开添加页面
function openadd(){
	$.dialog({id:'article_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加文章',
		width: 800,
		height:600,
		lock: true,
		border: false,
		id: 'article_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#title').val()) && str_is_null($('#author').val())&& str_is_null($('#category').val())&& str_is_null($('#articledateTime_1').val())&& str_is_null($('#articledateTime_2').val()) ) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&title="+$('#title').val()+"&author="+$('#author').val()+"&category="+$('#category').val()+"&articledateTime_1="+$('#articledateTime_1').val()+"&articledateTime_2="+$('#articledateTime_2').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
