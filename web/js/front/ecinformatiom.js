$(document).ready(function(){
/* 
        这里将所有接口注释以保证页面js正常运行，用到的时候取消注释即可
   */
  
    //文章
    function ziXun1(newsType){
        var rowNews = $('.information_main');
        var rowNews_html = [];
        $.ajax({
            url: findUrl,
            type: "post",
            dataType: "json",
            async: false,
            data: newsType,
            success:function(data){
                $.each(data,function(i,n){
                    //时间格式转换为 2017-12-02
                    var d = n.datetime;
                    var date = new Date(d);
                    var out = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());   
                    rowNews_html.push('<div class="information_content">');   
                    /* 循环6遍  */ 
                    rowNews_html.push('<div class="row">');
                    rowNews_html.push('<div class="col-xs-4">');
                    rowNews_html.push('<a href="ecinformationDetail.html"><img class="img-responsive" src="'+ n.picUrl +'" alt="新闻图片"></a>');
                    rowNews_html.push('</div>');
                    rowNews_html.push('<div class="col-xs-8 news">');
                    rowNews_html.push('<h5><a href="ecinformationDetail.html">'+ n.title +'</a></h5>');
                    rowNews_html.push('<p><a href="ecinformationDetail.html">'+ n.content +'</a></p>');
                    rowNews_html.push('<span>发布时间：'+ out +'</span>');
                    rowNews_html.push('</div>');
                    rowNews_html.push('</div>');
                    rowNews_html.push('<hr />');
                    /* END循环6遍  */ 
                    rowNews_html.push('</div>');
                });
                rowNews.append(rowNews_html.join(''));
            },
            error:function(){
                
            }
        });
    }

    //选项卡切换
    var $tab_list = $('.information_list li');
    $tab_list.hover(function(){
        $(this).addClass('active').siblings().removeClass('active');
        var index = $tab_list.index(this);
        ziXun1(index);
        $('div.information_main > div').eq(index).show().siblings().hide();
    })

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