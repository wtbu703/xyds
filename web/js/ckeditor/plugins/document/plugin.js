CKEDITOR.plugins.add('document', {
	init : function(editor) {
		var pluginName = 'document';
		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/document.jsp');//对话框
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));//添加命令
		editor.ui.addButton('document', {
			label : '插入文档',
			icon: 'plugins/document/document.png',
			command : pluginName
		});
	}
});