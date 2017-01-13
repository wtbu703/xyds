// 生成FCK js 并返回给 contentEditor 对象
// contentEditor.getData()可以获取到FCK中值；contentEditor.setData(content); 将值存放到FCK窗口
function genEditor(path,fieldName,param){
	return CKEDITOR.replace(fieldName,{

		filebrowserWindowWidth : '100%',
		filebrowserWindowHeight : '100%'
	});
}
