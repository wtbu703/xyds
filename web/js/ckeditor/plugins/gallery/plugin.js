CKEDITOR.plugins.add('gallery', {
	init : function(editor) {
		var pluginName = 'gallery';
		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/gallery.jsp');
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
		editor.ui.addButton('gallery', {
			label : '插入图片',
			icon: 'plugins/gallery/pic.png',
			command : pluginName
		});
	}
});