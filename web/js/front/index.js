function ziXun(newsType=0){
    var zixun = $('.tab');
    var zixun_html = [];
    $.ajax({
        url: indexUrl,
        type: "post",
        dataType: "json",
        data: "newsType="+newsType,
        async: false,

        success:function(data){
            var jsonLength = length(data);
            zixun_html.push('<div class="row">');
            zixun.html('');
            $.each(data,function(i,n){
                var taday = time(n.datetime);
                var html_text = texthtml(n.content);
                
                if(i == 0){
                    zixun_html.push('<div class="col-xs-12 col-sm-12 col-md-4 distance_b">');
                    zixun_html.push('<div class="carousel-inner zixun_banner" >');
                    zixun_html.push('<div class="item active">');
                    zixun_html.push('<a href="'+ecInfoDetailUrl+'&articleId='+n.id+'">');
                    zixun_html.push('<img class="center-block" src="'+ n.picUrl +'" alt="年货大战" />');
                    zixun_html.push('</a>');
                    zixun_html.push('<div class="zixun_text">');
                    zixun_html.push('<h5><a href="'+ecInfoDetailUrl+'&articleId='+n.id+'">'+ n.title +'</a></h5>');
                    zixun_html.push('<img src="images/images_index/zixun_linered.png" alt="">');
                    zixun_html.push('<p><a href="'+ecInfoDetailUrl+'&articleId='+n.id+'">'+ html_text +'</a></p>');
                    zixun_html.push('</div>');
                    zixun_html.push('</div>');
                    zixun_html.push('</div>');
                    zixun_html.push('</div>');
                }else{

                    if (i == 1 || i == 7) {
                        zixun_html.push('<div class="col-xs-12 col-sm-12 col-md-4 zixun_camera">');
                        zixun_html.push('<a href="'+ecInfoDetailUrl+'&articleId='+n.id+'">');
                        zixun_html.push('<img class="img-responsive " src="' + n.picUrl + '" alt="新闻图片">');
                        zixun_html.push('</a>');
                        zixun_html.push('<ul >');
                    } else {
                        zixun_html.push('<li>');
                        zixun_html.push('<h5><a href="'+ecInfoDetailUrl+'&articleId='+n.id+'">' + n.title + '</a></h5><span>' + taday + '</span>');
                        zixun_html.push('</li>');
                    }
                    if( (1 < jsonLength < 7 && i == jsonLength) && (7 < jsonLength < 12 && i == jsonLength) ){
                        zixun_html.push('</ul>');
                        zixun_html.push('</div>');
                    }
                    if(i == 6 || i == 12){
                        zixun_html.push('</ul>');
                        zixun_html.push('</div>');
                    }
                }

            });
            zixun_html.push('</div>');
            zixun.append(zixun_html.join(''));
        },
        error:function(){

        }
    });
}

//招标传参
function tenderd(tl,t){
    var course = $('.tender_process'); //9个文字进展
    var times = $('.tender_times'); //9个时间

    $(course[tl]).addClass('active').siblings().removeClass('active');
    $(times[tl]).addClass('active_time').siblings().removeClass('active_time');

    times.each(function(n){
        if(n>tl){
            $(this).html('');
        }else{
            $(this).html(t);
        }
    })
}

//信息公开 招标进展
function row_public(id){

    var rowpublic = $('.row_public');
    var rowpublic_html = [];
 
    $.ajax({
        url: stateUrl,
        type: "post",
        data: 'id='+id,
        dataType: "json",
        success:function(data){
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender"><span class="col-xs-3 tender_process testq">招标公示</span><img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">招标保名</span><img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">资格审查</span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender tender_time"><span class="col-xs-3 tender_times"></span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender_img "><div class="col-xs-3"></div><div class="col-xs-1"></div><div class="col-xs-3"></div><div class="col-xs-1"></div><div class="col-xs-3"><img class=" " src="images/images_index/xinxi_arrow2.png" alt=""></div></div>');
            rowpublic_html.push('</div>');

            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender"><span class="col-xs-3 tender_process">缴保证金</span><img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">编制文件</span><img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">招标答疑</span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender tender_time"><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender_img "><div class="col-xs-3"><img class=" " src="images/images_index/xinxi_arrow2.png" alt=""></div><div class="col-xs-1"></div><div class="col-xs-3"></div><div class="col-xs-1"></div><div class="col-xs-3"></div></div>');
            rowpublic_html.push('</div>');

            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender"><span class="col-xs-3 tender_process">招标公示</span><img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">招标保名</span><img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">资格审查</span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender tender_time"><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span></div>');
            rowpublic_html.push('</div>');
            
            rowpublic.append(rowpublic_html.join(''));
            var statl = data.length-1;
            $.each(data,function(i,n) {
                var times = timepoint(n.time);
                tenderd(statl,times);
            });
        },
        error:function(){

        }
    });
}


