CKEDITOR.plugins.add( 'image',
{
	init : function( editor )
	{
		// Add the link and unlink buttons.
		editor.addCommand( 'image', new CKEDITOR.dialogCommand( 'image' ) );
		
		editor.ui.addButton( 'Page',{
				// label : editor.lang.link.toolbar,
				label : "Image",
				// icon: 'images/anchor.gif',//图标
				command : 'image'
				} );

		// CKEDITOR.dialog.add( 'link', this.path + 'dialogs/link.js' );
		CKEDITOR.dialog.add( 'image', function( editor ){
				return {
				title : '文章分页',
				minWidth : 350,
				minHeight : 100,
				contents : [
					{
					id : 'tab1',
					label : 'First Tab',
					title : 'First Tab',
					elements :
						[
						 {
							id : 'pagetitle',
							type : 'text',
							label : '请输入下一页文章标题<br />(不输入默认使用当前标题+数字形式)'
						 }
						 ]
					}],
				onOk : function(){
					editor.insertHtml("[page="+this.getValueOf( 'tab1', 'pagetitle' )+"]");
					}
				};
		} );
	},

	requires : [ 'fakeobjects' ]
}
);
