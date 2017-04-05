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
                    zixun_html.push('<a href="ecinformationDetail.html">');
                    zixun_html.push('<img class="center-block" src="'+ n.picUrl +'" alt="年货大战" />');
                    zixun_html.push('</a>');
                    zixun_html.push('<div class="zixun_text">');
                    zixun_html.push('<h5><a href="ecinformationDetail.html">'+ n.title +'</a></h5>');
                    zixun_html.push('<img src="images/images_index/zixun_linered.png" alt="">');
                    zixun_html.push('<p><a href="ecinformationDetail.html">'+ html_text +'</a></p>');
                    zixun_html.push('</div>');
                    zixun_html.push('</div>');
                    zixun_html.push('</div>');
                    zixun_html.push('</div>');
                }else{

                    if (i == 1 || i == 7) {
                        zixun_html.push('<div class="col-xs-12 col-sm-12 col-md-4 zixun_camera">');
                        zixun_html.push('<a href="ecinformationDetail.html">');
                        zixun_html.push('<img class="img-responsive " src="' + n.picUrl + '" alt="新闻图片">');
                        zixun_html.push('</a>');
                        zixun_html.push('<ul >');
                    } else {
                        zixun_html.push('<li>');
                        zixun_html.push('<h5><a href="ecinformationDetail.html">' + n.title + '</a></h5><span>' + taday + '</span>');
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
            $.each(data,function(i,n){               
                train_html.push('<div class="item active">');
                train_html.push('<a href="traindetail.html"><img class="center-block" src="'+ n.thumbnailUrl +'" alt="新闻图片" /></a>');
                train_html.push('<div class="zixun_text">');
                train_html.push('<h5><a href="traindetail.html">'+ n.name +'</a></h5>');
                train_html.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                train_html.push('<p><a href="traindetail.html">'+ n.content +'</a></p>');
                train_html.push('</div>');
                train_html.push('</div>');
                //下面是第二篇新闻
                train_html.push('<div class="item">');
                train_html.push('<a href="traindetail.html"><img class="center-block" src="'+ n.thumbnailUrl +'" alt="新闻图片" /></a>');
                train_html.push('<div class="zixun_text">');
                train_html.push('<h5><a href="traindetail.html">'+ n.name +'</a></h5>');
                train_html.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                train_html.push('<p><a href="traindetail.html">'+ n.content +'</a></p>');
                train_html.push('</div>');
                train_html.push('</div>');
                 //下面是第三篇新闻
                train_html.push('<div class="item">');
                train_html.push('<a href="traindetail.html"><img class="center-block" src="'+ n.thumbnailUrl +'" alt="新闻图片" /></a>');
                train_html.push('<div class="zixun_text">');
                train_html.push('<h5><a href="traindetail.html">'+ n.name +'</a></h5>');
                train_html.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                train_html.push('<p><a href="traindetail.html">'+ n.content +'</a></p>');
                train_html.push('</div>');
                train_html.push('</div>');     
            });
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
  /* var newsOpen = $('.row_newsOpen');
    var newsOpen_html = [];
    $.ajax({
        url: infoUrl,
        type: "post",
        dataType: "json",
     
        async: false,
        success:function(data){
            $.each(data,function(i,n){              
                newsOpen_html.push('<div class="item active">');
                newsOpen_html.push('<a href="info_details.html"><img class="center-block" src="'+ n.picUrl +'" alt="新闻图片" /></a>');
                newsOpen_html.push('<div class="zixun_text">');
                newsOpen_html.push('<h5><a href="info_details.html">'+ n.title +'</a></h5>');
                newsOpen_html.push(' <img src="../images/images_index/zixun_lineblue.png" alt="">');
                newsOpen_html.push(' <p><a href="info_details.html">'+ n.content +'</a></p>');
                newsOpen_html.push('</div>');
                newsOpen_html.push('</div>');
            });
            newsOpen.append(newsOpen_html.join(''));
        },
        error:function(){
            
        }
    });

    var newsOpen2 = $('.zixun_camera');
    var newsOpen2_html = [];
    $.ajax({
        url: infoUrl,
        type: "post",
        dataType: "json",
     
        async: false,
        success:function(data){
            $.each(data,function(i,n){   
                //时间格式转换为 [12-02]
                var d = n.published;
                var date = new Date(d);
                var out =  "[" + (parseInt(date.getMonth()) + 1) +"-"+ ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate())+"]";     
                newsOpen2_html.push('<ul >');
                newsOpen2_html.push('<li><h5><a href="info_details.html">'+ n.title +'</a></h5> <span> '+ out +' </span></li>');
                newsOpen2_html.push('</ul>');
            });
            newsOpen2.append(newsOpen2_html.join(''));
        },
        error:function(){
            
        }
    });*/

    //企业展示
    /*var textdiv = $('.row1');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据 遍历返回的数据 i是遍历的次数 n是遍历的内容
                html.push('<div class="col-xs-12 col-sm-6 col-md-3 company_show">');
                html.push('<img class="img-responsive" src="'+ n.logoUrl +'" alt="">');
                html.push('<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">');
                html.push('<h4>'+ n.name +'</h4>');
                html.push('</div>');
                html.push('<p>'+ n.introduction +'</p>');
                html.push('</div>');
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });*/


    //图片替换
    /*$(function(){
        $(".artist_hover").mouseover(function(){
            $(".artist_hover").attr("src", "../images/images_index/meigong.png");
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
    })*/

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
