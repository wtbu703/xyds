//打开修改页面
/*function openedit(id,truename) {
	$.dialog({id:'enter_update'}).close();
	var url = editUrl + '&id='+id;
	$.dialog.open(url,{
		title: '修改培训报名信息--'+truename,
		width: 700,
		height:500,
		lock: true,
		border: false,
		id: 'enter_update',
		drag:true
	});
}*/

/**
 * 多选导出到excel
 */
function excelById(){
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
	} else {
        art.dialog.parent.location.href = excelByIdUrl+'&ids='+ids
	}
}
/**
 * 审核报名
 */
function examine(state){
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
		var paraStr = 'ids='+ids+'&state='+state;
		$.ajax({
			url: examineUrl,
			type: "post",
			dataType: "text",
			data:paraStr,
			async: "false",
			success: function (data) {
				window.top.art.dialog({
					content: '提交成功！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
					$('#pageForm').submit();
				});
			},
			error:function(data){
				window.top.art.dialog({
					content: '提交失败！',
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
 * 删除一个用户
 */
/*function deleteEnter(id){
	var paraStr = "";
	paraStr = "id=" + id;
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
					$('#pageForm').submit();
				});
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
}*/

/**
 * 打开用户详情
 * @param nowPage
 * @return
 */
function detail(id,truename){
	$.dialog({id:'enter__detail'}).close();
	var url = detailUrl+'&id='+id;
	$.dialog.open(url,{
		title: '联系信息--'+truename,
		width: 700,
		height:500,
		lock: true,
		border: false,
		id: 'enter_detail',
		drag:true
	});
}