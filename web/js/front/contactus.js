

/**
 * 添加过滤
 * @param path
 * @return
 */
$(function(){
    $('#add').click(function(){
            var paraStr = "";
            paraStr += "name=" + $("#name").val();
            paraStr += "&gender=" + $("#gender").val();
            paraStr += "&mobile=" + $("#mobile").val();
            paraStr += "&content=" + $("#leavingmessage").val();
            paraStr += "&QQ=" + $("#QQ").val();
            paraStr += "&email=" + $("#email").val();
            $.ajax({
                url: insertUrl,
                type: "post",
                dataType: "text",
                data: paraStr,
                async: "false",
                success: function (data) {
                    if (data == "success") {
                        alert('添加成功');
                        history.go(0);
                    } else {
                        alert('添加失败');
                    }
                }
        });


    })
});
