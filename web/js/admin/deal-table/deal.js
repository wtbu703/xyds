//页面校验
$(function() {
    $.formValidator.initConfig({
        formid: "myform",
        autotip: true,			//是否显示提示信息
        onerror: function (msg, obj) {
            window.top.art.dialog({content: msg, lock: true, width: '200', height: '50'}, function () {
                this.close();
                $(obj).focus();
            })
        }
    });
    // 校验模型名称
    $("#buyTotal").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入订单数！"
    });
    $("#sellTotal").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入订单数！"
    });
});


/**
 * 添加过滤
 * @return
 */
function saveDealTable(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
        var buys = $("input[name='buySum']");
        var buyCodes = $("select[name=categoryFullBuy]");
        var sells = $("input[name='sellSum']");
        var sellCodes = $("select[name=categoryFullSell]");

        var buysStr = buys[0].value;
        var buyCodesStr = buyCodes[0].value;
        var sellsStr = sells[0].value;
        var sellCodesStr = sellCodes[0].value;

        for(var i=1;i<buys.length;i++){
            buysStr += ";" + buys[i].value;
            buyCodesStr += ";" + buyCodes[i].value;
            sellsStr += ";" + sells[i].value;
            sellCodesStr += ";" + sellCodes[i].value;
        }
		var paraStr;
		paraStr = "id=" + $('#id').val() + "&categoryFullBuy=" + buyCodesStr + "&buySum=" + buysStr + "&buyTotal=" + $('#buyTotal').val()+ "&categoryFullSell=" + sellCodesStr + "&sellSum=" + sellsStr + "&sellTotal=" + $('#sellTotal').val();
		$.ajax({
			url: saveUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
			async: "false",
			success: function (data) {
				if(data == "success"){
					window.top.art.dialog({
						content: '添加成功！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
                    art.dialog.parent.location.href = indexUrl;
					window.top.$.dialog.get('site_deal').close();
				}else{
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
			},
			error:function(){
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

//删除商品大类
function deleteRow(rowId){
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('deal');
    objTable.deleteRow(index);
    objTable.deleteRow(index);
    objTable.deleteRow(index);
}