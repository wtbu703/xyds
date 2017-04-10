$(document).ready(function(){
    //鼠标点击切换效果
    $(".list-group li").each(function(index){
        $(this).click(function(){
            $(".list-group li").removeClass("list_on");
            $(".list-group li").eq(index).addClass("list_on");
        });
    });
    //搜索框下热门职位列表点击效果
    //ulClick();
    chanageJobCat();
    //热门职位
     //hotposition();
    //职位信息
    positionMessage();
    //左右高度相等
    var a = $("#content_left").height();
    var m = Math.max(
        $("#content_right").height(),
        $("#content_left").height()
    );
    if ((screen.width <= 1024) && (screen.height <= 768))  {
        $(".content_left").height(a);
    }
    else {
        $(".content_left").height(m);
        $(".content_right").height(m);
    }
    $(window).resize(function(){
        window.location.reload();
    });
});
//搜索点击切换
    function ulClick(){
        var searchValue = $('.sea_1').val(); //搜索的类型
        var $tab_list = $('.full_ul li');
        var active =  $('.full_ul');
        var index = $tab_list.filter(".full_active").index(); //搜索的关键词
        var paraStr = '';
        paraStr += 'searchValue='+searchValue+'&index='+index;

        var offset = 0; /*offset*/
        var size = 6; /*size*/
        var More=$('.detial');
        var result = [];
        $.ajax({
            url:searchUrl,//后台给的
            type: "post",//发送方法
            data: paraStr,
            dataType: "json",//返回的数据格式
            async: false,
            success:function(data){
                var On_data = data;
                var sum =data.length;
                if(sum - offset < size ){
                    size = sum - offset;
                }
                /*使用for循环模拟SQL里的limit(offset,size)*/
                for(var i=offset; i< (offset+size); i++){
                    var txt = On_data[i].demand.replace(/<[^>]+>/g,"");
                    if(txt.length>150){
                        var brief =  txt.substr(0,150)+"...";
                    }else{
                        var brief =  txt.substr(0,150);
                    }
                    result.push('<h4>'+On_data[i].position+'</h4>');
                    result.push('<p>'+On_data[i].companyName+'  |  '+On_data[i].workPlace+'  |  '+On_data[i].record+'  |  '+On_data[i].exp+'  |  <span>'+On_data[i].salary+'</span></p>');
                    result.push('<div class="detail_p">'+brief+'</div>');
                    result.push('<a href="'+detailUrl+'&id='+On_data[i].id+'&companyId='+On_data[i].companyId+'">>>详情</a>');
                    result.push('<div class="detial_line"></div>');
                }
                More.html('');
                More.append(result);
                /*隐藏more按钮*/
                if ( (offset + size) >= sum){
                    $("#get_more").hide();
                }else{
                    $("#get_more").show();
                }
            },
            error:function(){}
        });
    }

//切换搜索类别
    function chanageJobCat(){
        var $tab_list = $('.full_ul li');
        $tab_list.click(function(){
            $(this).addClass('full_active').siblings().removeClass('full_active');
        });
    }

    //职位信息
    function positionMessage(cat = 1){
            /*初始化*/
            var counter = 0; /*计数器*/
            var pageStart = 0; /*offset*/
            var pageSize = 6; /*size*/
            /*首次加载*/
            getData(pageStart, pageSize,cat);

    };
        /*监听加载更多*/
        $(document).on('click', '#get_more', function(){
            counter ++;
            pageStart = counter * pageSize;
            getData(pageStart, pageSize,cat);
        });
        function getData(offset,size,cat){
                var More=$('.detial');
                var result = [];
                $.ajax({
                    url: positionUrl,//后台给的
                    type: "post",//发送方法
                    data: 'cat=' +cat,
                    dataType: "json",//返回的数据格式
                    async: false,
                    success:function(data){
                        var On_data = data;
                        var sum =data.length;
                        if(sum - offset < size ){
                            size = sum - offset;
                        }
                        /*使用for循环模拟SQL里的limit(offset,size)*/
                        for(var i=offset; i< (offset+size); i++){
                            var txt = On_data[i].demand.replace(/<[^>]+>/g,"");
                            if(txt.length>150){
                                var brief =  txt.substr(0,150)+"...";
                            }else{
                                var brief =  txt.substr(0,150);
                            }
                            result.push('<h4>'+On_data[i].position+'</h4>');
                            result.push('<p>'+On_data[i].companyName+'  |  '+On_data[i].workPlace+'  |  '+On_data[i].record+'  |  '+On_data[i].exp+'  |  <span>'+On_data[i].salary+'</span></p>');
                            result.push('<div class="detail_p">'+brief+'</div>');
                            result.push('<a href="'+detailUrl+'&id='+On_data[i].id+'&companyId='+On_data[i].companyId+'">>>详情</a>');
                            result.push('<div class="detial_line"></div>');
                        }
                        More.html('');
                        More.append(result);
                        /*隐藏more按钮*/
                        if ( (offset + size) >= sum){
                            $("#get_more").hide();
                        }else{
                            $("#get_more").show();
                        }
                    },
                    error:function(){}
                });
        };