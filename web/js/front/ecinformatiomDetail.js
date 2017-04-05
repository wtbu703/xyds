$(document).ready(function(){
/* 
        这里将所有接口注释以保证页面js正常运行，用到的时候取消注释即可
   */
  
    //文章
    var article = $('.article');
    var article_html = [];
    $.ajax({
        url: findUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){
                //时间格式转换为 2017-12-02
                var d = n.datetime;
                var date = new Date(d);
                var out = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());         
                article_html.push('<div class="col-xs-12"><h5>'+ n.title +'</h5></div>');
                article_html.push('<div class="col-xs-12 article_msg"><div>');
                article_html.push('<span>发布者：'+ n.author +'</span>');
                article_html.push('<span>'+n.sourceUrl+'</span>');
                article_html.push('<span>点击次数：'+n.count+'</span>');
                article_html.push('<span>更新时间：'+ out +'</span>');
                article_html.push('<span>关键字：'+ n.keyword +'</span>');
                article_html.push('</div></div>');
                article_html.push('<div class="col-xs-12">');
                article_html.push('<img class="img-responsive" src="'+ n.picUrl +'" alt="新闻图片">');
                article_html.push('</div>');
                article_html.push('<div class="col-xs-12">');
                article_html.push('<p>'+ n.content +'</p>');
                article_html.push('</div>');
                article_html.push('<div class="col-xs-12 article_attachment"><span>附件：</span><a href="#">'+ n.attachUrls +'</a></div>');
                article_html.push('<div class="col-xs-12"><div class="article_hr"></div></div>');
                article_html.push('<div class="col-xs-12">');
                article_html.push('<ul class="page"><li><h5><a href="#">上一篇：'+ n.title +'</a></h5><span>'+ out +'</span></li><li><h5><a href="#">下一篇：'+ n.title +'</a></h5><span>'+ out +'</span></li></ul>');
                article_html.push('</div>');
            });
            article.append(article_html.join(''));
        },
        error:function(){
            
        }
    });

    //热点新闻
    var hotnews = $('.hotNews');
    var hotnews_html = [];
    $.ajax({
        url: findUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){
                hotnews_html.push('<ul >');
                hotnews_html.push('<li class="news_arrow">');
                hotnews_html.push('<a href="ecinformationDetail.html"><span>·</span>'+ n.title +' </a>');
                hotnews_html.push('</li>');
                hotnews_html.push('<li>');
                hotnews_html.push('<a href="ecinformationDetail.html"><span>·</span>'+ n.title +' </a>');
                hotnews_html.push('</li>');
                hotnews_html.push('</ul >');
            });
            hotnews.append(hotnews_html.join(''));
        },
        error:function(){
            
        }
    });

    //热们企业
    var hotcompany = $('.hotCompany');
    var hotcompany_html = [];
    $.ajax({
        url: findUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){
                hotcompany_html.push('<div class="row company">');
                hotcompany_html.push('<div class="col-xs-5 ">');
                hotcompany_html.push('<a href="enterprisedetail.html"><img class="img-responsive " src="'+ n.logoUrl +'" alt="新闻图片"></a>');
                hotcompany_html.push('</div>');
                hotcompany_html.push('<div class="col-xs-7 hot_company">');
                hotcompany_html.push('<h5><a href="enterprisedetail.html">'+ n.name +'</a> </h5><p><a href="enterprisedetail.html">'+ n.introduction +'</a></p>');
                hotcompany_html.push('</div>');
                hotcompany_html.push('</div>');
            });
            hotcompany.append(hotcompany_html.join(''));
        },
        error:function(){
            
        }
    });
    
}