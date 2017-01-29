// 全选
function selectall(id){
	var len=$("input[name='"+ id +"']:checked").size();
	if(len == 0){
		$('input[type=checkbox]').attr('checked', true);
	}else{
		$('input[type=checkbox]').attr('checked', false);
	}
}

//生成字典下拉框
//dictCode 表示字典标识
//selectId 表示页面需要生产字典中的select元素Id
//name 表示该字典的中文名称
function generateDict(dictCode,selectId,name){
	var dictArray = new Array();
	dictArray.push("<option value='' selected><--请选择"+name+"--></option>");
	$.ajax({
		url:"index.php?r=dict/findall",
		type:"post",
		dataType:"json",
		data:"dictCode="+dictCode,
		async:false,
		success:function(data){
			$.each(data,function(i,n){
				dictArray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
			});
			$('#'+selectId).html(dictArray.join(''));
		},
		error:function (data) {
			window.top.art.dialog({content:'加载字典组出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		}
	});

}



//屏蔽F5,右键菜单 
/*document.onkeydown = function(evt) {
	var event = window.event||arguments[0];
	var key = event.keyCode?event.keyCode:event.charCode; //兼容IE和Firefox获得keyBoardEvent对象的键值
	if(key==116){   
		if(event.keyCode) event.keyCode=0;   
		else event.charCode=0;   
 	 	event.returnValue = false;   
  	}   
}
document.oncontextmenu = function(evt){ return false;  }*/
//判断字符串是否为空以及空字符串
function str_is_null(str){
	if(str == null || str == undefined || str == '' || str == 'undefined'){
		return true;
	}else{
		return false;
	}
}