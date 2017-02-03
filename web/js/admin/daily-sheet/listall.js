//打开修改页面
function update(id,date) {
	$.dialog({id:'sheet_update'}).close();
	var url = findOneUrl+'&id='+id+'&action=update';
	$.dialog.open(url,{
		title: '修改'+date+'报表',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'sheet_update',
		drag:true
	});
}

//查看详情
function detail(id,date) {
	$.dialog({id:'sheet_detail'}).close();
	var url = findOneUrl+'&id='+id+'&action=detail';
	$.dialog.open(url,{
		title: date+'报表详情',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'sheet_detail',
		drag:true
	});
}

// 单一删除
function deleteOne(id){
    var paraStr = 'id='+id;
    if (confirm('您确定要删除吗？')) {
        $.ajax({
            url: deleteOneUrlUrl,
            type: "post",
            dataType: "text",
            data:paraStr ,
            async: "false",
            success: function () {
                $('#pageForm').submit();
            },
            error:function(){
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

//多选删除操作
function deleteMore(){
	var len=$("input[name='id']:checked").size()-1;
	var ids='';
	$("input[name='id']:checked").each(function(i, n){
		if(i<len-1){
            ids += $(n).val() + '-';
		}else{
            ids += $(n).val();
		}
	});
	if(ids=='') {
		window.top.art.dialog({
            content:'请选择至少一条数据',
            lock:true,
            width:'200',
            height:'50',
            border: false,
            time:1.5
        },function(){}
        );
		return false;
	}else{
		var paraStr = 'ids='+ids;
		$.ajax({
			url: deleteMoreUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
			async: "false",
			success: function () {
				$('#pageForm').submit();
			},
			error:function(){
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