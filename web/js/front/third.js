//获取第三方服务列表
function getThird(cat = -1,tag = -1){
    var textdiv = $('.row_one');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    var para = '';
    para += 'cat='+cat;
    para += '&tag='+tag;
    $.ajax({
        url: thirdUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data: para, //'cat='+ cat
        async: false,
        success:function(data){//如果成功即执行  共12条
            textdiv.html('');
            $.each(data,function(i,n){//遍历返回的数据
                html.push('<div class="col-md-4 col-sm-6 col-xs-12 enterprise">');
                html.push('<a href="'+thirdDetailUrl+'&id='+n.id+'">');//跳转到第三方服务详情页
                html.push('<div class="box_shadow">');
                html.push('<img class="img-responsive" src="'+ n.logoUrl +'" alt="企业图片">');
                html.push('<div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">');
                html.push('<h4>'+ n.companyName +'</h4>');
                html.push('<div class="row redline">');
                html.push('<div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>');
                html.push('<div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>');
                html.push('</div>');
                html.push('<div class="E-commerce">'+n.introduction+'</div>');
                html.push('</div>');
                html.push('</div>');
                html.push('</a>');
                html.push('</div>');
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){

        }
    });
}

/**
 * 根据企业名称进行搜索
 */
function searchByNameCat(){
    var tag = $("#thirdName").val();
    getThird('-1',tag);
}
$(document).ready(function(){

    //左边栏
    var left = $('.content_left');//定位到需要插入的DIV
    var lefthtml = [];//新建一个数组变量
    $.ajax({
        url: dictUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行  共10条
            $.each(data,function(i,n){//遍历返回的数据 缺企业类型
                lefthtml.push("<a href='javascript:getThird("+n.dictItemCode+")'><li class='list_item1'>"+n.dictItemName+"</li></a>");//未选中样式
                //以原格式组装好数组
            });
            left.append(lefthtml.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });
    //右边部分
    getThird();
    //鼠标点击切换效果
    $(".list-group li").each(function(index){
        $(this).click(function(){
            $(".list-group li").removeClass("list_on");
            $(".list-group li").eq(index).addClass("list_on");
        });
    });
    //左右高度相等

        var ht = $("#content_left").height();
        var Da = Math.max(
            $("#content_right").height(),
            $("#content_left").height()
        );
        if ((screen.width <= 1024) && (screen.height <= 768))  {
            $("#content_left").height(ht);
        }
        else {
            $("#content_left").height(Da-20);
            $("#content_right").height(Da);
        }



});
