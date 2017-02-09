// 修改字典
function save(){
    var codes = $("input[name='code']");
    var names = $("input[name='name']");
    var countyTypes = $("input[name='countyType']");
    var buyOrderTotals = $("input[name='buyOrderTotal']");
    var sellOrderTotals = $("input[name='sellOrderTotal']");

    var codesStr = codes[0].value;
    var namesStr = names[0].value;
    var countyTypesStr = countyTypes[0].value;
    var buyOrderTotalsStr = buyOrderTotals[0].value;
    var sellOrderTotalsStr = sellOrderTotals[0].value;

    for(var i=1;i<codes.length;i++){
        codesStr += "-" + codes[i].value;
        namesStr += "-" + names[i].value;
        countyTypesStr += "-" + countyTypes[i].value;
        buyOrderTotalsStr += "-" + buyOrderTotals[i].value;
        sellOrderTotalsStr += "-" + sellOrderTotals[i].value;
    }
    var paraStr;
    paraStr = "id=" + $('#id').val() + "&codes=" + codesStr + "&names=" + namesStr + "&countyTypes=" + countyTypesStr + "&buyOrderTotals=" + buyOrderTotalsStr + "&sellOrderTotals=" + sellOrderTotalsStr;
    $.ajax({
        url: saveUrl,
        type: "post",
        dataType: "text",
        data:paraStr ,
        async: "false",
        success: function (data) {
            if(data == "success"){
                window.top.art.dialog({
                    content: '修改成功！',
                    lock: true,
                    width: 250,
                    height: 80,
                    border: false,
                    time: 2
                }, function () {
                });
                art.dialog.parent.location.href = indexUrl;
                window.top.$.dialog.get('sheet_update').close();
            }else{
                window.top.art.dialog({
                    content: '修改失败！',
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
                content: '修改失败！',
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