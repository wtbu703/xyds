// 分页js
var page;
var pageCount;
var goPage;
function page(num){
	var pageNum = Number(num);
	switch(pageNum){
		case 0:// 输入的页码
			goPage = $('#goPage').val();
			pageCount = $('#pageCount').val();
			if(isNaN(goPage)){
				alert('请输入数字');
				return;
			}
			if(Number(goPage)<1||Number(goPage)>Number(pageCount)){
				alert('输入的页码不存在');
				return;
			}else{
				page = goPage;
			}
		break;
		case 1://首页
			page = 1;
		break;
		case 2://上一页
			page = $('#curPage').val();
			page = Number(page);
		break;
		case 3://下一页
			page = $('#curPage').val();
			page = Number(page)+2;
		break;
		case 4://尾页
			page = $('#pageCount').val();
		break;
		default:
		break;
	}
	$('#page').val(page);
	$('#pageForm').submit();
}


