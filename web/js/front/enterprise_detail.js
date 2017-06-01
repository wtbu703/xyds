function product(){
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
            var productdata = JSON.parse(data.product);
            if(productdata.length==0){
                product_html.push('<div class="col-md-12 col-sm-12 col-xs-12 clearfix">');
                product_html.push('<h4 class="product_title">产品展示</h4>');
                product_html.push('<div class="empty"><span class="empty2">主人太懒，<br>暂无相关消息</span></div>');
                product_html.push('</div>');
                alert(111);
            }else{
                product_html.push('<div class="col-md-12 col-sm-12 col-xs-12 clearfix">');
                product_html.push('<h4 class="product_title">产品展示</h4>');
                product_html.push('<a class="product_all" href="'+productDisplayUrl+'&id='+companyId+'">>>所有产品</a>');
                product_html.push('</div>');
            }
            $.each(productdata,function(i,n){//遍历返回的数据
                {
                    if(i>=0&&i<=5){
                        //价格保留2位小数
                        var price = n.price;
                        var disPrice = n.price*n.discount/10 ;
                        prices = price.toFixed(2);
                        disPrices = disPrice.toFixed(2);
                        product_html.push('<div class="col-md-4 col-sm-6 col-xs-12 enterprise">');
                        product_html.push('<div class="box_shadow">');
                        product_html.push('<a href="'+productDetailUrl+'&productId='+n.id+'&companyId='+companyId+'"><img class="img-responsive" id="large" src="'+n.thumbnailUrl+'" alt="企业产品"></a>');
                        product_html.push('<div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">');
                        product_html.push('<a href="'+productDetailUrl+'&productId='+n.id+'&companyId='+companyId+'"><h5 class="name col-md-8 col-sm-8 col-xs-8">'+n.name+'</h5></a>');
                        product_html.push('<h5 class="col-md-4 col-sm-4 col-xs-4 red">￥'+ disPrices+'</h5>');
                        product_html.push(' <div class="row redline"><div class="col-md-9 col-xs-9 col-sm-9 solid"></div><div class="col-md-3 col-xs-3 col-sm-3 dashed"></div></div>');
                        product_html.push('<div class="belong col-md-8 col-sm-8 col-xs-8"></div>');
                        product_html.push('<s class="col-md-4 col-sm-4 col-xs-4">￥'+prices+'</s>');
                        product_html.push('</div>');
                        product_html.push('</div>');
                        product_html.push('</div>');
                    }
                }
                //以原格式组装好数组
            });
            product.append(product_html.join(''));//把数组插入到已定位的DIV
        },

        error:function(){

        }
    });
}
$(document).ready(function(){

    product();

});
