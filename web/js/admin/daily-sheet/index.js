//打开上传页面
function uploadExcel(){
	$.dialog({id:'upload_excel'}).close();
	$.dialog.open(uploadExcelUrl, {
		title: '上传EXCEL文件',
		width: 600,
		height:300,
		lock: true,
		border: false,
		id: 'upload_excel',
		drag:true
	});
}
//查询功能
function search(){
    if(str_is_null($('#date1').val()) && str_is_null($('#date2').val())) {
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
    var paraStr = "&date1="+$('#date1').val()+"&date2="+$('#date2').val();
    $('#iframeId').attr('src',listallUrl+paraStr);
}
