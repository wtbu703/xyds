//页面校验
$(function() {
    $.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

    // 校验模型名称
    $("#townCover").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#countyToVillage").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#villageCover").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#villageToHamlet").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#receiveNum").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#sendNum").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#orderBy").formValidator({
        onshow: "（必填）",
        onfocus: "例如:20",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        max:3,
        onerror:"请输入数字，长度都不能超过3！"
    });
});

function save(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
        var paraStr;
        paraStr = "townCover=" + $('#townCover').val()
            + "&countyToVillage=" + $('#countyToVillage').val()
            + "&villageCover=" + $('#villageCover').val()
            + "&villageToHamlet=" + $('#villageToHamlet').val()
            + "&receiveNum=" + $('#receiveNum').val()
            + "&sendNum=" + $('#sendNum').val()
            + "&orderBy=" + $('#orderBy').val();
		$.ajax({
			url: updateUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
			async: "false",
			success: function (data) {
                if(data == "success") {
                    window.top.art.dialog({
                        content: '修改成功！',
                        lock: true,
                        width: 250,
                        height: 80,
                        border: false,
                        time: 2
                    }, function () {
                    });
                    art.dialog.parent.$('#pageForm').submit();
                    window.top.$.dialog.get('site_update').close();
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
}