CKEDITOR.plugins.add('flv', {
	init : function(editor) {
		var pluginName = 'flv';
		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/flvplayer.jsp');//对话框
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));//添加命令
		editor.ui.addButton('flv', {
			label : '插入FLV视频',
			icon: 'plugins/flv/flv.gif',
			command : pluginName
		});
	}
});