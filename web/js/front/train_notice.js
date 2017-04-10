function train(newsType){
    var textdiv = $('.row_one');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    $.ajax({
        url: ectrainUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:"newsType="+newsType,
        async: false,
        success:function(data){//如果成功即执行
            html.push('<div class="col-md-12 col-sm-12 col-xs-12 ">');
            textdiv.html('');
            $.each(data,function(i,n){//遍历返回的数据
                {
                    var d = n.beginTime;
                    var out = yeartime(d);       

                    var t = n.endTime;
                    var end = yeartime(t);          
                     html.push('<div class="col-md-6 col-sm-6 col-xs-12  content clearfix">');
                    html.push('<div class="text">');
                    html.push('<h1>第'+(n.period+1)+'期'+n.name+'</h1>');
                    html.push('<p class="time">培训时间:'+n.dayNum+'天</p>');
                    html.push('<p>人数:<span id="people">'+n.peopleNum+'</span>人</p>');
                    html.push('<p>期数:第'+(n.period+1)+'期</p>');
                    html.push('<p>培训对象:'+n.target+'</p>');
                    html.push('<p>报名时间:'+out+'-'+end+'</p>');
                    html.push('<p>发布时间:'+n.published+'</p>');
                    html.push('<p class="detail"><a href="'+detailUrl+'&id='+n.id+'">详情&nbsp;&gt;&nbsp;&gt;</a></p>');
                    html.push('</div>');
                    html.push('<div class="row"><div class="circle col-md-3 hidden-xs"><div class="pie_left"><div class="left1"></div></div><div class="pie_right"><div class="right1" style="transform: rotate(180deg);"></div></div><div class="mask">已报名<span>'+n.peopleNum+'</span>人</div>');
                    html.push('</div>');
                    html.push('<div class="down col-md-3 col-sm-3 col-md-offset-9 col-xs-offset-3"><a href="signup.html" class="btn btn-primary btn-lg active " role="button">开始报名</a></div>');
                }
                //以原格式组装好数组
            });
            html.push('</div>');
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
}
$(document).ready(function(){
    //培训分类
    var textclassify = $('.row_enterprise');//定位到需要插入的DIV
    var texthtml = [];//新建一个数组变量
    
    $.ajax({
        url: dictUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            texthtml.push('<div class="col-xs-12 col-md-12 column column_mt"><div class="redbar"></div><span>培训通知</span><ul class="nav nav_classify">');
            texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-1 active">全部</a>');  
            $.each(data,function(i,n){//遍历返回的数据 
                {
                  texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-1">'+n.dictItemName+'</a>');
                }
                //以原格式组装好数组
            });
            texthtml.push('</div>');
            texthtml.push('</ul>');
            textclassify.append(texthtml.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });

    /*培训通知*/
    train(0);
    
    
    var $tab_list = $('.nav_classify a');
        $tab_list.click(function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $tab_list.index(this);
            train(index);
            $('.row_one').eq(index).show().siblings().hide();
        });
    $('.circle').each(function(index, el) {
        var total = $("#people").text();
        var num = $(this).find('span').text() * (360/total);
        if (num<=180) {
            $(this).find('.right1').css('transform', "rotate(" + num + "deg)");
        } else {
            $(this).find('.right1').css('transform', "rotate(180deg)");
            $(this).find('.left1').css('transform', "rotate(" + (num - 180) + "deg)");
        }
    });
    
});
