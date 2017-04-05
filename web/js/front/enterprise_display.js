function enterprise(newsType=0){ 
    var textdiv = $('.row_one');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    
    $.ajax({
        url: companyUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:"newsType="+newsType,
        async: false,
        success:function(data){//如果成功即执行
            textdiv.html('');
            $.each(data,function(i,n){//遍历返回的数据 
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
        },
    
        error:function(){
            
        }
    });
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
    enterprise(0);
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
            enterprise(index);
            $('.row_one').eq(index).show().siblings().hide();
        });
    });
    
})