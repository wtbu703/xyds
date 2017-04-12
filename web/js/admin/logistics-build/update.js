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
    $("#townCover").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#countyToVillage").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#villageCover").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#villageToHamlet").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#receiveNum").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#sendNum").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#orderBy").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
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