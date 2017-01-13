<%@ page language="java" import="java.util.*" pageEncoding="UTF-8" contentType="text/html;charset=UTF-8"%>
<%
String path = request.getContextPath();
%>
CKEDITOR.editorConfig = function(config) {
	var __basePath = "<%=path %>";
	config.language = 'zh-cn';
	//config.uiColor = '#FFF';			//背景颜色   
	config.width = 'auto';				//宽度   
	//config.height = '300';			//高度   
	config.skin = 'kama';				//界面v2,kama,office2003
	config.toolbar = 'ExtToolbar';		//工具栏风格Full,Basic
	//config.filebrowserBrowseUrl = __basePath + '/ckeditor/browse';
	//config.filebrowserImageBrowseUrl = __basePath + '/ckeditor/browse?type=image';
	//config.filebrowserFlashBrowseUrl = __basePath + '/ckeditor/browse?type=flash';
	//config.filebrowserFlvBrowseUrl = __basePath + '/ckeditor/browse?type=flv';
	//config.filebrowserUploadUrl = __basePath + '/ckeditor/uploader?type=file';
	//config.filebrowserImageUploadUrl = __basePath + '/ckeditor/uploader?type=image';   
	//config.filebrowserFlashUploadUrl = __basePath + '/ckeditor/uploader?type=flash';
	config.extraPlugins = 'uicolor,flv,gallery,audio,document,groupgallery'; // 添加的扩展插件
	config.uiColor = '#e6f0fa';
	config.toolbar_ExtToolbar = [ // 工具栏功能按钮,需要时，可以在下面合适的位置添加
         ['Source','Bold','Italic','Underline','Strike','NumberedList','BulletedList',
         'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Link','Unlink',
         'Anchor','gallery','groupgallery','flv','document','audio','Table','HorizontalRule','PageBreak'],
         '/',
         ['Styles','Format','Font','FontSize','TextColor','BGColor','Maximize']
     ];
};
