
//页面校验
$(function() {
    $.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

    // 校验模型名称
    $("#companyName").formValidator({
        onshow: "请输入公司名称",
        onfocus: "不能超过16个字",
        oncorrect: "输入正确"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入公司名称！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,16}$",
        onerror:"不能超过16个字"
    });
    $("#category").formValidator({
        onshow: "选择不能为空",
        onfocus: "（必填）请选择选项",
        oncorrect: "输入正确"
    }).inputValidator({
        min: 1,  //开始索引
        onerror: "你是不是忘记选择企业类别了!"
    });

    $("#sources").formValidator({
        onshow: "请输入发布者",
        onfocus: "不超过16个字",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,16}$",
        onerror: "不超过16个字!"
    });
    $("#introduction").formValidator({
        onshow: "请输入服务名称",
        onfocus: "不超过16个字",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"^.{1,16}$",
        onerror: "不超过16个字!"
    });
    $("#contact").formValidator({
        onshow: "请输入联系人",
        onfocus: "不超过16个字",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,16}$",
        onerror: "不超过16个字!"
    });

    $("#tel").formValidator({
        onshow: "请输入电话号码",
        onfocus: "例如：010-1234567或13312345678",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"(^(\\d{2,4}[-_－—]?)?\\d{3,8}([-_－—]?\\d{3,8})?([-_－—]?\\d{1,7})?$)|(^0?1[3|4|5|7|8]\\d{9}$)",
        onerror: "您输入的格式错误!"
    });

    $("#email").formValidator({
        onshow: "请输入电子邮箱",
        onfocus: "例如：123456@qq.com",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"[\\w!#$%&'*+/=?^_`{|}~-]+(?:\\.[\\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\\w](?:[\\w-]*[\\w])?\\.)+[\\w](?:[\\w-]*[\\w])?",
        onerror: "您输入的格式错误!"
    });
    $("#postcode").formValidator({
        onshow: "请输入邮政编码",
        onfocus: "例如：",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"[1-9]\\d{5}(?!\\d)",
        onerror: "您输入的格式错误!"
    });
    $("#address").formValidator({
        onshow: "请输入地址",
        onfocus: "不超过64个字",
        oncorrect: "输入正确"
    }).regexValidator({
        regexp:"^.{1,64}$",
        onerror: "不超过64个字!"
    });

});

function save(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr = "";
		paraStr +="id="+$("#id").val();
		paraStr +="&companyName="+$("#companyName").val();
		paraStr +="&logoUrl="+$("#attachUrls").val();
		paraStr +="&introduction="+$("#introduction").val();
        paraStr +="&content=" + encodeURIComponent(contentEditor.getData())
        paraStr +="&tel="+$("#tel").val();
        paraStr +="&email="+$("#email").val();
        paraStr +="&address="+$("#address").val();
        paraStr +="&fax="+$("#fax").val();
        paraStr +="&postcode="+$("#postcode").val();
        paraStr += "&contact=" + $('#contact').val();
        paraStr +="&sources=" + $('#sources').val();
        paraStr +="&category=" + $('#category').val();
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