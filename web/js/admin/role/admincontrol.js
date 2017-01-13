/**
 * 删除多个用户对应角色关系
 */
function delopt(roleId) {
	var len = $("input[name='id']:checked").size()-1;
	var ids = '';
	$("input[name='id']:checked").each(function(i, n){
		if(i<len){
			ids += $(n).val() + '-';
		}else{
			ids += $(n).val();
		}
	});
	if(ids=='') {
		window.top.art.dialog({content:'请选择至少一条数据',lock:true,width:'200',height:'50',border: false,time:1.5},function(){});
		return;
	} else {
	var paraStr = 'ids='+ids+'&roleId='+roleId;
		$.ajax({
			url:deleteMoreAdminAccessUrl,
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
				art.dialog.parent.location.href = adminControlUrl+'&id='+roleId;
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



/**
 * 删除一个用户对应角色关系
 */
function deleteAccess(adminId,roleId) {
	var paraStr = "";
	paraStr = "id=" + adminId+"&roleId="+roleId;
	if (confirm('您确定要删除吗？')){
		$.ajax({
			url: deleteAdminAccessUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
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

function openAddAdminAccess(id,name) {
	$.dialog({id:'role_adminadd'}).close();
	var url = adminAddAccessUrl+'&id='+id+'&name='+name;
	$.dialog.open(url,{
		title: '分配用户'+'--'+name,
		width: 1100,
		height:400,
		lock: true,
		border: false,
		id: 'role_adminadd',
		drag:true
	});
}