$(document).ready(function(){
    //电商资讯
    ziXun(0);

    //电商培训
    var train = $('.row_train');
    var train_html = [];
    $.ajax({
        url:findUrl,
        type:"post",
        dataType:"json",
     
        async: false,
        success:function(data){
                train_html.push('<div class="item active">');
                train_html.push('<a href="'+trainDetailUrl+'&id='+data[0].id+'"><img class="center-block" src="'+ data[0].thumbnailUrl +'" alt="新闻图片" /></a>');
                train_html.push('<div class="zixun_text">');
                train_html.push('<h5><a href="'+trainDetailUrl+'&id='+data[0].id+'">'+ data[0].name +'</a></h5>');
                train_html.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                train_html.push('<p><a href="'+trainDetailUrl+'&id='+data[0].id+'">'+ data[0].content +'</a></p>');
                train_html.push('</div>');
                train_html.push('</div>');
                //下面是第二篇新闻
                train_html.push('<div class="item">');
                train_html.push('<a href="'+trainDetailUrl+'&id='+data[1].id+'"><img class="center-block" src="'+ data[1].thumbnailUrl +'" alt="新闻图片" /></a>');
                train_html.push('<div class="zixun_text">');
                train_html.push('<h5><a href="'+trainDetailUrl+'&id='+data[1].id+'">'+ data[1].name +'</a></h5>');
                train_html.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                train_html.push('<p><a href="'+trainDetailUrl+'&id='+data[1].id+'">'+ data[1].content +'</a></p>');
                train_html.push('</div>');
                train_html.push('</div>');
                 //下面是第三篇新闻
                train_html.push('<div class="item">');
                train_html.push('<a href="'+trainDetailUrl+'&id='+data[2].id+'"><img class="center-block" src="'+ data[2].thumbnailUrl +'" alt="新闻图片" /></a>');
                train_html.push('<div class="zixun_text">');
                train_html.push('<h5><a href="'+trainDetailUrl+'&id='+data[2].id+'">'+ data[2].name +'</a></h5>');
                train_html.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                train_html.push('<p><a href="'+trainDetailUrl+'&id='+data[2].id+'">'+ data[2].content +'</a></p>');
                train_html.push('</div>');
                train_html.push('</div>'); 
            train.append(train_html.join(''));
        },
        error:function(){
            
        }
    });

    //在线视频
    var onlineVideo = $('.train_media');
    var onlineVideo_html = [];
    $.ajax({
        url: VideoUrl,
        type: "post",
        dataType: "json",
     
        async: false,
        success:function(data){
            $.each(data,function(i,n){     
                //此处的url链接到同一个视频
                onlineVideo_html.push('<video controls="controls">');
                onlineVideo_html.push('<source src="'+ n.url +'" type="video/mp4" />');
                onlineVideo_html.push('<source src="'+ n.url +'" type="video/ogg" />');
                onlineVideo_html.push('<source src="'+ n.url +'" type="video/webm" />');
                onlineVideo_html.push('<object data="'+ n.url +'" ><embed src="'+ n.url +'"  /></object>');
                onlineVideo_html.push('</video>');
            });
            onlineVideo.append(onlineVideo_html.join(''));
        },
        error:function(){
            
        }
    });


    //信息公开
    var newsOpen = $('.row_newsOpen');
    var newsOpen_html = [];
    $.ajax({
        url: infoUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            newsOpen_html.push('<div class="item active">');
            newsOpen_html.push('<a href="'+infoDetail+'&id='+data[0].id+'"><img class="center-block" src="'+ data[0].picUrl +'" alt="新闻图片" /></a>');
            newsOpen_html.push('<div class="zixun_text ">');
            newsOpen_html.push('<h5><a href="'+infoDetail+'&id='+data[0].id+'">'+ data[0].title +'</a></h5>');
            newsOpen_html.push(' <img src="images/images_index/zixun_lineblue.png" alt="">');
            newsOpen_html.push(' <p><a href="'+infoDetail+'&id='+data[0].id+'">'+ data[0].content +'</a></p>');
            newsOpen_html.push('</div>');
            newsOpen_html.push('</div>');
            newsOpen.append(newsOpen_html.join(''));
            row_public(data[0].id);
        },
        error:function(){

        }
    });


    var newsOpen2 = $('.row_open');
    var newsOpen2_html = [];
    $.ajax({
        url: infoAllUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){
                newsOpen2_html.push('<ul >');
                //时间格式转换为 [12-02]
                if(i<9) {
                    var out = time(n.published);
                    newsOpen2_html.push('<li><h5><a href="'+infoDetail+'&id='+n.id+'">' + n.title + '</a></h5> <span> ' + out + ' </span></li>');

                }
            });
            newsOpen2_html.push('</ul>');
            newsOpen2.append(newsOpen2_html.join(''));
        },
        error:function(){
            
        }
    });

    //企业展示
    var textdiv = $('.row1');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    $.ajax({
        url: companyUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据 遍历返回的数据 i是遍历的次数 n是遍历的内容
                html.push('<div class="col-xs-12 col-sm-6 col-md-3 company_show">');
                html.push('<a href="'+companyDetailUrl+'&id='+n.id+'"><img class="img-responsive" src="'+n.logoUrl +'" alt=""></a>');
                html.push('<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">');
                html.push('<h4>'+ n.name +'</h4>');
                html.push('</div>');
                html.push('<a href="'+companyDetailUrl+'&id='+n.id+'"><p>'+ n.introduction +'</p></a>');
                html.push('</div>');
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });


    //图片替换
    $(function(){
        $(".artist_hover").mouseover(function(){
            $(".artist_hover").attr("src", "images/images_index/meigong.png");
        });        $(".service_hover").mouseover(function(){
            $(".service_hover").attr("src", "images/images_index/xiaoshou.png");
        });
        $(".sales_hover").mouseover(function(){
            $(".sales_hover").attr("src", "images/images_index/kefu.png");
        });
        $(".more_hover").mouseover(function(){
            $(".more_hover").attr("src", "images/images_index/qita.png");
        });
        $(".artist_hover").mouseout(function(){
            $(".artist_hover").attr("src", "images/images_index/artist.png");
        });
        $(".service_hover").mouseout(function(){
            $(".service_hover").attr("src", "images/images_index/service.png");
        });
        $(".sales_hover").mouseout(function(){
            $(".sales_hover").attr("src", "images/images_index/sales.png");
        });
        $(".more_hover").mouseout(function(){
            $(".more_hover").attr("src", "images/images_index/more.png");
        });
    })

    //选项卡切换 
    var $tab_list = $('.column a');
    $tab_list.click(function(){
        $(this).addClass('hover').siblings().removeClass('hover');
        var index = $tab_list.index(this);
        ziXun(index);
        $('div.tab > div').eq(index).show().siblings().hide();
    })
  

    //鼠标移动事件
    var $tab_redbar = $('.zixun');
    var $redbar = $('.zixun .container .row .column .redbar');
    
    $tab_redbar.mouseover(function(){
        var index1 = $tab_redbar.index(this);
        $($redbar).eq(index1).css('background-color','#d73455');
    });
    $tab_redbar.mouseout(function(){
        var index1 = $tab_redbar.index(this);
        $($redbar).eq(index1).css('background-color','#3bb8db');
    });

    
})
