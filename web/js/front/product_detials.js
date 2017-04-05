$(document).ready(function(){
    //左边
    var left = $('.goods');//定位到需要插入的DIV
    var lefthtml = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行  
            $.each(data,function(i,n){//遍历返回的数据
                if (i==0) {
                        lefthtml.push('<div class="col-xs-12 col-md-12 Details">');
                        lefthtml.push('<div class="detials_title">');
                        lefthtml.push('<span>详细资料</span>');
                        lefthtml.push('</div>');
                        lefthtml.push('<p class="detials_p">'+n.introduction+'</p>');
                        lefthtml.push('</div>');
                };
                //以原格式组装好数组
            });
            left.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });
    /*公司新闻 循环9次*/
    var news = $('.company_news');//定位到需要插入的DIV
    var news_html = [];//新建一个数组变量
    news_html.push('<div class="link_title clearfix"><img class="img-responsive " src="../images/images_enterprisedetail/icon1.png" alt="图标"></div>');

    $.ajax({
        url: 192.168.1.150:8010/xyds/web/index.php?r=company-news/company-news,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    news_html.push('<div class="news clearfix"><div></div><a href="enterprisedisplay_detailnews.html">'+n.content+'</a></div>');
                }
                //以原格式组装好数组
            });
            news.append(news_html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });

     /*公司店铺链接*/
    var store = $('.store_link');//定位到需要插入的DIV
    var store_html = [];//新建一个数组变量
    $.ajax({
        url: ,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行
            store_html.push('<div class="link_title clearfix"><img class="img-responsive " src="../images/images_enterprisedetail/icon1.png" alt="图标"><h4>公司店铺链接</h4></div>');
            store_html.push('<ul>');
            $.each(data,function(i,n){//遍历返回的数据
                {
                   if(i==0){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="../images/images_enterprisedetail/JD.png" alt="京东"><a href="'+n.shopLink+'"><span>京东</span></a></li>');
                    }
                    else if(i==1){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="../images/images_enterprisedetail/tmall.png" alt="天猫"><a href="'+n.shopLink+'"><span>天猫</span></a></li>');
                    }
                    else if(i==2){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="../images/images_enterprisedetail/taobao.png" alt="淘宝"><a href="'+n.shopLink+'"><span>淘宝</span></a></li>');
                    }
                    else if(i==3){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="../images/images_enterprisedetail/1hd.png" alt="一号店"><a href="'+n.shopLink+'"><span>一号店</span></a></li>');
                    }
                    else if(i==4){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="../images/images_enterprisedetail/suning.png" alt="苏宁"><a href="'+n.shopLink+'"><span>苏宁</span></a></li>');
                    }
                }
                //以原格式组装好数组
            });
            store_html.push('</ul>');
            store.append(store_html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
   
});