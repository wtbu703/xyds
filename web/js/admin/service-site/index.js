// 加载字典信息
$(document).ready(function(){
    generateDict('DICT_COUNTYTYPE','type','类型');
	//generateState();
});
//生成状态下拉框
/*function generateState(){
	var dictArray = new Array();
	dictArray.push("<option value=''><--请选择类型--></option>");
	$.ajax({
		url:listdictUrl,
		type:"post",
		dataType:"json",
		data:"dictCode=DICT_COUNTYTYPE",
		async:false,
		success:function(data){
			$.each(data,function(i,n){
				dictArray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
			});
			$('#type').html(dictArray.join(''));
		},
		error:function (data) {
			window.top.art.dialog({content:'加载字典组出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		}
	});

}*/

//打开添加页面
function openadd(){
	$.dialog({id:'site_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加服务站点',
		width: 800,
		height:600,
		lock: true,
		border: false,
		id: 'site_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#code').val()) && str_is_null($('#name').val())  && str_is_null($('#type').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&code="+$('#code').val()+"&name="+$('#name').val()+"&type="+$('#type').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
