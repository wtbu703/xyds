//页面校验
$(function(){
    generateDict('DICT_PIC_CATEGORY','category','栏目');
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
	//校验模型标识
    $("#category").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 0,  //开始索引
        onerror: "请选择!"
    });
});


//增加过滤
function add(){
	if($.formValidator.pageIsValid()){
		var paraStr = "";
        paraStr += "category="+$("#category").val();
        paraStr += "&url="+$("#attachUrls").val();

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
                    window.top.$.dialog.get('category_add').close();
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