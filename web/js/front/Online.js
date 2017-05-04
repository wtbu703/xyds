$(document).ready(function(){
    //左边鼠标点击切换效果
    changeLeft();
    //搜索框下热门职位列表点击效果
   // ulClick();
    chanageJobCat();

    //职位信息
    positionMessage();
    //回车搜索
    $("#oninput").focus(function(){
        $(document).keypress(function(e){
            if(e.which == 13) {
                $('#contentSearch').click();
            };
        });
    });
});
//左边框点击切换
function changeLeft(){
    $(".list-group li").each(function(index){
        $(this).click(function(){
            $(".list-group li").removeClass("list_on");
            $(".list-group li").eq(index).addClass("list_on");
            $('.sea_1').val("");
            var firstChild = $('.full_ul>:first');
           firstChild.addClass('full_active').siblings().removeClass('full_active');
        });
    });
}
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
                if(data == ''){
                    result.push('<div class="tipinfo"><span class="infoo">您搜索的信息不存在!</span></div>');
                }
                    var On_data = data;
                    var sum = data.length;
                    if (sum - offset < size) {
                        size = sum - offset;
                    }
                    /*使用for循环模拟SQL里的limit(offset,size)*/
                    for (var i = offset; i < (offset + size); i++) {
                        var txt = On_data[i].demand.replace(/<[^>]+>/g, "");
                        if (txt.length > 150) {
                            var brief = txt.substr(0, 150) + "...";
                        } else {
                            var brief = txt.substr(0, 150);
                        }
                        if (index == 0) {
                            var key1 = On_data[i].position;
                            var fen = key1.split(searchValue);
                            var Keyword = fen.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                            var ss = txt;
                            var az = ss.split(searchValue);
                            var Keyword1 = az.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                            result.push('<h4>' + Keyword + '</h4>');
                            result.push('<p>' + On_data[i].companyName + '  |  ' + On_data[i].workPlace + '  |  ' + On_data[i].record + '  |  ' + On_data[i].exp + '  |  <span>' + On_data[i].salary + '</span></p>');
                            result.push('<div class="detail_p">' + Keyword1 + '</div>');
                            result.push('<a  target="_blank" href="' + detailUrl + '&id=' + On_data[i].id + '&companyId=' + On_data[i].companyId + '">>>详情</a>');
                            result.push('<div class="detial_line"></div>');
                        } else {
                            var key1 = On_data[i].position;
                            var fen = key1.split(searchValue);
                            var Keyword = fen.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                            result.push('<h4>' + Keyword + '</h4>');
                            result.push('<p>' + On_data[i].companyName + '  |  ' + On_data[i].workPlace + '  |  ' + On_data[i].record + '  |  ' + On_data[i].exp + '  |  <span>' + On_data[i].salary + '</span></p>');
                            result.push('<div class="detail_p">' + brief + '</div>');
                            result.push('<a  target="_blank" href="' + detailUrl + '&id=' + On_data[i].id + '&companyId=' + On_data[i].companyId + '">>>详情</a>');
                            result.push('<div class="detial_line"></div>');
                        }
                    }
                    More.html('');
                    More.append(result);
                    /*隐藏more按钮*/
                    if ((offset + size) >= sum) {
                        $("#get_more").hide();
                    } else {
                        $("#get_more").show();
                    }
            },
            error:function(){
            }
        });
    }

//切换搜索类别
    function chanageJobCat(){
        var $tab_list = $('.full_ul li');
        $tab_list.click(function(){
            $(this).addClass('full_active').siblings().removeClass('full_active');
            $('.sea_1').val("");
        });
    }

    //职位信息
    function positionMessage(cat){
        cat = cat||1;
            /*初始化*/
            var counter = 0; /*计数器*/
            var pageStart = 0; /*offset*/
            var pageSize = 6; /*size*/
            /*首次加载*/
            getData(pageStart, pageSize,cat,0);
        /*监听加载更多*/
        $(document).on('click', '#get_more', function(){
            counter ++;
            pageStart = counter * pageSize;
            getData(pageStart, pageSize,cat,1);
        });

    };
        function getData(offset,size,cat,number){
                var More=$('.detial');
                var result = [];
                $.ajax({
                    url: positionUrl,//后台给的
                    type: "post",//发送方法
                    data: 'cat=' +cat,
                    dataType: "json",//返回的数据格式
                    async: false,
                    success:function(data){
                       if(number == 0){
                           More.html('');
                       }
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
                            result.push('<div><a target="_blank" href="'+detailUrl+'&id='+On_data[i].id+'&companyId='+On_data[i].companyId+'">>>详情</a></div>');
                            result.push('<div class="detial_line"></div>');
                        }
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