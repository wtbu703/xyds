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
        var searchValue = $('.sea_1').val();
        var $tab_list = $('.full_ul li');
        var active =  $('.full_ul');
        var index = $tab_list.filter(".full_active").index();
    }

//切换搜索类别
    function chanageJobCat(){
        var $tab_list = $('.full_ul li');
        $tab_list.click(function(){
            $(this).addClass('full_active').siblings().removeClass('full_active');
        });
    }
//搜索切换
   /* function changesearch(){
        var search = $(".full_text");
        var searchhtml = [];
        $.ajax({
            url: posUrl,//后台给的
            type: "post",//发送方法
            dataType: "json",//返回的数据格式
            async: false,
            success:function(data){//如果成功即执行
                searchhtml.push('<ul class="full_ul ">');
                searchhtml.push('<li class="full_li full_active ">全文</li>');
                searchhtml.push('<li class="full_li">职位</li>');
                searchhtml.push('<li class="full_li">公司</li>');
                searchhtml.push('</ul>');
                searchhtml.push('<div class="full_search col-xs-12 col-sm-12 col-md-12 col-lg-12">');
                searchhtml.push('<input class="sea_1" type="text" placeholder="请输入关键字" />');
                searchhtml.push('<button type="submit" id="contentSearch"><img src="images/Online/search .png">&nbsp;搜索</button>');
                searchhtml.push('</div>');
                search.append(searchhtml.join(''));//把数组插入到已定位的DIV
             },
            error:function(){}
    });

    }*/
//热门职位

   /*function hotposition(){
        var positionul = $('.hot');//定位到需要插入的DIV
        var positionhtml = [];//新建一个数组变量
        $.ajax({
            url: posUrl,//后台给的
            type: "post",//发送方法
            dataType: "json",//返回的数据格式
         
            async: false,
            success:function(data){//如果成功即执行  
                positionhtml.push('<li>热门职位：</li>');
                $.each(data,function(i,n){//遍历返回的数据 共6条
                    positionhtml.push('<a href="'+seachUrl+'&position='+n.position+'"><li>'+n.position+'</li></a>');
                    //以原格式组装好数组
                });
                positionul.append(positionhtml.join(''));//把数组插入到已定位的DIV
            },
            error:function(){}
        });
    }*/
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
                            result.push('<a href="'+detailUrl+'&id='+On_data[i].id+'">>>详情</a>');
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