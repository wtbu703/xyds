
/**
 * 重置密码前的密码验证
 * @return
 */
function resetPWD(){
	var oldPWD = $('#oldPWD').val();
	var newPWD = $('#newPWD').val();
	var newPWDAgain = $('#newPWDAgain').val();

	if(oldPWD==null||oldPWD==""){
		window.top.art.dialog({content:'请输入原始密码！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		$('#oldPWD').focus();
		return;
	}
	if(newPWD==null||newPWD==""){
		window.top.art.dialog({content:'请输入新密码！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		$('#newPWD').focus();
		return;
	}
	else if(newPWDAgain==null||newPWDAgain==""){
		window.top.art.dialog({content:'请再次输入新密码！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		$("#newPWDAgain").focus();
		return;
	}
	else if(newPWD!=newPWDAgain){
		window.top.art.dialog({content:'新密码和确认新密码不一样！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		$('#newPWDAgain').focus();
		$('#newPWDAgainTip').attr("class","onError");
		return;
	}
	var paraStr = '';
	paraStr = "oldPWD=" + oldPWD + "&newPWD=" + newPWD;
	$.ajax({
		url:changepwdUrl,
		type:"post",
		data:paraStr,
		dataType:"text",
		success:function(data){
			if(data=="success"){
				window.top.art.dialog({content:'修改成功！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
				closeBg();
			}else{
				window.top.art.dialog({content:'原始密码不正确！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
				$('#oldPWD').focus();
				return;
			}
		}
	})
	
	
}

//自带弹窗js
//显示灰色 jQuery 遮罩层
function showBg() {
	var bh = $("body").height();
	var bw = $("body").width();
	$("#fullbg").css({
		height:bh,
		width:bw,
		display:"block"
	});
	$("#dialog").show();
}
//关闭灰色 jQuery 遮罩
function closeBg() {
	$("#fullbg,#dialog").hide();
}
//自带弹窗js结束