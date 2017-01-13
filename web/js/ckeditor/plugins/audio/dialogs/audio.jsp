<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
String path = request.getContextPath();
%>
<!-- 采用的是滑动门技术，如果需要切换多个页面 可以 添加多 elements -->
CKEDITOR.dialog.add('audio',function(editor){
	var	escape=function(value){return value;};
	return{
		title:'音频组件',
		resizable:CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth:350,
		minHeight:370,
		contents:[{
			id:'info',
			label:'浏览音频',//常规
			elements:[{
				type:'hbox',
				children:[{
					id:'audioList',
					type:'html',
					style:'width:100%;height:370px;display:block',
					html:'<iframe id="resListIframe" frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/audio/audio_single_browse.jsp?categoryId='+categoryId+'"/>' <!-- 引入的功能页面  -->
				}]
			}]
		},{
			id:'Upload',
			hidden:false,
			filebrowser: 'uploadButton',
			label : editor.lang.image.upload, //上传
			elements:[{
				type:'hbox',
				children:[{
					id:'uploadAudio',
					type:'html',
					style:'width:100%;height:370px;display:block',
					html:'<iframe id="uploadIframe" frameborder="0″ width="650" height="300" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/audio/audio_upload.jsp?categoryId='+categoryId+'"/>' <!-- 引入的功能页面  -->
				}]
			}]
		}],
		onOk:function(){ // 点击确认按钮后 触发的事件
		 	var resId;
		 	// 先查上传
			resId = document.getElementById('uploadIframe').contentWindow.tellSource(); // 获取上传ID
			if(resId != '' && resId != 'null'){	// 上传
				var resArray = resId.split(',');
				var resLen = resArray.length;
				for(var i=0; i < resLen; i++){
					var rid = resArray[i];
					if(rid != '' && rid != 'null'){
						$.ajax({
							url:path+"/ResFetch.do?action=resDetailXML", 
							type:"post",
							data:"id="+rid,
							dataType:"xml",
							success:function(data){			
								var audioObject = $(data).find('audio');
								var id = $(audioObject).find('id').text();
								var title = $(audioObject).find('title').text();
								var model = $(audioObject).find('model').text();
								var filePath = $(audioObject).find('filePath').text();
								var serverIndex = $(audioObject).find('serverIndex').text();
								var player = mp3player(path,path+'/web/ResView.do?server='+ serverIndex +'&resType=audio&filepath='+ filePath);
								editor.insertHtml('<div style="float:left;text-align:center; width:205px; height=60px;">'+ player +'<span style="padding:1px;border:solid;border-width:0px;text-align:center;width:205px;height:30px;">'+ title +'</span></div>');
							},
							error:function(){
								window.top.art.dialog({content:'加载音频详细信息出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){return;});
							}
						});
					}
				}
				document.getElementById('uploadIframe').contentWindow.refresh();
			}else{		// 选择列表中的音频
				resId= document.getElementById('resListIframe').contentWindow.getSelectSource(); // 获取页面中选中的记录
				var resIdArray = resId.split(';');
				var resLength = resIdArray.length;
				if(resId != null && resId != ''){
					if(resLength == 1){
						var ids = resId.split(',');
						var player = ids[0];
						var title = ids[1];
						editor.insertHtml('<div style="float:left;text-align:center; width:205px; height=60px;">'+ player +'<span style="padding:1px;border:solid;border-width:0px;text-align:center;width:205px;height:30px;">'+ title +'</span></div>');
						document.getElementById('resListIframe').contentWindow.refresh();
					}else if(resLength > 1){
						for(var i = 0; i < resLength; i++){
							var resId = resIdArray[i];
							var ids = resId.split(',');
							if(ids != '' && ids != 'null'){
								var player = ids[0];
								var title = ids[1];
								editor.insertHtml('<div style="float:left;text-align:center; width:205px; height=60px;">'+ player +'<span style="padding:1px;border:solid;border-width:0px;text-align:center;width:205px;height:30px;">'+ title +'</span></div>');
							}
						}
						document.getElementById('resListIframe').contentWindow.refresh();
					}
				}
			}
		},
		onLoad:function(){
		
		}
	};
});
