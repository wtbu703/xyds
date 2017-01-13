<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
String path = request.getContextPath();
%>

CKEDITOR.dialog.add('gallery',function(editor){
	var	escape=function(value){return value;};
	return{
		title:'图片组件',
		resizable:CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth:350,
		minHeight:370,
		contents:[{
			id:'info',
			label:'插入本地图片',//常规
			accessKey:'P', // 输出 如果域是空的，那么错误消息将在你点击ok按钮的时候弹出.
			elements:[{
				type:'hbox',				
				children:[{
					id:'reslist',
					type:'html',
					style:'width:100%;height:370px;display:block',
					html:'<iframe id="resListIframe"  frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/picture/picture_single_browse.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		},{
			id:'Upload',
			label : '上传图片', //上传
			elements:[{
				type:'vbox',				
				children:[{
					id:'uploadRes',
					type:'html',
					style:'width:100%;height:370px;display:block',
					html:'<iframe id="uploadIframe" frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/picture/picture_single_upload.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		}],
		onOk:function(){
			var resId ;
			//先查上传
			resId = document.getElementById('uploadIframe').contentWindow.pickResource();
			if (resId == null || resId == "") {
				resId= document.getElementById('resListIframe').contentWindow.pickResource();
			}
			var len = resId.indexOf('@');
			if(len > 0 && resId != null){  // 说明是列表中 选择的图片
				var resPicTypeArray = resId.split('@');
				var resPictureArray = resPicTypeArray[0];
				var pictureType = resPicTypeArray[1]; // 显示的图片类型 缩略图或是原图
				var pictureArray = resPictureArray.split(';');
				var resLength = pictureArray.length;
				var imagepath = '';
				var i = 0;
				while(i < resLength){
					var picSingleStr = pictureArray[i];
					var pictureSingle = picSingleStr.split(',');
					var title = pictureSingle[0];
					var serverIndex = pictureSingle[1];
					var filePath = pictureSingle[2];
					var serverThubmIndex = pictureSingle[3];
					var thumbnail = pictureSingle[4];
					var gallery = '';
					if(pictureType == 'thumbnail'){ // 显示缩略图
						imagepath = path+'/web/ResView.do?server='+serverThubmIndex+'&resType=picture&filepath='+thumbnail;
						gallery = '<div style="float:left;text-align:center; width:140px; height=130px;"><a id="photoview" name="photoview" href="'+path+'/web/ResView.do?server='+serverIndex+'&resType=picture&bigImg=bigImg&filepath='+filePath+'" ><img src="'+imagepath+'" /></a><span style="width:140px; height:15px; display:block;line-height:15px;text-align:center;">'+title+'</span></div>';
					}else{							// 显示原图
						imagepath = path+'/web/ResView.do?server='+serverIndex+'&resType=picture&bigImg=bigImg&filepath='+filePath;
						gallery = '<div style="padding:1px;text-align:center;"><a id="photoview" name="photoview" href="'+path+'/web/ResView.do?server='+serverIndex+'&resType=picture&bigImg=bigImg&filepath='+filePath+'" ><img src="'+imagepath+'" /></a><br/>'+title+'</div>';
					}
					editor.insertHtml(gallery);
					i++;
				}
				document.getElementById('resListIframe').contentWindow.listRefresh(); // 刷新列表
			}else{								// 上传显示
				var resPic = resId.split(';');
				var pictureArray = resPic[0];
				var picType = resPic[1];
				var resIdArray = pictureArray.split(',');
				var resLength = resIdArray.length;
				if(resId != null) {
					var id ='';
					var singleserverIndex = '';
					var singlefilePath = '';
					var serverThubmIndex = '';
					var thumbnail = '';
					var title = '';
					var imagepath = '';
					if (resLength == 1) {
						id = resIdArray[0];
						if(id != '' && id != 'null'){
							$.ajax({
								url:path+"/ResFetch.do?action=resDetailXML",
									type:"post",
									data:"id="+id,
									dataType:"xml",
									success:function(data){
										$(data).find("picture").each(function(){
											singleserverIndex = $(this).find('serverIndex').text();
											singlefilePath = $(this).find('filePath').text();
											serverThubmIndex = $(this).find('thubmServerIndex').text();
											thumbnail = $(this).find('thumbnail').text();
											title = $(this).find('title').text();
											if(serverThubmIndex == '') serverThubmIndex = '1';
										});
										var gallery = '';
										if(picType == 'thumbnail'){	// 显示缩略图
											imagepath = path+'/web/ResView.do?server='+serverThubmIndex+'&resType=picture&filepath='+thumbnail;
											gallery = '<div style="float:left;text-align:center; width:140px; height=130px;"><a id="photoview" name="photoview" href="'+path+'/web/ResView.do?server='+singleserverIndex+'&resType=picture&bigImg=bigImg&filepath='+singlefilePath+'" ><img src="'+imagepath+'" /></a><span style="width:140px; height:15px; display:block;line-height:15px;text-align:center;">'+title+'</span></div>';
										}else{
											imagepath = path+'/web/ResView.do?server='+singleserverIndex+'&resType=picture&bigImg=bigImg&filepath='+singlefilePath;
											gallery = '<div style="padding:1px;text-align:center;"><a id="photoview" name="photoview" href="'+path+'/web/ResView.do?server='+singleserverIndex+'&resType=picture&bigImg=bigImg&filepath='+singlefilePath+'" ><img src="'+imagepath+'" /></a><br/>'+title+'</div>';
										}
										editor.insertHtml(gallery);
									}
								});
						}
					}else if (resLength > 1) {
						for(var j = 0;j < resLength; j++) {
							id = resIdArray[j];
							if(id != '' && id != 'null'){
								$.ajax({
									url:path+"/ResFetch.do?action=resDetailXML",
										type:"post",
										data:"id="+id,
										dataType:"xml",
										success:function(data){
											$(data).find("picture").each(function(){
												singleserverIndex = $(this).find('serverIndex').text();
												singlefilePath = $(this).find('filePath').text();
												serverThubmIndex = $(this).find('thubmServerIndex').text();
												thumbnail = $(this).find('thumbnail').text();
												title = $(this).find('title').text();
												if(serverThubmIndex == '' || serverThubmIndex == 'null') serverThubmIndex = '1';
											});
											var gallery = '';
											if(picType == 'thumbnail'){	// 显示缩略图
												imagepath = path+'/web/ResView.do?server='+serverThubmIndex+'&resType=picture&filepath='+thumbnail;
												gallery = '<div style="float:left;text-align:center; width:140px; height=130px;"><a id="photoview" name="photoview" href="'+path+'/web/ResView.do?server='+singleserverIndex+'&resType=picture&bigImg=bigImg&filepath='+singlefilePath+'" ><img src="'+imagepath+'" /></a><span style="width:140px; height:15px; display:block;line-height:15px;text-align:center;">'+title+'</span></div>';
											}else{
												imagepath = path+'/web/ResView.do?server='+singleserverIndex+'&resType=picture&bigImg=bigImg&filepath='+singlefilePath;
												gallery = '<div style="padding:1px;text-align:center;"><a id="photoview" name="photoview" href="'+path+'/web/ResView.do?server='+singleserverIndex+'&resType=picture&bigImg=bigImg&filepath='+singlefilePath+'" ><img src="'+imagepath+'" /></a><br/>'+title+'</div>';
											}
											editor.insertHtml(gallery);
										}
									});
							}
						}
					}
				}
				document.getElementById('uploadIframe').contentWindow.refresh(); // 刷新列表
			}
		},
		onLoad:function(){
			
		}
	};
});
