// 加载字典信息
$(document).ready(function(){
    generateDict('DICT_STATE','state','状态');
    generateRole();
});

function generateRole(){
     var dictArray = [];
     dictArray.push("<option value=''><--请选择角色--></option>");
     $.ajax({
     url:listRoleUrl,
     type:"post",
     dataType:"json",
     async:false,
     success:function(data){
     $.each(data,function(i,n){
     dictArray.push("<option value='"+ n.id +"'>"+ n.name +"</option>");
     });
     $('#role').html(dictArray.join(''));
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
	if(str_is_null($('#username').val()) && str_is_null($('#truename').val())  && str_is_null($('#state').val())&& str_is_null($('#role').val())) {
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
	var paraStr = "&username="+$('#username').val()+"&truename="+$('#truename').val()+"&state="+$('#state').val()+"&role="+$('#role').val();
	$('#iframeId').attr('src',listallUrl+paraStr);
}
