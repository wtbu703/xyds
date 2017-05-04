var delId = [];
// 获取字典
$(function(){
	$.ajax ({
		type:"post",
		url:listdictUrl,
		dataType:"json",
		data:"dictCode=DICT_PIC_CATEGORY",
		async:true,
		error: function () {
			window.top.art.dialog({content:'获取字典类型出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		},
		success: function(data) {
			var selectarray =  [];
			$.each(data,function(i,n){
				if(n.dictItemCode == category){
					selectarray.push("<option value='"+ n.dictItemCode +"' selected='selected'>"+ n.dictItemName +"</option>");
				}else{
					selectarray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
				}
			});
			$('#category').html(selectarray.join(''));
		}
	});

    $.formValidator.initConfig({
        formid:"categoryForm",
        autotip:true,			//是否显示提示信息
        onerror:function(msg,obj){
            window.top.art.dialog({
                content:msg,
                lock:true,
                width:'200',
                height:'50'
            }, function(){
                this.close();
                $(obj).focus();
            })
        }
    });

    // 校验模型名称
    $("#category").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 0,  //开始索引
        onerror: "请选择!"
    });
});

// 修改
function update(){
	if($.formValidator.pageIsValid()){

        var paraStr = "";

        paraStr += "id="+$("#id").val();
        paraStr += "&category="+$("#category").val();
        paraStr += "&url="+$("#attachUrls").val();

        $.ajax({
            url: updateUrl,
            type: "post",
            dataType: "text",
            data:paraStr ,
            async: "false",
            success: function (data) {
                if(data == "success"){
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
                    window.top.$.dialog.get('category_update').close();
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