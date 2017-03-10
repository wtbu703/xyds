//打开上传页面
function uploadExcel(){
	$.dialog({id:'upload_excel'}).close();
	$.dialog.open(uploadExcelUrl, {
		title: '上传EXCEL文件',
		width: 600,
		height:400,
		lock: true,
		border: false,
		id: 'upload_excel',
		drag:true
	});
}
//打开添加页面
function openadd(){
	$.dialog({id:'economic_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加年表',
		width: 700,
		height:550,
		lock: true,
		border: false,
		id: 'economic_add',
		drag:true
	});
}

//查询功能
function search(){
	if(str_is_null($('#year').val())) {
        $('.checkTip').html('查询条件不为空');
		return ;
	}
	var paraStr = "&year="+$('#year').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
