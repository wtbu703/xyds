function addAdminControl(roleId){
	var len=$("input[name='id']:checked").size();
	var ids='';
	$("input[name='id']:checked").each(function(i, n){
		if(i<len-1){
			ids += $(n).val() + '-';
		}else{
			ids += $(n).val();
		}
	});
	if(ids=='') {
		window.top.art.dialog({content:'请选择至少一条数据',lock:true,width:'200',height:'50',border: false,time:1.5},function(){});
		return false;
	}else{
		var paraStr = 'ids='+ids;
		$.ajax({
			url: AddOneAdminControlUrl,
			type: "post",
			dataType: "text",
			data:paraStr+'&roleId='+roleId ,
			async: "false",
			success: function (data) {
				window.top.art.dialog({
					content: '添加成功！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
				});
                art.dialog.parent.location.href = adminControlUrl+'&id='+roleId;
                window.top.$.dialog.get('role_adminadd').close();
			},
			error:function(data){
				window.top.art.dialog({
					content: '添加失败！',
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
