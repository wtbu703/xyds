CKEDITOR.plugins.add('groupgallery', {
	init : function(editor) {
		var pluginName = 'groupgallery';
		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/groupgallery.jsp');
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
		editor.ui.addButton('groupgallery', {
			label : '插入组图图片',
			icon: 'plugins/groupgallery/gallery.gif',
			command : pluginName
		});
	}
});
