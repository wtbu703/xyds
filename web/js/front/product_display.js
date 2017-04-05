$(document).ready(function(){
    
    /*产品类 循环12次*/
    var product = $('.left_content1');//定位到需要插入的DIV
    var product_html = [];//新建一个数组变量
    $.ajax({
        url: 192.168.1.150:8010/xyds/web/index.php?r=company-product/company-product,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
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
