<%@ page language="java" import="java.util.*" pageEncoding="UTF-8" contentType="text/html;charset=UTF-8"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";   

%>
CKEDITOR.editorConfig = function(config) {
	var __basePath = "<%=basePath %>";
	config.language = 'zh-cn';
	config.width = 'auto';				//宽度   
	config.skin = 'kama';				//界面v2,kama,office2003
	config.toolbar = 'Basic';		//工具栏风格Full,Basic
};
