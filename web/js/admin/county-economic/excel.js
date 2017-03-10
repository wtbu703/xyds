
function submit(){

		var paraStr;
		paraStr ='&attachUrls='+$('#attachUrls').val()+'&attachNames='+$('#attachNames').val();
		$.ajax({
			url: saveUrl,
			type: "post",
			dataType: "text",
			data: paraStr,
			async: "false",
			success: function (data) {
				if(data == "success"){
					window.top.art.dialog({
						content: '提交成功！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
                    art.dialog.parent.location.href = indexUrl;
					window.top.$.dialog.get('upload_excel').close();
				}else if(data == "format wrong"){
                    window.top.art.dialog({
                        content: '提交失败！请检查表格格式是否规范',
                        lock: true,
                        width: 250,
                        height: 80,
                        border: false,
                        time: 5
                    }, function () {
                    });
                }else{
					window.top.art.dialog({
						content: '提交失败！',
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
					content: '提交失败！',
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