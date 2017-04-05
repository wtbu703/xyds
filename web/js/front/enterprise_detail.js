function companyDetail(data){
    /*公司详情*/
    var textdiv = $('.box');//定位到需要插入的DIV
    var html = [];//新建一个数组变量

    $.each(data,function(i,n){//遍历返回的数据
        if(i==0)
        {
            html.push('<div class="right_head"><div class="list_head"><span class="lh_index"><img class="img-responsive home" src="../images/images_common/home.png" alt="首页图标"><a href="index.html">首页</a>&nbsp;&gt;</span><span class="lh_index"><a href="enterprisedisplay.html">企业展示</a>&nbsp;&gt;</span><span class="lh_index">'+n.name+'</span></div></div>');
            html.push('<div class="left_title clearfix col-md-12 col-sm-12 col-xs-12">');
            html.push('<div class="col-md-3 col-xs-3 col-sm-1"></div>');
            html.push('<h3 class="name">'+n.name+'</h3>');
            html.push('</div>');
            html.push('<div class="article_source col-md-12 col-sm-12 col-xs-12"><div class="col-md-3 col-sm-1 col-xs-0"></div>');
            html.push('<h5 class="col-md-9 col-sm-11 col-xs-12">内容来源:&nbsp;'+n.sources+'&nbsp;点击次数:&nbsp;'+n.count+'&nbsp;次&nbsp;发布时间:&nbsp;'+n.datetime+'</h5>');
            html.push('</div>');
            html.push('<img class="img-responsive" src="'+n.logoUrl+'" alt="企业图片">');
            html.push('<div class="message col-md-6 col-sm-10 col-xs-12">');
            html.push('<h5>公司名称：&nbsp;'+n.name+'</h5>');
            html.push('<h5>公司法人：&nbsp;'+n.corporate+'</h5>');
            html.push('<h5>公司网址：&nbsp;'+n.webSite+'</h5>');
            html.push('<h5>联系电话：&nbsp;'+n.tel+'</h5>');
            html.push('<h5>联系地址：&nbsp;'+n.address+'</h5>');
            html.push('</div>');
            html.push('</div>');
            html.push('<div class="describe col-md-12 col-sm-12 col-xs-12">');
            html.push('<h5>企业简介</h5>');
            html.push('<h5 class="kong">一、概述</h5>');
            html.push('<h5>'+n.introduction+'</h5>');
            html.push('</div>');
        }
        //以原格式组装好数组
    });
    textdiv.append(html.join(''));//把数组插入到已定位的DIV
}
$(document).ready(function(){


    /*产品类 循环6次*/
    var product = $('.product_display');//定位到需要插入的DIV
    var product_html = [];//新建一个数组变量
    $.ajax({
        url: productUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:"companyId="+companyId,
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据 
                {
                	product_html.push('<div class="col-md-4 col-sm-6 col-xs-12 enterprise">');
                    product_html.push('<div class="box_shadow">'); 
                    product_html.push('<a href="product_details.html"><img class="img-responsive" id="large" src="'+n.thumbnailUrl+'" alt="企业产品"></a>');
                    product_html.push('<div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">');
                    product_html.push('<h5 class="col-md-8 col-sm-8 col-xs-8">'+n.name+'</h5>');
                    product_html.push('<h5 class="col-md-4 col-sm-4 col-xs-4 red">￥'+n.price*n.discount+'</h5>');
                    product_html.push(' <div class="row redline"><div class="col-md-9 col-xs-9 col-sm-9 solid"></div><div class="col-md-3 col-xs-3 col-sm-3 dashed"></div></div>');
                    product_html.push('<div class="belong col-md-8 col-sm-8 col-xs-8"></div>');
                    product_html.push('<s class="col-md-4 col-sm-4 col-xs-4">￥'+n.price+'</s>');
                    product_html.push('</div>');
                    product_html.push('</div>');
                    product_html.push('</div>');
                }
                //以原格式组装好数组
            });
            product.append(product_html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });

    
})
