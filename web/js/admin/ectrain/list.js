// 加载字典信息
$(document).ready(function(){
	generateDict('DICT_ECTRAIN_CATEGORY','category','培训类别');
	generateDict('DICT_PERIOD','period','培训期数');
});
//打开添加页面
function openadd(){
	$.dialog({id:'contact_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加培训信息',
		width: 800,
		height:550,
		lock: true,
		border: false,
		id: 'ectrain_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#name').val())&&str_is_null($('#category').val())&&str_is_null($('#period').val())&&str_is_null($('#ectraindateTime_1').val())&&str_is_null($('#ectraindateTime_2').val())) {
        $('.checkTip').html('查询条件不为空');
		return ;
	}
	var paraStr = "&name="+$('#name').val()+"&category="+$('#category').val()+"&period="+$('#period').val()+"&ectraindateTime_1="+$('#ectraindateTime_1').val()+"&ectraindateTime_2="+$('#ectraindateTime_2').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
