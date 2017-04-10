$(function(){
    $.formValidator.initConfig({
        formid:"myform",
        autotip:true,			//是否显示提示信息
        onerror:function(msg,obj){
            window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})
        }});
});
function add(){
        var paraStr = "";
        paraStr += "name=" + $("#name").val();
        paraStr += "&trainId=" + $("#trainId").val();
        paraStr += "&gender=" + $("#gender").val();
        paraStr += "&age=" + $("#age").val();
        paraStr += "&mobile=" + $("#mobile").val();
        paraStr += "&address=" + $("#address").val();
        paraStr += "&idCardNo=" + $("#idCardNo").val();
        $.ajax({
            url: addUrl,
            type: "post",
            dataType: "text",
            data: paraStr,
            async: "false",
            success: function (data) {
                if (data == "success") {
                   alert('报名成功');
                } else {
                    alert('报名失败');
                }
            }
        });

}