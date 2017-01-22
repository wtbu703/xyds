//打开修改页面
function update(siteId,siteName) {
	$.dialog({id:'site_update'}).close();
	var url = findOneUrl + '&id='+siteId +'&action=update';
	$.dialog.open(url,{
		title: '修改'+siteName+'信息',
		width: 800,
		height:600,
		lock: true,
		border: false,
		id: 'site_update',
		drag:true
	});
}

//打开站点详情页
function detail(siteId,siteName){
    $.dialog({id:'site_detail'}).close();
    var url = findOneUrl+'&id='+siteId+'&action=detail';
    $.dialog.open(url,{
        title: siteName+'站点信息',
        width: 800,
        height:600,
        lock: true,
        border: false,
        id: 'site_detail',
        drag:true
    });
}

//打开填写日交易信息页面
/*function dealTable(siteId,siteName) {
    $.dialog({id:'site_deal'}).close();
    var url = dealTableUrl + '&id='+siteId;
    $.dialog.open(url,{
        title: siteName+'日交易信息',
        width: 800,
        height:600,
        lock: true,
        border: false,
        id: 'site_deal',
        drag:true
    });
}*/

/**
 * 删除一个站点
 */
function deleteOne(siteId) {
    var paraStr;
    paraStr = "id=" + siteId;
    if (confirm('您确定要删除吗？')){
        $.ajax({
            url: deleteOneUrl,
            type: "post",
            dataType: "text",
            data:paraStr ,
            async: "false",
            success: function (data) {
                if(data=='success'){
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
                }else{
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

/**
 * 多选删除站点
 */
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
		window.top.art.dialog({
            content:'请选择至少一条数据',
            lock:true,
            width:'200',
            height:'50',
            border: false,
            time:1.5
        },function(){});
	} else {
	var paraStr = 'ids='+ids;
		$.ajax({
			url: deleteMoreUrl,
			type: "post",
			dataType: "text",
			data:paraStr,
			async: "false",
			success: function (data) {
                if(data=='success'){
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
                }else{
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