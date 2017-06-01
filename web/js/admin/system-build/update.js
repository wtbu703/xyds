//页面校验
$(function() {
    $.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

    // 校验模型名称
    $("#name").formValidator({
        onshow: "请填写项目名称",
        onfocus: "项目名称1-18个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入项目建设名称！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,18}$",
        onerror:"项目名称1-18个字！"
    });
    $("#address").formValidator({
        onshow: "请输入详细的地址",
        onfocus: "详细地址6-64个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入详细地址！"
    }).regexValidator({
        regexp:"^.{6,64}$",
        onerror:"详细地址6-64个字！"
    });
    $("#function").formValidator({
        onshow: "请输入主要功能",
        onfocus: "主要功能不超过18个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入主要功能！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{2,18}$",
        onerror:"主要功能不超过18个字！"
    });
    $("#chargeName").formValidator({
        onshow: "请输入负责人",
        onfocus: "负责人不超过8个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入负责人姓名！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,8}$",
        onerror:"负责人不超过8个字！"
    });
    $("#chargeMobile").formValidator({
            onshow: "请输入联系电话",
            onfocus: "例如：13345126510",
            oncorrect: "输入正确"})
        .inputValidator({               //校验不能为空
            min:1,
            onerror:"请输入联系电话！"})
        .regexValidator({
            regexp:"^1(3|4|5|7|8)\\d{9}$mobile",
            datatype:"enum",
            param:'i',
            onerror:"联系电话填写不对！"
        });
    $("#code").formValidator({
        onshow: "请输入服务站点ID",
        onfocus: "只能输入数字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min: 1,
        onerror: "请输入服务站ID！"
    });
    $("#isCountyLogistics").formValidator({
        onshow: "选择不能为空",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 1,  //开始索引
        onerror: "你是不是忘记选择了!"
    });
    $("#isTownLogistics").formValidator({
        onshow: "选择不能为空",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 1,  //开始索引
        onerror: "你是不是忘记选择了!"
    });
    $("#config").formValidator({
        onshow: "请输入设施配置",
        onfocus: "设施配置不超过18个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入设施配置！"
    }).regexValidator({
        regexp:"^.{2,18}$",
        onerror:"设施配置不超过18个字！"
    });
    $("#centralSupportContent").formValidator({
        onshow: "请输入建设内容",
        onfocus: "建设内容不超过18个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入建设内容！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,18}$",
        onerror:"建设内容不超过18个字！"
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
        onerror:"请输入数字！"
    });
    $("#centralPaid").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#localSupport").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#companyPaid").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入数字！"
    });
    $("#organizer").formValidator({
        onshow: "请输入承办单位",
        onfocus: "承办单位不能超过18个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入项目承办单位！"
    }).regexValidator({
        regexp:"^.{2,18}$",
        onerror:"承办单位不能超过18个字！"
    });
    $("#chargeName1").formValidator({
        onshow: "请输入负责人",
        onfocus: "负责人不超过8个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入承办单位负责人！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,8}$",
        onerror:"负责人不超过8个字！"
    });
    $("#chargeMobile1").formValidator({
            onshow: "（必填）",
            onfocus: "例如：13345126510",
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
        onshow: "请输入网址",
        onfocus: "例如：https://www.baidu.com/",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入！"
    }).regexValidator({
        regexp:"[a-zA-z]+://[^\\s]*",
        onerror:"网址格式错误"
    });
});

function save(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
        var paraStr;
        paraStr = "id=" + $('#id').val()
            + "&name=" + $('#name').val()
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