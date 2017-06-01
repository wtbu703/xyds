$(document).ready(function(){
    getMore();

});
function getMaodian(){
     $('.maodian').each(function(){
         $(this).click(function(){
             $('body,html').animate({scrollTop:10},100);
        });
    });
 }
function getMore(page) {
    page = page||0;
    var search = $('.content');//定位到需要插入的DIV
    var searchtml = [];//新建一个数组变量
    var paraStr = 'title='+title+'&page='+page;
    $.ajax({
        url: searchUrl,//后台给的
        type: "post",//发送方法
        data:paraStr,
        dataType: "json",//返回的数据格式
        async: false,
        success: function (data) {//如果成功即执行
            var seadata = JSON.parse(data.sea);
            search.html('');
            searchtml.push('<div class="col-xs-12 col-md-10 col-lg-10 searchcon">');
            searchtml.push('<div class="col-xs-12 col-md-12 col-lg-12 content_top">');
            searchtml.push('<img name="001" class="img-responsive" src="images/images_common/home_icon.png" />');
            searchtml.push('<span>为您找到相关搜索为'+data.totalCount+'个</span>');
            searchtml.push('</div>');
            searchtml.push('<div class="col-xs-12 col-md-12 col-lg-12 content_con">');
            var mynum = data.totalCount;
            if(mynum == 0){
                searchtml.push('<div class="tipinfo"><span class="infoo">您搜索的信息不存在!</span></div>');
            }else {
                $.each(seadata, function (i, n) {//遍历返回的数据 共6条
                    var artime = time(n.datetime);
                    var txt = n.content.replace(/<[^>]+>/g, "");
                    if (txt.length > 150) {
                        var brief = txt.substr(0, 150) + "...";
                    } else {
                        var brief = txt.substr(0, 150);
                    }
                    var key1 = n.title;
                    var fen = key1.split(title);
                    var Keyword = fen.join('<span style="padding:0;color:#c62f2f;">' + title + '</span>');
                    searchtml.push('<div class="content_box">');
                    searchtml.push('<h4><a href="' + articleUrl + '&articleId=' + n.id + '" >' + Keyword + '</a></h4>');//标题
                    searchtml.push('<div class="content_info">');
                    searchtml.push('<span>类别：' + n.category + ' </span><span>来源：' + n.author + ' </span><span>时间：' + artime + ' </span><span>关键词：' + n.keyword + ' </span>');
                    searchtml.push('</div>');
                    searchtml.push('<p><a href="' + articleUrl + '&articleId=' + n.id + '">' + brief + '</a></p>');//内容
                    searchtml.push('</div>');
                    searchtml.push('<div class="content_line"></div>');

                    //以原格式组装好数组
                });
            }
            search.append(searchtml.join(''));//把数组插入到已定位的DIV

            getPage(data.pageSize,data.page,data.totalCount);
            getMaodian();
        },
        error: function () {
        }
    });
}

function getPage(pageSize,page,totalCount){
    var totalPage = Math.ceil(totalCount/pageSize);
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    if(totalPage >1) {
        pagehtml.push('<li><a>' + totalCount + '条/' + totalPage + '页</a></li>');
        if (page > 0) {//不止一页
            pagehtml.push('<li><a href="javascript:getMore(\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:getMore(' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a href="#">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:getMore(' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:getMore(' + last + ')" class="maodian">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page" id="pagevalue" value=" ' + next + '"/>');
            pagehtml.push('<a class="pagego maodian">GO</a>');// href="javascript:getMore(' + p + ')"
        }
    }
    //以原格式组装好数组
    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount);
}


//搜索框为数字
function inputNum(pageSize,totalCount){
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
               getMore(p);
           }else{
               getMore(0);
           }
       });
    });
}
