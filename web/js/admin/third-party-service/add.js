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
	$("#companyName").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入公司名！"
    });
    $("#introduction").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入简介！"
    });

});


/**
 * 添加过滤
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr;
		paraStr = "companyName=" + $('#companyName').val()
            + "&logoUrl=" + $('#attachUrls').val()
            + "&introduction=" + $('#introduction').val()
            + "&tel=" + $('#tel').val()
            + "&email=" + $('#email').val()
            + "&address=" + $('#address').val()
            + "&fax=" + $('#fax').val()
            + "&postcode=" + $('#postcode').val();
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