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
    var code;
    code = 'oldCode='+$("#oldCode").val();
    $("#code").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min: 1,
        onerror: "请输入站点编码！"
    }).regexValidator({
        regexp: "username",
        datatype: "enum",
        param: 'i',
        onerror: "编码不能含有特殊字符"
    }).ajaxValidator({					// 校验不许重复
        type: "post",
        url: checkCodeUrl,
        data: code,
        datatype: "text",
        async: 'true',
        success: function (data) {
            return data != "exist";
        },
        buttons: $("#dosubmit"),  // 页面提示----"输入正确"
        onerror: "站点编码已存在",
        onwait: "正在连接，请稍候。"
    });
    $("#name").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入站点名称！"
    });
    $("#type").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 0,  //开始索引
        onerror: "请选择站点类型!"
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
});

function save(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr +="id="+$("#id").val();
		paraStr +="&code="+$("#code").val();
		paraStr +="&name="+$("#name").val();
		paraStr +="&type="+$("#type").val();
        paraStr +="&chargeName="+$("#chargeName").val();
        paraStr +="&chargeMobile="+$("#chargeMobile").val();
        paraStr +="&address="+$("#address").val();
        paraStr +="&attachUrls="+$("#attachUrls").val();
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