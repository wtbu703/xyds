//打开修改页面
function openedit(Id,Name) {
	$.dialog({id:'role_update'}).close();
	var url = editUrl + '&id='+Id;
	$.dialog.open(url,{
		title: '修改角色信息--'+Name,
		width: 700,
		height:200,
		lock: true,
		border: false,
		id: 'role_update',
		drag:true

	});

}

//删除多个角色
function deleteMore() {
	var len = $("input[name='id']:checked").size();
	var id = '';
	$("input[name='id']:checked").each(function(i, n){
		if(i<len-1){
			id += $(n).val() + '-';
		}else{
			id += $(n).val();
		}
	});
	if(id=='') {
		window.top.art.dialog({content:'请选择至少一条数据',lock:true,width:'200',height:'50',border: false,time:1.5},function(){});
	} else {
	var paraStr = 'id='+id;
		$.ajax({
			url: deleteallUrl,
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

				art.dialog.parent.location.href = listallUrl;
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
 * 删除一个角色
 */
function deleteRole(Id) {
	var paraStr = "";
	paraStr = "id=" + Id;
	if (confirm('您确定要删除吗？')){
		$.ajax({
			url: deleteUrl,
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

				art.dialog.parent.location.href = listallUrl;
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
 * 打开用户详情
 * @param nowPage
 * @return
 */
function detail(Id,Name){
	$.dialog({id:'role_detail'}).close();
	var url = detailUrl+'&id='+Id;
	$.dialog.open(url,{
		title: '角色信息--'+Name,
		width: 700,
		height:300,
		lock: true,
		border: false,
		id: 'role_detail',
		drag:true
	});
}

//打开分配权限页面
function accesscontrol(Id){
    window.parent.location.href= accesscontrolUrl+'&id='+Id;
}

//打开分配用户页面
function usercontrol(Id){
    window.parent.location.href= usercontrolUrl+'&id='+Id;
}

//打开分配资源页面
function ResourceControl(Id){
    window.parent.location.href= ResourceControlUrl+'&id='+Id;
}