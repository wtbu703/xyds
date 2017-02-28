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
    $("#address").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入详细地址！"
    });
    $("#function").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入主要功能！"
    });
    $("#chargeName").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入负责人姓名！"
    });
    $("#chargeMobile").formValidator({
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
    $("#code").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min: 1,
        onerror: "请输入服务站ID！"
    });
    $("#isCountyLogistics").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 0,  //开始索引
        onerror: "请选择!"
    });
    $("#isTownLogistics").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 0,  //开始索引
        onerror: "请选择!"
    });
    $("#config").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入设施配置！"
    });
    $("#centralSupportContent").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    });
    $("#buildProgress").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入项目建设进度！"
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
    $("#centralDecisionUnit").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
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


/**
 * 添加过滤
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr;
		paraStr = "name=" + $('#name').val()
            + "&address=" + $('#address').val()
            + "&function=" + $('#function').val()
            + "&chargeName=" + $('#chargeName').val()
            + "&chargeMobile=" + $('#chargeMobile').val()
            + "&code=" + $('#code').val()
            + "&isCountyLogistics=" + $('#isCountyLogistics').val()
            + "&isTownLogistics=" + $('#isTownLogistics').val()
            + "&config=" + $('#config').val()
            + "&centralSupportContent=" + $('#centralSupportContent').val()
            + "&buildProgress=" + $('#buildProgress').val()
            + "&centralSupport=" + $('#centralSupport').val()
            + "&centralPaid=" + $('#centralPaid').val()
            + "&localSupport=" + $('#localSupport').val()
            + "&companyPaid=" + $('#companyPaid').val()
            + "&organizer=" + $('#organizer').val()
            + "&chargeName1=" + $('#chargeName1').val()
            + "&chargeMobile1=" + $('#chargeMobile1').val()
            + "&centralDecisionUnit=" + $('#centralDecisionUnit').val()
            + "&decisionFileUrl=" + $('#attachUrls').val()
            + "&publicInfoUrl=" + $('#publicInfoUrl').val();
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
					window.top.$.dialog.get('build_add').close();
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