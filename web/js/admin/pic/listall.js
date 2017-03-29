//打开修改页面
function update(categoryCode,categoryName) {
	$.dialog({id:'category_update'}).close();
	var url = findOneUrl+'&picCode='+categoryCode+'&action=update';
	$.dialog.open(url,{
		title: '修改图片类别--'+categoryName,
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'category_update',
		drag:true
	});
}

//查看详情
function detail(categoryCode,categoryName) {
	$.dialog({id:'category_detail'}).close();
	var url = findOneUrl+'&picCode='+categoryCode+'&action=detail';
	$.dialog.open(url,{
		title: categoryName+'详情',
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'category_detail',
		drag:true
	});
}

// 单一删除
function deleteOne(categoryCode){
    var paraStr = 'picCode='+categoryCode;
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
	var len=$("input[name='categoryCode']:checked").size()-1;
	var categoryCodes='';
	$("input[name='categoryCode']:checked").each(function(i, n){
		if(i<len-1){
            categoryCodes += $(n).val() + '-';
		}else{
            categoryCodes += $(n).val();
		}
	});
	if(categoryCodes=='') {
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
		var paraStr = 'picCodes='+categoryCodes;
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