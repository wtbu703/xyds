$(document).ready(function(){
        var search = $('.content');//定位到需要插入的DIV
        var searchtml = [];//新建一个数组变量
        $.ajax({
            url: searchUrl,//后台给的
            type: "post",//发送方法
            dataType: "json",//返回的数据格式
         
            async: false,
            success:function(data){//如果成功即执行  
                searchtml.push('<div class="col-xs-12 col-md-12 col-lg-12 content_top">');
                searchtml.push('<img class="img-responsive" src="images/images_common/home_icon.png" />');
                searchtml.push('<span>为您找到相关搜索为128个</span>');
                searchtml.push('</div>');
                $.each(data,function(i,n){//遍历返回的数据 共6条
                    searchtml.push('<div class="col-xs-12 col-md-12 col-lg-12 content_con">');
                    searchtml.push('<div class="content_box">');
                   // searchtml.push('<h4>'++'</h4>');//标题
                    searchtml.push('<div class="content_info">');
                    searchtml.push('<span>类别：跨境电商 </span><span>来源：本站 </span><span>时间：2017-2-27 </span><span>关键词：阿里巴巴 浙江 </span>');
                    searchtml.push('</div>');
                    //searchtml.push('<p>''</p>');//内容
                    searchtml.push('</div>');
                    searchtml.push('<div class="content_line"></div>');
                    //以原格式组装好数组
                });
                search.append(searchtml.join(''));//把数组插入到已定位的DIV
            },
            error:function(){}
        });
})