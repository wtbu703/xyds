/**
 * 添加到数据库
 */
function addMore(){
	var len = $("input[name='id']").not("input:checked").size();
	var slen = $("input[name='id']:checked").size();
	var ids = '';
	var sid = '';

    $("input[name='id']").not("input:checked").each(function(i, n){
		if(i<len-1){
			ids += $(n).val() + '-';
		}else{
			ids += $(n).val();
		}
        /*titles += $(n).parent().parent().children("td").eq(2).text()+ '|';
        authors += $(n).parent().parent().children("td").eq(3).text()+ '|';
        datetimes += $(n).parent().parent().children("td").eq(4).text()+ '@';
        urls += $(n).parent().parent().children("td").eq(5).text()+ '|';
        contents += $(n).parent().parent().children("td").eq(6).text()+ '|';*/
    });

	$("input[name='id']:checked").each(function(i, n){
		if(i<slen-1){
			sid+= $(n).val() + '-';
		}else{
			sid += $(n).val();
		}
	});
	if($("input[name='id']:checked").size()==0) {
		window.top.art.dialog({content:'请选择至少一条数据',lock:true,width:'200',height:'50',border: false,time:1.5},function(){});
		return;
	} else {
		var paraStr = 'ids='+ids+'&sid='+sid;
		$.ajax({
			url: addMoreUrl,
			type: "post",
			dataType: "text",
			data:paraStr,
			async: "false",
			success: function (data) {
				$('#pageForm').submit();
				window.top.art.dialog({
					content: '添加成功！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
				});
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


/**
 * 打开文章详情
 * @param nowPage
 * @return
 */
function detail(id){
	$.dialog({id:'article_detail'}).close();
	var url = detailUrl+'&id='+id;
	$.dialog.open(url,{
		title: '文章内容',
		width: 800,
		height:600,
		lock: true,
		border: false,
		id: 'article_detail',
		drag:true
	});
}