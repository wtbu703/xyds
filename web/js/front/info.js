$(document).ready(function() {

    //左边栏
    getDict();
    //中间
    getInfo(-1,0);

    //右边上
    getOne();
    //鼠标点击切换效果
    $(".list-group li").each(function (index) {
        $(this).click(function () {
            $(".list-group li").removeClass("list_on");
            $(".list-group li").eq(index).addClass("list_on");
        });
    });

});

    //鼠标点击切换效果

    //左边栏

    function getDict() {
        var left = $('.list-group');//定位到需要插入的DIV
        var lefthtml = [];//新建一个数组变量
        $.ajax({
            url: dictUrl,//后台给的
            type: "post",//发送方法
            dataType: "json",//返回的数据格式
            async: false,
            success: function (data) {//如果成功即执行  共5条
                left.html('');
                lefthtml.push("<a href='javascript:getInfo("+(-1)+",0)'><li class='list_item1 list_on '>全部</li></a>");
                $.each(data, function (i, n) {//遍历返回的数据
                    lefthtml.push("<a href='javascript:getInfo("+n.dictItemCode+",0)'><li class='list_item1 '>" + n.dictItemName + "</li></a>");//未选中样式
                    //以原格式组装好数组
                });
                left.append(lefthtml.join(''));//把数组插入到已定位的DIV

            },
            error: function () {
            }
        });
    }
    //中间列表
