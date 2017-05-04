// 加载字典信息
$(document).ready(function(){

	generateDict('DICT_STATE','state','状态');
	generateDict('DICT_SIGN','sign','来源');
})
//打开添加页面
function openadd(){
	$.dialog({id:'video_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加视频',
		width: 750,
		height:600,
		lock: true,
		border: false,
		id: 'video_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#name').val()) && str_is_null($('#source').val()) && str_is_null($('#sign').val()) && str_is_null($('#state').val()) ) {

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
	var paraStr = "&name="+$('#name').val()+"&source="+$('#source').val()+"&sign="+$('#sign').val()+"&state="+$('#state').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
