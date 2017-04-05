$(document).ready(function(){
    var textdiv = $('.left_content1');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    $.ajax({
        url: 192.168.1.151:8010/xyds/web/index.php?r=company/company,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
     
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据
                html.push('<h2 class="col-md-offset-3 col-sm-offset-2 col-xs-offset-1">第'+(n.period+1)+'期'+n.name +'</h2>');
                html.push('<p class="col-md-offset-5 col-sm-offset-4 col-xs-offset-3 subhead">');
                html.push('&nbsp;'+n.published +'&nbsp;&nbsp;发布人&nbsp;:&nbsp;'+n.publisher+);
                html.push('</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">一、&nbsp;培训时间</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">培训时间：'+n.dayNum +'</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">二、&nbsp;培训人数</p>');
                html.psuh('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">人数：'+ n.peopleNum +'人</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">三、&nbsp;培训对象</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">'+ n.target +'</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">四、&nbsp;培训内容</p>');
                html.push('<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">'+ n.content +'</p>');
               
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
        error:function(){
            
        }
    });

    
    
})