function getInfo(cat,page){
    var textdiv = $('.publicity');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    var paraStr = 'cat='+cat+'&page='+page;
    $.ajax({
        url: infoUrl,//后台给的
        type: "post",//发送方法
        data: paraStr,
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行  共21条
            var infodata = JSON.parse(data.info);
            textdiv.html('');
            $.each(infodata, function (i, n) {//遍历返回的数据
                    var artime = time(n.published);
                    html.push('<li>');
                    html.push('<a href="' + infoDetail + '&id=' + n.id + '">');
                    html.push('<div></div>');
                    html.push('<span>' + n.title + '</span>');
                    html.push('<h class="con_h">' + artime + '</h>');
                    html.push('</a>');
                    html.push('</li>');
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
            getPage(data.pageSize,data.page,data.totalCount,cat);
            getMaodian();
        },
        error:function(){}
    });
}
//点击分页回到顶部
function getMaodian(){
    $('.maodian').each(function(){
        $(this).click(function(){
            $('body,html').animate({scrollTop:10},100);
            // location.href = "#001";
        });
    });
}
//中间分页
        function getPage(pageSize,page,totalCount,cat){
            var totalPage = Math.ceil(totalCount/pageSize);
            var next = parseInt(page)+1; //下一页
            var prev = parseInt(page)-1; //上一页
            var last = parseInt(totalPage)-1;//尾页
            var pagediv = $('.pagination');//定位到需要插入的DIV
            var pagehtml = [];//新建一个数组变量
            pagediv.html('');
            if(totalPage >1) {
                pagehtml.push('<li><a>' + totalCount + '条/' + totalPage + '页</a></li>');
                if (page > 0) {
                    pagehtml.push('<li><a href="javascript:getInfo(' + cat + ',\'0\')" class="maodian">首页</a></li>');
                    pagehtml.push('<li><a href="javascript:getInfo(' + cat + ',' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
                }
                pagehtml.push('<li><a href="javascript:getInfo(' + cat + ',' + page + ')" >' + next + '</a></li>');
                if (page < last && totalPage > 1) {
                    pagehtml.push('<li><a href="javascript:getInfo(' + cat + ',' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
                    pagehtml.push('<li><a href="javascript:getInfo(' + cat + ',' + last + ')" class="maodian">尾页</a></li>');//跳转到信息公开详情页
                }
                if (totalPage > 1) {
                    pagehtml.push('<input class="numInput" type="text" name="page"  id="pagevalue" value="' + next + '"/>');
                    pagehtml.push('<a class="pagego maodian">GO</a>');
                }
            }
                //以原格式组装好数组

            pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
            inputNum(pageSize,totalCount,cat);
        }
//搜索框为数字
function inputNum(pageSize,totalCount,cat){
    var totalpage = Math.ceil(totalCount/pageSize);
    $('.numInput').keyup(function(event){
        if(this.value.length==1){
            this.value=this.value.replace(/[^1-9]/g,'');
        }else{
            this.value=this.value.replace(/\D/g,'');
        }
        var p = this.value-1;
        $('.pagego').click(function(){
            if(p<=totalpage){
                getInfo(cat,p);
            }else{
                getInfo(cat,0);
            }
        });
    });
}

    //右边上
function getOne() {
    var rightdiv = $('.zixun_banner');//定位到需要插入的DIV
    var righthtml = [];//新建一个数组变量
    $.ajax({
        url: infoOneUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success: function (data) {//如果成功即执行  共1条
            $.each(data, function (i, n) {//遍历返回的数据
                var content = rhtml(n.content);
                if (i == 0) {
                    righthtml.push('<div class="item active">');
                    righthtml.push('<div class="zixun_text">');
                    righthtml.push('<h5><a href="'+infoDetail+'&id='+n.id+'">' + n.title + '</a></h5>');//跳转到信息公开详情页
                    righthtml.push('<img src="images/images_index/zixun_lineblue.png" alt="">');
                    righthtml.push('<p>');
                    righthtml.push('<a href="'+infoDetail+'&id='+n.id+'">' + content + '</a>');//跳转到信息公开详情页
                    righthtml.push('</p>');
                    righthtml.push('</div>');
                    righthtml.push('</div>');
                };
                //以原格式组装好数组
            });
            rightdiv.append(righthtml.join(''));//把数组插入到已定位的DIV
            row_public(data[0].id);
        },
        error: function () {
        }
    });
}
//招标传参
function tenderd(tl,t){

    var timeline =new Array();
    timeline[0] = $('.tender_times')[0];
    timeline[1] = $('.tender_times')[1];
    timeline[2] = $('.tender_times')[2];
    timeline[3] = $('.tender_times')[5];
    timeline[4] = $('.tender_times')[4];
    timeline[5] = $('.tender_times')[3];
    timeline[6] = $('.tender_times')[6];
    timeline[7] = $('.tender_times')[7];
    timeline[8] = $('.tender_times')[8];
    var course = new Array();
    course[0] = $('.tender_process')[0];
    course[1] = $('.tender_process')[1];
    course[2] = $('.tender_process')[2];
    course[3] = $('.tender_process')[5];
    course[4] = $('.tender_process')[4];
    course[5] = $('.tender_process')[3];
    course[6] = $('.tender_process')[6];
    course[7] = $('.tender_process')[7];
    course[8] = $('.tender_process')[8];
    $(course[tl]).addClass('active').siblings().removeClass('active');
    $(timeline[tl]).addClass('active_time').siblings().removeClass('active_time');
    $(timeline).each(function(n){
        if(n>tl){
            $(this).html('');
        }else{
            $(this).html(t);
        }
    })
}

//信息公开 招标进展
function row_public(id){
    var rowpublic = $('.row_public');
    var rowpublic_html = [];
    $.ajax({
        url: stateUrl,
        type: "post",
        data: 'id='+id,
        dataType: "json",
        success:function(data){
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender"><span class="col-xs-3 tender_process testq">招标公示</span><img class="col-xs-1 img-responsive  center-block" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">招标报名</span><img class="col-xs-1 " class="col-xs-1 img-responsive center-block" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">资格审查</span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender tender_time"><span class="col-xs-3 tender_times"></span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender_img "><div class="col-xs-3"></div><div class="col-xs-1"></div><div class="col-xs-3"></div><div class="col-xs-1"></div><div class="col-xs-3"><img class=" img-responsive center-block" src="images/images_index/xinxi_arrow2.png" alt=""></div></div>');
            rowpublic_html.push('</div>');

            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender"><span class="col-xs-3 tender_process">缴保证金</span><img class="col-xs-1 img-responsive center-block" src="images/images_index/xinxi_arrow1.png" alt=""><span class="col-xs-3 tender_process">编制文件</span><img  class="col-xs-1 img-responsive center-block" src="images/images_index/xinxi_arrow1.png" alt=""><span class="col-xs-3 tender_process">招标答疑</span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender tender_time"><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender_img "><div class="col-xs-3"><img class="img-responsive center-block" src="images/images_index/xinxi_arrow2.png" alt=""></div><div class="col-xs-1"></div><div class="col-xs-3"></div><div class="col-xs-1"></div><div class="col-xs-3"></div></div>');
            rowpublic_html.push('</div>');

            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender"><span class="col-xs-3 tender_process">开标定标</span><img class="col-xs-1 img-responsive center-block" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">中标公示</span><img  class="col-xs-1 img-responsive center-block" src="images/images_index/xinxi_arrow3.png" alt=""><span class="col-xs-3 tender_process">发招标书</span></div>');
            rowpublic_html.push('</div>');
            rowpublic_html.push('<div class="row">');
            rowpublic_html.push('<div class="col-xs-12 tender tender_time"><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span><div class="col-xs-1"></div><span class="col-xs-3 tender_times"> </span></div>');
            rowpublic_html.push('</div>');
            rowpublic.append(rowpublic_html.join(''));
            var statl = data.length-1;
            $.each(data,function(i,n) {
                var times = timepoint(n.time);
                tenderd(statl,times);
            });
        },
        error:function(){
        }
    });
}


