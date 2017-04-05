$(document).ready(function(){
    //height_change();
    //左边栏
    var left = $('.list-group');//定位到需要插入的DIV
    var lefthtml = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行  共5条
            $.each(data,function(i,n){//遍历返回的数据
                lefthtml.push('li class="list_item1 "><a href="#">'+n.category+'</a></li>');//未选中样式
                //以原格式组装好数组
            });
            left.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });
    //中间
    var textdiv = $('.publicity');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行  共21条
            $.each(data,function(i,n){//遍历返回的数据
                var artime=time(n.published); 
                html.push('<li>');
                html.push('<a>');
                html.push('<div></div>');
                html.push('<span>'+ n.title +'</span>');
                html.push('<h class="con_h">'+artime+'</h>');
                html.push('</a>');
                html.push('</li>');
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){}
    });
    //右边
    var rightdiv = $('.zixun_banner');//定位到需要插入的DIV
    var righthtml = [];//新建一个数组变量
    $.ajax({
        url: findUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行  共1条
            $.each(data,function(i,n){//遍历返回的数据
                if (i==0) {
                    righthtml.push('<div class="item active">');
                    righthtml.push('<a href="#">');//跳转到信息公开详情页
                    righthtml.push('<img class="center-block" src="'+ n.picUrl +'" alt="新闻图片" />');
                    righthtml.push('</a>');
                    righthtml.push('<div class="zixun_text">');
                    righthtml.push('<h5><a href="#">'+n.title+'</a></h5>');//跳转到信息公开详情页
                    righthtml.push('<img src="../images/images_index/zixun_lineblue.png" alt="">');
                    righthtml.push('<p>');
                    righthtml.push('<a href="#">'+n.content+'</a>');//跳转到信息公开详情页
                    righthtml.push('</p>');
                    righthtml.push('</div>');
                    righthtml.push('</div>');
                };
                //以原格式组装好数组
            });
            rightdiv.append(righthtml.join(''));//把数组插入到已定位的DIV
        },
        error:function(){}
    });
});