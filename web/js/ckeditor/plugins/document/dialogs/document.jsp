<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
String path = request.getContextPath();
%>
CKEDITOR.dialog.add('document',function(editor){
	var	escape=function(value){return value;};
	return{
		title:'文档组件',
		resizable:CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth:350,
		minHeight:370,
		contents:[{
			id:'info',
			label:'浏览文档',//常规
			elements:[{
				type:'vbox',				
				children:[{
					id:'reslist',
					type:'html',
					style:'width:100%;height:370px;display:block',
					className:'documentList',
					html:'<iframe id="resListIframe" id="resListIframe" frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/document/document_single_browse.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		},{
			id:'Upload',
			hidden:false,
			filebrowser:'uploadButton',
			label : editor.lang.image.upload, //上传
			elements:[{
				type:'vbox',
				id:'upload',
				label : editor.lang.image.btnUpload, //上传
				children:[{
					id:'reslist',
					type:'html',
					style:'width:100%;height:370px;display:block',
					className:'documentList',
					html:'<iframe id="resUploadIframe" frameborder="0″ width="620" height="370" style="width:620px;height:370px;border:0px" src="'+path+'/admin/ckplugin/document/doc_upload.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		}],
		onOk:function(){
			//查上传
			var urls = "";
			var urls = document.getElementById('resUploadIframe').contentWindow.sendDocData();
			if(urls != '' && urls != 'null'){	// 上传处 传过来的资源ID
				var ridArray = urls.split(',');
				var ridLen = ridArray.length;
				for(var j=0; j < ridLen; j++){
					var resId = ridArray[j];
					if(resId != '' && resId != 'null'){
						$.ajax({
							url:path+'/ResFetch.do?action=resDetailXML',
							type:'post',
							dataType:'xml',
							data:'id='+resId,
							success:function(data){
								var id = $(data).find('document').find('id').text();
								var model =$(data).find('document').find('model').text();
								var title = $(data).find('document').find('title').text();
								var filePath = $(data).find('document').find('filePath').text();
								var thumbnail = $(data).find('document').find('thumbnail').text();
								var serverIndex = $(data).find('document').find('serverIndex').text();
								var url = path+'/web/ResView.do?server='+ serverIndex +'&resType=document&filepath='+ filePath;
								var downLoad = '<span>'+title+'<a href="'+url+'" style="">(下载)</a></span>';
								editor.insertHtml(downLoad);
							}
						});
					}
				}
				document.getElementById('resUploadIframe').contentWindow.ref();
			}else{		// 列表中选择的文档
				urls = document.getElementById('resListIframe').contentWindow.getSelectSource();
				var documentArray = urls.split(';');
				var len = documentArray.length;
				if(urls != '' && urls != 'null'){
					for(var i = 0;i < len; i++){
						var urlStr = documentArray[i];
						if(urlStr != '' && urlStr != 'null'){
							var urlTitle = urlStr.split(",");
							var title = urlTitle[1];
							var url = urlTitle[0];
							var downLoad = '<span>'+title+'<a href="'+url+'" style="">(下载)</a></span>';
							editor.insertHtml(downLoad);
						}
					}
					document.getElementById('resListIframe').contentWindow.ref();
				}
			}
		},
		onLoad:function(){
			
		}
	};
});
