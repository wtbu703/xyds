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
    $("#name").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入项目建设名称！"
    });
    $("#centralSupportContent").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#centralSupport").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#centralPaid").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#localSupport").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#companyPaid").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#organizer").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入项目承办单位！"
    });
    $("#chargeName1").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入承办单位负责人！"
    });
    $("#chargeMobile1").formValidator({
            onshow: "（必填）",
            onfocus: "（必填）",
            oncorrect: "（正确）"})
        .inputValidator({               //校验不能为空
            min:1,
            onerror:"请输入联系电话！"})
        .regexValidator({
            regexp:"mobile",
            datatype:"enum",
            param:'i',
            onerror:"联系电话填写不对！"
        });
    $("#publicInfoUrl").formValidator({
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
        paraStr = "id=" + $('#id').val()
            + "&centralSupportContent=" + $('#centralSupportContent').val()
            + "&centralSupport=" + $('#centralSupport').val()
            + "&centralPaid=" + $('#centralPaid').val()
            + "&localSupport=" + $('#localSupport').val()
            + "&companyPaid=" + $('#companyPaid').val()
            + "&organizer=" + $('#organizer').val()
            + "&chargeName1=" + $('#chargeName1').val()
            + "&chargeMobile1=" + $('#chargeMobile1').val()
            + "&publicInfoUrl=" + $('#publicInfoUrl').val();
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