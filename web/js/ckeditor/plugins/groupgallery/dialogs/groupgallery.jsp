<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
String path = request.getContextPath();
%>
CKEDITOR.dialog.add('groupgallery',function(editor){
	//var escape=function(value){return value;};
	return{
		title:'插入组图组件',
		resizable:CKEDITOR.DIALOG_RESIZE_NONE,
		minWidth:800,
		minHeight:370,
		/*buttons:[{
		    type:'button',
		    id:'someButtonID',  note: this is not the CSS ID attribute! 
		    label: 'Button',
		    onClick: function(){
		      //action on clicking the button
		    }},CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton],*/
		contents:[{
			id:'info',
			label:'组图列表',//常规
			accessKey:'P', // 输出 如果域是空的，那么错误消息将在你点击ok按钮的时候弹出.
			elements:[{
				type:'hbox',				
				children:[{
					id:'reslist',
					type:'html',
					style:'width:100%;height:170px;display:block',
					html:'<iframe id="groupListIframe"  frameborder="0″ width="760" height="370" style="width:760px;height:370px;border:0px" src="'+path+'/admin/ckplugin/group/picture_group_browse.jsp?categoryId='+categoryId+'"/>'
				}]
			}]
		}],
		onOk:function(){
			var groupId = document.getElementById('groupListIframe').contentWindow.pickResource();
			var len = groupId.length;
			if (groupId != null && groupId != '') {
				datastr = "resType=picture&perPage=10000&state=-1&orderField=uploadTime&orderMethod=descending&page=1";
				datastr += "&groupId="+ groupId;
				datastr+="&dfield=title,1;filePath,1;serverIndex,1;thubmServerIndex,1;thumbnail,1;uploadUserName,1;uploadTime,6;";
				//查询分组中所有资源
				$.ajax({
					url:path+"/ResFetch.do?action=catResListXml", 
					type:"post", 
					dataType:"xml", 
					data:datastr, 
					success:function (data) {
						var picArray = new Array(); 
						//分页JS
						var gpInsert ='<div id="gallery" class="ad-gallery" align="center" style="background: #e1eef5;">';
						gpInsert+='<div class="ad-image-wrapper"></div>';
						gpInsert+='<div class="ad-controls" id="controls"></div>';
						gpInsert+='<div class="ad-nav">';
						gpInsert+='<div class="ad-thumbs" align="center">';
						gpInsert+='<ul id="pic_roll" class="ad-thumb-list">';
						
						//生成图片
						var tag = '';
						$(data).find('picture').each(function(i){
							tag = 'tag';
							var id = $(this).find('id').text();
							var model = $(this).find('model').text();
							var title = $(this).find('title').text();
							var serverIndex  = $(this).find('serverIndex ').text();
							var filePath = $(this).find('filePath').text();
							var thubmServerIndex  = $(this).find('thubmServerIndex ').text();
							var thumbnail = $(this).find('thumbnail').text();
							picArray.push('<li><a href="'+path+'/web/ResView.do?server='+thubmServerIndex+'&resType=picture&bigImg=bigImg&filepath='+thumbnail+'" >');
							picArray.push('<img src="'+path+'/web/ResView.do?server='+thubmServerIndex+'&resType=picture&filepath='+thumbnail+'" id="'+ id +'" height="60" class="image'+i+'">');
							picArray.push('</a></li>');
						});
						if(tag == '') picArray.push('<div class="leaveword" align="center"><p>暂无图片</p></div>');
						gpInsert+=picArray.join('');
						gpInsert+='</ul></div></div></div><p></p>';
						editor.insertHtml(gpInsert);
					}
					});
					}
		},
		onLoad:function(){
			
		}
		
	};
});