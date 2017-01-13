// 加载字典信息
$(document).ready(function(){

	generateState();
})
//生成状态下拉框
function generateState(){
	var dictArray = new Array();
	dictArray.push("<option value=''><--请选择状态--></option>");//updated by ly
	$.ajax({
		url:listdictUrl,
		type:"post",
		dataType:"json",
		data:"dictCode=DICT_STATE",
		async:false,
		success:function(data){
			$.each(data,function(i,n){
				dictArray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
			});
			$('#state').html(dictArray.join(''));
		},
		error:function (data) {
			window.top.art.dialog({content:'加载字典组出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		}
	});

}



//打开添加页面
function openadd(){
	$.dialog({id:'admin_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加管理员',
		width: 700,
		height:300,
		lock: true,
		border: false,
		id: 'admin_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#username').val()) && str_is_null($('#truename').val())  && str_is_null($('#state').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
		return ;
	}
	var paraStr = "&username="+$('#username').val()+"&truename="+$('#truename').val()+"&state="+$('#state').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
