function ziXun1(newsType,page){
    var rowNews = $('.information_main');
    var rowNews_html = [];
    var paraStr = 'newsType='+newsType+'&page='+page;
    $.ajax({
        url: articleUrl,
        type: "post",
        dataType: "json",
        async: false,
        data: paraStr,
        success:function(data){
            var articledata = JSON.parse(data.article);
            rowNews.html('');
            rowNews_html.push('<div class="information_content">');
            $.each(articledata,function(i,n){
                //时间格式转换为 2017-12-02
                var out = daytime(n.datetime);
                var content = texthtml(n.content);
                /* 循环6遍  */ 
                rowNews_html.push('<div class="row">');
                rowNews_html.push('<div class="col-xs-4">');
                rowNews_html.push('<a href="'+detailUrl+'&articleId='+n.id+'"><img class="img-responsive" src="'+ n.picUrl +'" alt="新闻图片"></a>');
                rowNews_html.push('</div>');
                rowNews_html.push('<div class="col-xs-8 news">');
                rowNews_html.push('<h5><a href="'+detailUrl+'&articleId='+n.id+'">'+ n.title +'</a></h5>');
                rowNews_html.push('<p><a href="'+detailUrl+'&articleId='+n.id+'">'+ content +'</a></p>');
                rowNews_html.push('<span>发布时间：'+ out +'</span>');
                rowNews_html.push('</div>');
                rowNews_html.push('</div>');
                rowNews_html.push('<hr />');
                /* END循环6遍  */ 
                
            });
            rowNews_html.push('</div>');
            rowNews.append(rowNews_html.join(''));
            getPage(data.pageSize,data.page,data.totalCount,newsType);
        },
        error:function(){
            
        }
    });
}
function getPage(pageSize,page,totalCount,cat){
    var totalPage = Math.ceil(totalCount/pageSize);
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    pagehtml.push('<li><a>'+totalCount+'条/'+totalPage+'页</a></li>');
    if(page > 0) {
        pagehtml.push('<li><a href="javascript:ziXun1('+cat+',\'0\')">首页</a></li>');
        pagehtml.push('<li><a href="javascript:ziXun1('+cat+','+prev+')" aria-label="Previous">上一页</a></li>');
    }
    pagehtml.push('<li><a href="javascript:ziXun1('+cat+','+page+')">'+next+'</a></li>');
    if(page < last&&totalPage > 1) {
        pagehtml.push('<li><a href="javascript:ziXun1('+cat+','+next+')" aria-label="Next">下一页</a></li>');
        pagehtml.push('<li><a href="javascript:ziXun1('+cat+','+last+')">尾页</a></li>');//跳转到信息公开详情页
    }
    if(totalPage > 1) {
        pagehtml.push('<input type="text" name="page"  id="pagevalue" value="'+next+'"/>');
        var p = "$('#pagevalue').val()";
        pagehtml.push('<a class="pagego" href="javascript:ziXun1('+cat+','+p+')">GO</a>');
    }

    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV

}
function hotNews(){
    var hotnews = $('.hotNews');
    var hotnews_html = [];
    $.ajax({
        url: hotNewsUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            hotnews_html.push('<ul >');
            $.each(data,function(i,n){
                if(i>=0&&i<=2)
                {
                    hotnews_html.push('<li class="news_arrow">');
                    hotnews_html.push('<a href="'+detailUrl+'&articleId='+n.id+'"><span>·</span>'+ n.title +' </a>');
                    hotnews_html.push('</li>');
                }
                else{
                    hotnews_html.push('<li>');
                    hotnews_html.push('<a href="'+detailUrl+'&articleId='+n.id+'"><span>·</span>'+ n.title +' </a>');
                    hotnews_html.push('</li>');
                }  
            });
            hotnews_html.push('</ul >');
            hotnews.append(hotnews_html.join(''));
        },
        error:function(){
            
        }
    });
}
function hotCompany(){
    var hotcompany = $('.hotCompany');
    var hotcompany_html = [];
    $.ajax({
        url: hotCompanyUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){
                hotcompany_html.push('<div class="row company">');
                hotcompany_html.push('<div class="col-xs-5 ">');
                hotcompany_html.push('<a href="'+companyDetailUrl+'&id='+n.id+'"><img class="img-responsive " src="'+ n.logoUrl +'" alt="新闻图片"></a>');
                hotcompany_html.push('</div>');
                hotcompany_html.push('<div class="col-xs-7 hot_company">');
                hotcompany_html.push('<h5><a href="'+companyDetailUrl+'&id='+n.id+'">'+ n.name +'</a> </h5><p><a href="'+companyDetailUrl+'&id='+n.id+'">'+ n.introduction +'</a></p>');
                hotcompany_html.push('</div>');
                hotcompany_html.push('</div>');
            });
            hotcompany.append(hotcompany_html.join(''));
        },
        error:function(){
            
        }
    });
}
$(document).ready(function(){

    ziXun1(0,0);
    //文章
   
    //选项卡切换
    var $tab_list = $('.information_list li');
    $tab_list.click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        var index = $tab_list.index(this);
        ziXun1(index,0);
        $('div.information_main > div').eq(index).show().siblings().hide();
    });

    //热点新闻
    hotNews();
    //热们企业
    hotCompany();
    
});