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

//打开填写日交易信息页面
function addDealTable(siteId,siteName) {
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
 }