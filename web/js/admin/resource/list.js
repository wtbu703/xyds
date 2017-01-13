//打开添加页面
function openadd(){
	$.dialog({id:'resource_add'}).close();
	$.dialog.open(addUrl, {
		title: '添加资源组',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'resource_add',
		drag:true
	});
}

// 单一删除
function deleteResource(ResourceId){
    var paraStr = 'ResourceId='+ResourceId;
    if (confirm('您确定要删除吗？')) {
        $.ajax({
            url: deleteResourceUrl,
            type: "post",
            dataType: "text",
            data:paraStr ,
            async: "false",
            success: function (data) {
                $('#pageForm').submit();
            },
            error:function(data){
                window.top.art.dialog({
                    content: '删除失败！',
                    lock: true,
                    width: 250,
                    height: 80,
                    border: false,
                    time: 2
                }, function () {
                });
            }
        });
    }
}

//删除多个资源
function deleteMore() {
    var len = $("input[name='id']:checked").size();
    var ids = '';
    $("input[name='id']:checked").each(function(i, n){
        if(i<len-1){
            ids += $(n).val() + '-';
        }else{
            ids += $(n).val();
        }
    });
    if(ids=='') {
        window.top.art.dialog({content:'请选择至少一条数据',lock:true,width:'200',height:'50',border: false,time:1.5},function(){});
        return;
    } else {
        var paraStr = 'ids='+ids;
        $.ajax({
            url: deleteMoreUrl,
            type: "post",
            dataType: "text",
            data:paraStr,
            async: "false",
            success: function (data) {
                window.top.art.dialog({
                    content: '删除成功！',
                    lock: true,
                    width: 250,
                    height: 80,
                    border: false,
                    time: 2
                }, function () {
                });
                $('#pageForm').submit();
            },
            error:function(data){
                window.top.art.dialog({
                    content: '删除失败！',
                    lock: true,
                    width: 250,
                    height: 80,
                    border: false,
                    time: 2
                }, function () {
                });
            }
        });
    }
}