
//打开修改页面
function openedit(dictCode,dictName) {
	$.dialog({id:'dict_edit'}).close();
	var url = editUrl+'&dictCode='+dictCode;
	$.dialog.open(url,{
		title: '修改字典组'+'--'+dictName,
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'dict_edit',
		drag:true
	});
}

//查看详情
function detail(dictCode,dictName) {
	$.dialog({id:'dict_detail'}).close();
	var url = getdictdetailUrl+'&dictCode='+dictCode;
	$.dialog.open(url,{
		title: '字典组详情'+'--'+dictName,
		width: 800,
		height:500,
		lock: true,
		border: false,
		id: 'dict_detail',
		drag:true
	});
}

//删除字典操作
function delopt(){
	var len=$("input[name='dictCode']:checked").size()-1;
	var ids='';
	$("input[name='dictCode']:checked").each(function(i, n){
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
			url: deldictallUrl,
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

// 单一删除
function deleteDict(dictId){
	var paraStr = 'dictCode='+dictId;
	if (confirm('您确定要删除吗？')) {
		$.ajax({
			url: deldictUrl,
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