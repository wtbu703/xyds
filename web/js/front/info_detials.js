$(document).ready(function(){
    //左右高度相等
    //height_change();
    //左边栏
    var left = $('.content_left');//定位到需要插入的DIV
    var lefthtml = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行  循环5次
            $.each(data,function(i,n){//遍历返回的数据
                lefthtml.push('li class="list_item1 "><a href="#">'+n.category+'</a></li>');//未选中样式
                //以原格式组装好数组
            });
            left.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });
    //内容
    var textdiv = $('.art');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行  
            $.each(data,function(i,n){//遍历返回的数据
                if (i==0) {
                var uptime=daytime(n.published);
                html.push('<div class="row">');
                html.push('<div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"></div>');
                html.push('<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">');
                html.push('<h2 class="art_title">'+ n.title +'</h2>');
                html.push('</div>');
                html.push('<div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"></div>');
                html.push('</div>');
                html.push('<div class="pub_info">');
                html.push('<span>文章来源：'+n.author+' 点击数：'+n.conunt+'次 更新时间：'+uptime+'</span>');
                html.push('</div>');
                html.push('<div class="row">');
                html.push('<div class="col-xs-12 col-md-12 col-lg-12">');
                html.push('<div class="art_box">'+n.content+'</div>');
                html.push('<div class="art_down">附件：<a href="#"><u>'+n.attachUrl+'</u></a></div>');//附件下载
                html.push('</div>');
                html.push('<div class="col-xs-12 col-md-12 col-lg-12 process">');
                //招标进程
                html.push('<div class="art_box1"></div>');
                html.push('<div class="content_list">');
                html.push('<ul class="content_ul">');
                html.push('<li><div></div><a ><span>上一篇:黄家湖将举办首届促进农村电商创业就专场招标会... <h>&nbsp;2017-02-08</h></span></a></li>');
                html.push('<li><div></div><a ><span>上一篇:黄家湖将举办首届促进农村电商创业就专场招标会... <h>&nbsp;2017-02-08</h></span></a></li>');
                html.push('</ul>');
                html.push('</div>');
                html.push('</div>');
            };
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){}
    });

   
});