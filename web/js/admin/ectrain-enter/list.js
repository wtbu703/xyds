// 加载字典信息
$(document).ready(function(){
    generateDict('DICT_ENTER_STATE','state','状态');
});

//导出全部到excel
function excelAll(id){
    art.dialog.parent.location.href = excelAllUrl+'&id='+id;
}

//查询功能
function search(id){
	if(str_is_null($('#truename').val())&&str_is_null($('#state').val())) {
        window.top.art.dialog({
            content: '查询条件不能为空',
            lock: true,
            width: 250,
            height: 100,
            border: false,
            time: 2
        }, function () {});
		return ;
	}
	var paraStr = "&truename="+$('#truename').val()+"&state="+$('#state').val()+"&trainId="+id;
	$('#iframeId').attr('src',listallUrl+paraStr);
}
