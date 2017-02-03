//打开上传页面
function uploadExcel(){
	$.dialog({id:'upload_excel'}).close();
	$.dialog.open(addUrl, {
		title: '上传EXCEL文件',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'upload_excel',
		drag:true
	});
}
//查询功能
function search(){
    if(str_is_null($('#date1').val()) && str_is_null($('#date2').val())) {
        $('.checkTip').html('至少有一个查询条件不为空');
        return ;
    }
    var paraStr = "&date1="+$('#date1').val()+"&date2="+$('#date2').val();
    $('#iframeId').attr('src',listallUrl+paraStr);
}
