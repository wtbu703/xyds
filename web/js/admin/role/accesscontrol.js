// 加载页面时 就执行的方法
$(function(){
	$("#menu_tree").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview-black"
	});
	if(menuIds!='' && menuIds!=null && menuIds!='null') hasMenu();
}) 

// 将已有菜单显示
function hasMenu(){
	var menuArray = menuIds.split(",");
	$("input[name='menuId']:checkbox").each(function(){
		var	ids = $(this).attr("id");
		var	menuValue = $(this).val();
		for(var k = 0; k < menuArray.length;k++){
			if(menuArray[k] == menuValue) $('#'+ids).attr('checked','checked');
		}
	});
}

// 选择菜单
function selectMenu(menuId){
	var tag = $("#"+menuId).attr("checked"); //判断多选框是否被选中 boolean
	$("input[name='menuId']:checkbox").each(function(){
		var	ids = $(this).attr("id");
		if(ids.indexOf(menuId) != -1 || menuId.indexOf(ids) != -1){
			if(tag == true) {   // 多选框已经选中
				$('#'+ids).attr("checked","checked");
			}else if(ids.indexOf(menuId) != -1){ 
				$('#'+ids).attr("checked","");
			}
		}
	});
}

// 选择的菜单
function sendMenu(){
	var len=$("input[name='menuId']:checked").size();
	var ids='';
	$("input[name='menuId']:checked").each(function(i, n){
		if(i<len-1){
			ids += $(n).val() + ',';
		}else{
			ids += $(n).val();
		}
	});
	window.location.href=sendmenuUrl+"&ids="+ids+"&roleId="+roleId;
}