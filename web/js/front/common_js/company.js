$(document).ready(function(){
     /*公司店铺链接*/
    var store = $('.store_link');//定位到需要插入的DIV
    var store_html = [];//新建一个数组变量
    $.ajax({
        url: shoplinkUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data : "companyId="+companyId,
        async: false,
        success:function(data){//如果成功即执行
            store_html.push('<div class="link_title clearfix"><img class="img-responsive " src="images/images_enterprisedetail/icon1.png" alt="图标"><h4>公司店铺链接</h4></div>');
            store_html.push('<ul>');
            $.each(data,function(i,n){//遍历返回的数据
                {
                   if(i==0){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/JD.png" alt="京东"><a href="'+n.shopLink+'"><span>京东</span></a></li>');
                    }
                    else if(i==1){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/tmall.png" alt="天猫"><a href="'+n.shopLink+'"><span>天猫</span></a></li>');
                    }
                    else if(i==2){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/taobao.png" alt="淘宝"><a href="'+n.shopLink+'"><span>淘宝</span></a></li>');
                    }
                    else if(i==3){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/1hd.png" alt="一号店"><a href="'+n.shopLink+'"><span>一号店</span></a></li>');
                    }
                    else if(i==4){
                        store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/suning.png" alt="苏宁"><a href="'+n.shopLink+'"><span>苏宁</span></a></li>');
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
    /*公司新闻 循环9次*/
    var news = $('.company_news');//定位到需要插入的DIV
    var news_html = [];//新建一个数组变量
    $.ajax({
        url: newsUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data : "companyId="+companyId,
        async: false,
        success:function(data){//如果成功即执行
            news_html.push('<div class="link_title clearfix"><img class="img-responsive " src="images/images_enterprisedetail/icon1.png" alt="图标"><h4>公司新闻</h4></div>');
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

    /*公司招聘 循环9次*/
    var recruit = $('.company_recruit');//定位到需要插入的DIV
    var recruit_html = [];//新建一个数组变量
    recruit_html.push('<div class="link_title clearfix"><img class="img-responsive " src="images/images_enterprisedetail/icon1.png" alt="图标"><h4>公司招聘</h4></div>');
    $.ajax({
        url: recruitUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data : "companyId="+companyId,
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    var arry = split(n.demand);
                    recruit_html.push('<div class="recruit clearfix"><div></div><a href="'+onlineUrl+'">'+n.position+'</a>');
                    recruit_html.push('<h5>'+arry[0]+'<span>|</span>'+arry[1]+'<span>|</span>'+arry[2]+'</h5>');
                    recruit_html.push('</div>');
                }   
                //以原格式组装好数组
            });
            recruit.append(recruit_html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
    
});
