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
    //热点新闻
    hotNews();
    //热门企业
    hotCompany();
});