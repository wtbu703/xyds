function login(){
	var username = $("input[name='username']").val();
	var password = $("input[name='password']").val();
	var checkCode = $("input[name='checkCode']").val();
	if(username == '' || username == null){
        $(".nameTip").html("用户名不能为空");
        $("input[name='username']").focus();
		return;
	}
	if(password == '' || password == null){
        $(".nameTip").html("密码不能为空");
        $("input[name='password']").focus();
		return;
	}
	if(checkCode == '' || checkCode == null){
        $(".nameTip").html("验证码不能为空");
        $("input[name='checkCode']").focus();
		return;
	}
	$.ajax({
		url:logincheckUrl,
		type:"post", 
		dataType:"text",
		data:"username="+username+"&password="+password+"&checkCode="+checkCode,
		success:function(data){
			if('error'==data){
                $("input[name='username']").val("");
                $("input[name='password']").val("");
                $("input[name='checkCode']").val("");
                $('#certImg').click();
                $(".nameTip").html("用户名或密码错误");
            }else if("checkCodeWrong"==data){
                $("input[name='checkCode']").val("");
			    $('#certImg').click();
                $(".nameTip").html("验证码错误");
            }else if('success' == data){
			   window.location.href = backendUrl;
		   }
		}, 
		error:function(){
            $(".nameTip").html("登录失败");
        }
	});
}

function SubmitKey(button,event)  
{   
	if (event.keyCode == 13)  
	{   
		event.returnValue = false;  
		login();
	}
}

