// 加载页面初始化信息
$(document).ready(function(){
	if(tag == 'success'){
		picShow("上传成功,可继续上传！","onCorrect");
	}else if(tag == 'error'){
		picShow("文件类型不正确！或文件过大！","onError");
	}
})

// 登录
function picShow(tip,_class){

	var htPWD = new Array();
	htPWD.push(tip);
	$('#userPWDAgainTip').html(htPWD.join(""));
	$('#userPWDAgainTip').attr("class",_class);
}

function uploadPic(){

	/*if(picUrl != null && picUrl != "" && picUrl != "null"){
		$.ajax ({
			type:"post",
			url:path+"/admin/delLoad.do?getType=picDel&picUrl="+picUrl,
			dataType:"text",
			async:true,
			error:function () {
				window.top.art.dialog({content:'系统出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
			},
			success: function(html) {
			}
		});
	}*/
	$("#uploadForm").submit();
}