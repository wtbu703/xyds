//页面校验
$(function() {
    $.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

    // 校验模型名称
    $("#buyTotal").formValidator({
        onshow: "（必填）",
        onfocus: "请输入订单数，例如：20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入订单数！"
    });
	$("#buySum").formValidator({
		onshow: "（必填）",
		onfocus: "请输入代买金额，例如：20.1",
		oncorrect: "（正确）"
	}).inputValidator({               //校验不能为空
		min:1,
		onerror:"请输入代买金额！"
	});
	$("#sellSum").formValidator({
		onshow: "（必填）",
		onfocus: "请输入销售金额，例如：20.1",
		oncorrect: "（正确）"
	}).inputValidator({               //校验不能为空
		min:1,
		onerror:"请输入销售金额！"
	});
    $("#sellTotal").formValidator({
        onshow: "（必填）",
        onfocus: "请输入订单数，例如：20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入订单数！"
    });
	$("#categorySell").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择商品大类了!"
	});
	$("#categoryFullSell").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择商品具体类别了!"
	});
	$("#categoryBuy").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择商品大类了!"
	});
	$("#categoryFullBuy").formValidator({
		onshow: "选择不能为空",
		onfocus: "（必填）请选择选项",
		oncorrect: "输入正确"
	}).inputValidator({
		min: 1,  //开始索引
		onerror: "你是不是忘记选择商品具体类别了!"
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
		paraStr = "id=" + $('#id').val()+"&datetime="+$('#created').val()+ "&categoryFullBuy=" + buyCodesStr + "&buySum=" + buysStr + "&buyTotal=" + $('#buyTotal').val()+ "&categoryFullSell=" + sellCodesStr + "&sellSum=" + sellsStr + "&sellTotal=" + $('#sellTotal').val();
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