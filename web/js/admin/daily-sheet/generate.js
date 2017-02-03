//打开站点详情页
function detail(siteId,siteName){
    $.dialog({id:'site_detail'}).close();
    var url = findOneUrl+'&id='+siteId;
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

//打开展示日交易信息页面
function showDealTable(siteId,siteName) {
     $.dialog({id:'site_deal'}).close();
     var url = showDealTableUrl + '&id='+siteId;
     $.dialog.open(url,{
         title: siteName+'日交易信息',
         width: 800,
         height:600,
         lock: true,
         border: false,
         id: 'site_deal',
         drag:true
     });
 }

//多选生成操作
function generate(){
    var len=$("input[name='id']:checked").size()-1;
    var ids='';
    var date = $('#date').val();
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
        var paraStr = 'ids='+ids+'&date='+date;
        $.ajax({
            url: generateUrl,
            type: "post",
            dataType: "text",
            data:paraStr ,
            async: "false",
            success: function () {
                window.top.art.dialog({
                    content: '生成成功！',
                    lock: true,
                    width: 250,
                    height: 80,
                    border: false,
                    time: 2
                }, function () {
                });
            },
            error:function(){
                window.top.art.dialog({
                    content: '生成失败！',
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