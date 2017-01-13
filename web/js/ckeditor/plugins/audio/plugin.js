CKEDITOR.plugins.add('audio', {
	init : function(editor) {
		var pluginName = 'audio'; // 名称
		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/audio.jsp'); // 弹出一个对话框
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName)); // 命令的两个参数，命令的名称，命令的对象,如果没有命令，则不打开对话框
		editor.ui.addButton('audio', { // 函数 两个参数，一个按钮名称，一个按钮定义
			label : '插入音频', // 鼠标经过时，显示的字
			icon: 'plugins/audio/audio.png', // 按钮引入的图片
			command : pluginName 
		});
	}
});
