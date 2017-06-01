function onlineVideo(newsType,page){
    newsType = newsType||0;
    page = page||0;
    var onlineVideo = $('.online_video');
    var onlineVideo_html = [];
    $.ajax({
        url:videoUrl,
        type:"post",
        dataType:"json",
        data: "newsType="+newsType+"&page="+page,
        async: false,
        success:function(data){
            var videodata = JSON.parse(data.video);
            onlineVideo.html('');
            onlineVideo_html.push('<div class="row">');
            $.each(videodata,function(i,n){
                onlineVideo_html.push('<div class="col-xs-12 col-sm-12 col-md-4 "><div class="list"><div class="row"><div class="col-xs-12">');
                onlineVideo_html.push('<a target="_blank" href="'+videoDetailUrl+'&videoId='+n.id+'"><img class="img-responsive center-block" src="'+ n.picUrl +'" alt="图片" /></a>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('<div class="row list_text"><div class="col-xs-9">');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('<div class="col-xs-3 list_btn"><a target="_blank" class="btn btn-default" href="'+videoDetailUrl+'&videoId='+n.id+'" role="button">进入学习</a></div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');  
            });
            onlineVideo_html.push('</div>');
            onlineVideo.append(onlineVideo_html.join(''));

            //分页
            getPage(data.pageSize,data.page,data.totalCount,newsType);
            getMaodian();
        },
        error:function(){
            
        }
    });

}

//分页
function getPage(pageSize,page,totalCount,cat){
    var totalPage = Math.ceil(totalCount/pageSize);
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    if(totalPage >1) {
        pagehtml.push('<li><a>' + totalCount + '条/' + totalPage + '页</a></li>');
        if (page > 0) {
            pagehtml.push('<li><a href="javascript:onlineVideo(' + cat + ',\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:onlineVideo(' + cat + ',' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a class="maodian" href="javascript:onlineVideo(' + cat + ',' + page + ')">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:onlineVideo(' + cat + ',' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:onlineVideo(' + cat + ',' + last + ')">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page"  id="pagevalue" value="' + next + '"/>');
            pagehtml.push('<a class="pagego maodian" >GO</a>');
        }
    }
    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount,cat);
}
//搜索框为数字
function inputNum(pageSize,totalCount,cat){
    var totalpage = Math.ceil(totalCount/pageSize);
    $('.numInput').keyup(function(event){
        if(this.value.length==1){
            this.value=this.value.replace(/[^1-9]/g,'');
        }else{
            this.value=this.value.replace(/\D/g,'');
        }
        var p = this.value-1;
        $('.pagego').click(function(){
            if(p<=totalpage){
                onlineVideo(cat,p);
            }else{
                onlineVideo(cat,0);
            }
        });
    });
}
//点击分页回到顶部
function getMaodian(){
    $('.maodian').each(function(){
        $(this).click(function(){
            $('body,html').animate({scrollTop:10},100);
            // location.href = "#001";
        });
    });
}

//选项卡标题
	function video_column(){
		var column = $('.column');
		var column_html = [];
		$.ajax({
	        url:videoDictUrl,
	        type:"post",
	        dataType:"json",
	        data: "newsType",
	        async: false,
	        success:function(data){
	        	$.each(data,function(i,n){
	        		if(i == 0){
	        			column_html.push('<a  class="btn btn-default col-xs-12 col-sm-2 col-md-1 tabH tab_btn1 hover" role="button">n.dictItemName</a>');
	        		}
	                column_html.push('<a  class="btn btn-default col-xs-12 col-sm-2 col-md-1 tabH tab_btn1" role="button">n.dictItemName</a>');
	            })
	        }
	    })
	}

$(document).ready(function(){

	//选项卡标题
    //video_column();
		
	//在线视频
    onlineVideo();

    //选项卡切换 
    var $tab_list = $('.column a');
    $tab_list.click(function(){
        $(this).addClass('hover').siblings().removeClass('hover');
        var index = $tab_list.index(this);
        onlineVideo(index,0);
        $('div.online_video > div').eq(index).show().siblings().hide();
    })




});