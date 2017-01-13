<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path;
%>
CKEDITOR.dialog.add('flv',function(editor){
	var	escape=function(value){return value;};
	return{
		title:'视频组件',
		resizable:CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth:350,
		minHeight:370,
		contents:[{
			id:'info',
			label:'浏览视频',//常规
			elements:[{
				type:'vbox',				
				children:[{
					id:'reslist',
					type:'html',
					style:'width:100%;height:370px;display:block',
					className:'videoList',
					html:'<iframe id="resListIframe" id="resListIframe" frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/video/video_single_browse.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		},{
			id:'Upload',
			label : '上传视频', //上传
			elements:[{
				type:'vbox',				
				children:[{
					id:'uploadRes',
					type:'html',
					style:'width:100%;height:370px;display:block',
					html:'<iframe id="uploadIframe" id="uploadIframe" frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/video/video_single_upload.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		}],
		onOk:function(){
			//查上传
			var flvStr;
			flvStr = document.getElementById('uploadIframe').contentWindow.pickResource();
			if(flvStr != '' && flvStr != 'null'){ // 上传资源
				var flvArray = flvStr.split(',');
				var flvLen = flvArray.length;
				for(var j=0;j < flvLen;j++){
					var videoId = flvArray[j];
					if(videoId != '' && videoId != 'null'){
						$.ajax({
							url:path+"/ResFetch.do?action=resDetailXML",
								type:"post",
								data:"id="+videoId,
								dataType:"xml",
								success:function(data){
									var videoObject = $(data).find("video");
									var title = $(videoObject).find('title').text();
									var flvPlayer = fplayer("250","200",path,videoId,"0");
									editor.insertHtml("<div style='float:left;padding:5px;border:solid;border-width:0px;text-align:center;width:260px;height:210px;'>"+flvPlayer+"<span style='width:260px; height:15px; display:block;line-height:15px;text-align:center;'>"+ title +"</span></div>");			
								}
							});
					}
				}
			}else{
				flvStr = document.getElementById('resListIframe').contentWindow.pickResource(); // 列表选择
				if(flvStr != '' && flvStr != 'null'){
					var videoArray = flvStr.split(';');
					var len = videoArray.length;
					for(var i=0; i < len; i++){
						var videoSingle = videoArray[i];
						if(videoSingle != '' && videoSingle != 'null'){
							var videoSinArray = videoSingle.split('@');
							var videoPlayer = videoSinArray[0];
							var videoTitle = videoSinArray[1];
							editor.insertHtml("<div style='float:left;padding:5px;border:solid;border-width:0px;text-align:center;width:260px;height:210px;'>"+videoPlayer+"<span style='width:260px; height:15px; display:block;line-height:15px;text-align:center;'>"+ videoTitle +"</span></div>");			
						}
					}
				}
			}
		},
		onLoad:function(){
			
		}
	};
});
