// 加载字典信息
$(document).ready(function(){
    generateDict('DICT_COUNTYTYPE','type','类型');
});
var Twidth = $(window).width();
var Theight = $(window).height();

//打开添加页面
function openadd(){

	$.dialog({id:'site_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加服务站点',
		width: Twidth,
		height:Theight,
		lock: true,
		border: false,
		id: 'site_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#code').val()) && str_is_null($('#name').val())  && str_is_null($('#type').val())) {
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
	var paraStr = "&code="+$('#code').val()+"&name="+$('#name').val()+"&type="+$('#type').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
