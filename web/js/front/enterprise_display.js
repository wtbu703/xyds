function enterprise(newsType,page){
    var textdiv = $('.row_one');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    var paraStr = 'newsType='+newsType+'&page='+page;
    $.ajax({
        url: companyUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:paraStr,
        async: false,
        success:function(data){//如果成功即执行
            var companydata = JSON.parse(data.company);
            textdiv.html('');
            $.each(companydata,function(i,n){//遍历返回的数据
                {
                    html.push('<div class="col-md-4 col-sm-6 col-xs-12 enterprise">'); 
                    html.push('<div class="box_shadow">'); 
                    html.push('<a href="'+companyDetailUrl+'&id='+n.id+'"><img class="img-responsive" id="large" src="'+n.logoUrl+'" alt="企业图片"></a>');
                    html.push('<div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">');
                    html.push('<h4>'+n.name+'</h4>');
                    html.push('<div class="row redline"><div class="col-md-9 col-xs-9 col-sm-9 solid"></div><div class="col-md-3 col-xs-3 col-sm-3 dashed"></div></div><div class="belong">'+n.category+'</div>');
                    html.push('</div>');
                    html.push('</div>');
                    html.push('</div>');
                }
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
            getPage(data.pageSize,data.page,data.totalCount,newsType);
        },
    
        error:function(){
            
        }
    });
}
//分页
function getPage(pageSize,page,totalCount,cat){
    var totalPage = Math.ceil(totalCount/pageSize);
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    pagehtml.push('<li><a>'+totalCount+'条/'+totalPage+'页</a></li>');
    if(page > 0) {
        pagehtml.push('<li><a href="javascript:enterprise('+cat+',\'0\')">首页</a></li>');
        pagehtml.push('<li><a href="javascript:enterprise('+cat+','+prev+')" aria-label="Previous">上一页</a></li>');
    }
    pagehtml.push('<li><a href="javascript:enterprise('+cat+','+page+')">'+next+'</a></li>');
    if(page < last&&totalPage > 1) {
        pagehtml.push('<li><a href="javascript:enterprise('+cat+','+next+')" aria-label="Next">下一页</a></li>');
        pagehtml.push('<li><a href="javascript:enterprise('+cat+','+last+')">尾页</a></li>');//跳转到信息公开详情页
    }
    if(totalPage > 1) {
        pagehtml.push('<input type="text" name="page"  id="pagevalue" value="'+next+'"/>');
        var p = "$('#pagevalue').val()";
        pagehtml.push('<a class="pagego" href="javascript:enterprise('+cat+','+p+')">GO</a>');
    }

    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV

}
$(document).ready(function(){
    
    //企业分类
    var textclassify = $('.row_enterprise');//定位到需要插入的DIV
    var texthtml = [];//新建一个数组变量
    texthtml.push('<div class="col-xs-12 col-md-8 column column_mt"><div class="redbar"></div><span>企业展示</span><ul class="nav nav_classify">');
    texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 active">默认排序</a>');
    $.ajax({
        url: dictUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-2">'+n.dictItemName+'</a>');
                    
                }
                //以原格式组装好数组
            });
            texthtml.push('</div>');
            texthtml.push('</ul>');
            texthtml.push('<div class="col-xs-12 col-md-3 col-md-offset-1 enterprise_search">');
            texthtml.push('<input type="text" name="search" placeholder="请输入企业名字或者类型" class="search_input col-md-9">');
            texthtml.push('<button class="btn btn-default btn-sm btn_search" type="submit"><img src="images/images_enterprise/search.png" alt="搜索图标"></button></div>');
            textclassify.append(texthtml.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
    //企业展示
    enterprise(0,0);
    $(function(){
        $w = $('.pic').width();
        $h = $('.pic').height();
        $w2 = $w + 20;
        $h2 = $h + 20;
        $('.row_display').css("display","none");
        $('.pic').hover(function(){

            $(this).stop().animate({height:$h2,width:$w2,left:"0px",top:"-10px"},500);
        },function(){

            $(this).stop().animate({height:$h,width:$w,left:"0px",top:"0px"},500);
            
        });
        var $tab_list = $('.nav_classify a');
        $tab_list.click(function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $tab_list.index(this);
            enterprise(index,0);
            $('.row_one').eq(index).show().siblings().hide();
        });
    });
    
})