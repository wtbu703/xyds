
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