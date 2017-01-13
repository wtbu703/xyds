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
			url:deleteMoreRoleResourceUrl,
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
				art.dialog.parent.location.href = resourceControlUrl+'&id='+roleId;
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
function deleteAccess(resourceId,roleId) {
	var paraStr = "";
	paraStr = "resourceId=" + resourceId+"&roleId="+roleId;
	if (confirm('您确定要删除吗？')){
		$.ajax({
			url: deleteRoleResourceUrl,
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

function openAddRoleResource(id,name) {
	$.dialog({id:'role_resource'}).close();
	var url = addRoleResourceUrl+'&id='+id;
	$.dialog.open(url,{
		title: '分配新资源'+'--'+name,
		width: 1100,
		height:400,
		lock: true,
		border: false,
		id: 'role_resource',
		drag:true
	});
}