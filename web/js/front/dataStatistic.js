//左上切换
function serviceTop(newsType=0){ 
    var textdiv = $('.statistic_top');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    
    $.ajax({
        url: indexUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:"newsType="+newsType,
        async: false,
        success:function(data){//如果成功即执行
            textdiv.html('');
            html.push('<ul class="nav nav-pills nav-stacked nav_top" role="tablist">');
            $.each(data,function(i,n){//遍历返回的数据
                {
                    html.push('<li role="presentation"><a href="#a" role="tab" data-toggle="tab">物流连接的村镇</a></li>');
                }
                //以原格式组装好数组
            });
            html.push('</ul>');
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
}
//右上切换分类
/*function serviceClassify(){ 
    var serviceCdiv = $('.nav_right');//定位到需要插入的DIV
    var serviceChtml = [];//新建一个数组变量
    
    $.ajax({
        url: indexUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            serviceCdiv.html('');
            serviceChtml.push('<li role="presentation" class="active"><a href="#column" role="tab" data-toggle="tab">代买金额</a></li>');
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    serviceChtml.push('<li role="presentation"><a href="#column" role="tab" data-toggle="tab">'+n.+'</a></li>');
                }
                //以原格式组装好数组
            });
            
            serviceCdiv.append(serviceChtml.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
}*/
//下面切换侧栏
function serviceside(){ 
    var sidebarDiv = $('.statistic_bottom');//定位到需要插入的DIV
    var sidebarhtml = [];//新建一个数组变量
    
    $.ajax({
        url: indexUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            sidebarDiv.html('');
            sidebarhtml.push('<ul class="nav nav-pills nav-stacked nav_top" role="tablist">');
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    sidebarhtml.push(' <li role="presentation"><a href="#'+n.+'" role="tab" data-toggle="tab">'+n.+'</a></li>');
                }
                //以原格式组装好数组
            });
            sidebarhtml.push('</ul>');
            sidebarDiv.append(sidebarhtml.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
}
//下面切换内容
/*function servicebottom(newsType=0){ 
    var serviceDiv = $('.table');//定位到需要插入的DIV
    var servicehtml = [];//新建一个数组变量
    
    $.ajax({
        url: indexUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:"newsType="+newsType,
        async: false,
        success:function(data){//如果成功即执行
            serviceDiv.html('');
            servicehtml.push('<div role="tabpanel" class="tab-pane active" id="bussiness"><div class="col-md-12 col-sm-12 col-xs-12"><div class="box_shadow1"><div class="doubleColumn"></div></div></div></div>');
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    servicehtml.push('');
                }
                //以原格式组装好数组
            });
            
            serviceDiv.append(servicehtml.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
}*/
$(document).ready(function(){
    serviceTop();
    /*serviceClassify();*/
   /* serviceRight();*/
    serviceside();
   /* servicebottom();*/

    var $tab_list = $('.nav_top li a');
    $tab_list.click(function(){
        var index = $tab_list.index(this);
    })
    /*serviceTop(index);*/
})