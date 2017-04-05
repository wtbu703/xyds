$(document).ready(function(){

	//文章列表
    function ziXun2(newsType){ 
        var rowNews = $('.article_main');
        var rowNews_html = [];
        $.ajax({
            url:findUrl,
            type:"post",
            dataType:"json",
            async: false,
            data: newsType,
            success:function(data){
                $.each(data,function(i,n){  
                	var d = n.published;
                    var date = new Date(d);
                    var out = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());     
                    rowNews_html.push('<div class="article_list">');    
                   /* 循环6遍*/
                    rowNews_html.push('<hr />');
                    rowNews_html.push('<div class="row">');
                    rowNews_html.push('<div class="col-xs-4"><img class="img-responsive" src="'+ n.picUrl +'" alt="新闻图片"></div>');
                    rowNews_html.push('<div class="col-xs-8 news">');
                    rowNews_html.push('<h5><a href="enterprisedisplay_detailnews.html">'+ n.title +'</a></h5>');
                    rowNews_html.push('<p><a href="enterprisedisplay_detailnews.html">'+ n.content +'</a></p>');
                    rowNews_html.push('<span>发布时间：'+ out +'</span>');
                    rowNews_html.push('</div>');
                    rowNews_html.push('</div>');
                    /* END循环6遍*/
                    rowNews_html.push('</div>');
                });
                rowNews.append(rowNews_html.join(''));
            },
            error:function(){
                
            }
        });
    }

    var $tab_list = $('.column_list a');
    $tab_list.hover(function(){
        $(this).addClass('hover').siblings().removeClass('hover');
        var index = $tab_list.index(this);
        ziXun2(index);
        $('div.article_main > div').eq(index).show().siblings().hide();
    })

	
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

	//公司招聘
    var companyRecruit = $('.company_recruit');
    var companyRecruit_html = [];
    $.ajax({
        url:findUrl,
        type:"post",
        dataType:"json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){  
            	 var arr = n.demand.split(',');
				 var arr1 = arr[0];
				 var arr2 = arr[1];
				 var arr3 = arr[2];
                companyRecruit_html.push('<div class="recruit clearfix"><div></div><a href="On_details.html">'+ n.position +'</a><h5>'+ arr[0] +'<span>|</span>'+ arr[1] +'<span>|</span>'+ arr[2] +'<span>|</span></h5></div>');
 
            });
            companyRecruit.append(companyRecruit_html.join(''));
        },
        error:function(){
            
        }
    });

})