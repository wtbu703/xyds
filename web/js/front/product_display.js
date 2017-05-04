function product(page){
    var page = page||0;
    /*产品类 循环12次*/
    var product = $('.left_content1');//定位到需要插入的DIV
    var product_html = [];//新建一个数组变量
    $.ajax({
        url: productUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data: "companyId="+companyId+"&page="+page,
        async: false,
        success:function(data){//如果成功即执行
            product.html('');
            var productdata = JSON.parse(data.product);
            product_html.push('<div class="right_head">');
            product_html.push('<div class="list_head">');
            product_html.push('<span class="lh_index"><a href=""><img src="images/third_details/home.png" alt="首页图标" class="third_home">&nbsp;首页</a>&nbsp;></span>');
            product_html.push('<span class="lh_index"><a href="'+companyUrl+'">企业展示</a>&nbsp;></span>');
            product_html.push('<span class="lh_index"><a href="'+companyDetailUrl+'&id='+companyId+'">'+data.companyName+'</a>&nbsp;></span>');
            product_html.push('<span class="lh_index">所有产品</span>');
            product_html.push('</div>');
            product_html.push('</div>');
            product_html.push('<h4 class="product_title clearfix"><img class="img-responsive clock" src="images/images_qy_cp/clock.png" alt="手表图标"><span>所有产品</span></h4>');
            $.each(productdata,function(i,n){//遍历返回的数据
                {
                    product_html.push('<div class="col-md-4 col-sm-6 col-xs-12 enterprise">');
                    product_html.push('<div class="box_shadow">');
                    product_html.push('<a href="'+productDetailUrl+'&productId='+n.id+'&companyId='+companyId+'"><img class="img-responsive" id="large" src="'+n.thumbnailUrl+'" alt="企业产品"></a>');
                    product_html.push('<div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">');
                    product_html.push('<a href="'+productDetailUrl+'&productId='+n.id+'"><h5 class="col-md-8 col-sm-8 col-xs-8">'+n.name+'</h5></a>');
                    product_html.push('<h5 class="col-md-4 col-sm-4 col-xs-4 red">￥'+(n.price)*(n.discount)+'</h5>');
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
            getPage(data.pageSize,data.page,data.totalCount);
            getMaodian();
        },
        error:function(){

        }
    });
}
$(document).ready(function(){
    product();

});


function getPage(pageSize,page,totalCount){
    var totalPage = Math.ceil(totalCount/pageSize);
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    if(totalPage >1) {
        pagehtml.push('<li><a>' + totalCount + '条/' + totalPage + '页</a></li>');
        if (page > 0) {
            pagehtml.push('<li><a href="javascript:ziXun1(\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:ziXun1(' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a class="maodian" href="javascript:ziXun1(' + page + ')">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:ziXun1(' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:ziXun1(' + last + ')">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page"  id="pagevalue" value="' + next + '"/>');
            pagehtml.push('<a class="pagego maodian">GO</a>');
        }
    }
    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount,cat);

}
//搜索框为数字
function inputNum(pageSize,totalCount,cat){
    var totalpage = Math.ceil(totalCount/pageSize);
    $('.numInput').keyup(function(event){
        if(this.value.length==1){
            this.value=this.value.replace(/[^1-9]/g,'');
        }else{
            this.value=this.value.replace(/\D/g,'');
        }
        var p = this.value-1;
        $('.pagego').click(function(){
            if(p<=totalpage){
                ziXun1(cat,p);
            }else{
                ziXun1(cat,0);
            }
        });
    });
}

//点击分页回到顶部
function getMaodian(){
    $('.maodian').each(function(){
        $(this).click(function(){
            $('body,html').animate({scrollTop:10},100);
            // location.href = "#001";
        });
    });
}
