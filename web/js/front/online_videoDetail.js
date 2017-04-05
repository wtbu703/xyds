$(document).ready(function(){

	//在线视频详情
    var video = $('.row_video');
    var video_html = [];
    $.ajax({
        url:findUrl,
        type:"post",
        dataType:"json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){   
                video_html.push('<div class="col-xs-12">');
                video_html.push('<h5>'+ n.name +'</h5>');
                video_html.push('<div class="train_media">');
                video_html.push('<video controls="controls">');
                video_html.push('<source src="'+ n.url +'" type="video/mp4" />');
                video_html.push('<source src="'+ n.url +'" type="video/ogg" />');
                video_html.push('<source src="'+ n.url +'" type="video/webm" />');
                video_html.push('<object data="'+ n.url +'" >');
                video_html.push('<embed src="'+ n.url +'"  />');
                video_html.push('</object>');
                video_html.push('</video>');
                video_html.push('</div>');
                video_html.push('</div>');
               
            });
            video.append(video_html.join(''));
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



})