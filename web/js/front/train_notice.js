function train(newsType,page){
    var textdiv = $('.row_one');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    var paraStr = 'newsType='+newsType+'&page='+page;
    $.ajax({
        url: ectrainUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:paraStr,
        async: false,
        success:function(data){//如果成功即执行
            var ectraindata = JSON.parse(data.ectrain);
            textdiv.html('');

            $.each(ectraindata,function(i,n){//遍历返回的数据
                {
                    var datetime = getNowFormatDate();
                    var d = n.beginTime;
                    var out = yeartime(d);

                    var t = n.endTime;
                    var end = yeartime(t);

                    var shortName = sbuStr(n.name,30);
                    html.push('<div class="col-md-6 col-sm-6 col-xs-12 content">');
                    html.push('<div class="boxS">');
                    html.push('<div class="text">');
                    html.push('<h1>第'+(n.period+1)+'期'+shortName+'</h1>');
                    html.push('<hr>');
                    html.push('<p class="time">培训时间:'+n.dayNum+'天</p>');
                    html.push('<p>人数:<span id="people">'+n.peopleNum+'</span>人</p>');
                    html.push('<p>期数:第'+(n.period+1)+'期</p>');
                    html.push('<p>培训对象:'+n.target+'</p>');
                    html.push('<p>报名时间:'+out+'-'+end+'</p>');
                    html.push('<p>发布时间:'+n.published+'</p>');
                    html.push('<p class="detail"><a href="'+detailUrl+'&id='+n.id+'" target="_blank">了解详情&nbsp;&gt;&nbsp;&gt;</a></p>');

                    html.push('</div>');
                    html.push('<div class="circle col-md-3 hidden-xs"><div class="pie_left"><div class="left1"></div></div><div class="pie_right"><div class="right1" style="transform: rotate(180deg);"></div></div><div class="mask">已报名<span>'+data.peopleNum[i]+'</span>人</div>');
                    html.push('</div>');
                    if(datetime>=n.beginTime&&datetime<=n.endTime) {
                        html.push('<div class="down col-md-3 col-sm-3 "><a href="' + singupUrl + '&id=' + n.id + '" class="btn btn_common1" target="_blank" role="button">开始报名</a></div>');
                    }else{
                        html.push('<div class="down col-md-3 col-sm-3 "><a class="btn btn_common2" target="_blank" role="button">开始报名</a></div>');
                    }
                    html.push('');
                    html.push('</div>');
                    html.push('</div>');
                }
                //以原格式组装好数组
            });

            textdiv.append(html.join(''));//把数组插入到已定位的DIV
            getPage(data.pageSize,data.page,data.totalCount,newsType);
            getMaodian();
        },

        error:function(){

        }
    });
    //生成进度条
    getProgessBar();
}
function sbuStr(str, n){//字符串截取 包含对中文处理
    if (str.replace(/[\u4e00-\u9fa5]/g, "**").length <= n) {
        return str;
    }
    else {
        var len = 0;
        var tmpStr = "";
        for (var i = 0; i < str.length; i++) {//遍历字符串
            if (/[\u4e00-\u9fa5]/.test(str[i])) {//中文 长度为两字节
                len += 2;
            }
            else {
                len += 1;
            }
            if (len > n) {
                break;
            }
            else {
                tmpStr += str[i];
            }
        }
        return tmpStr + " ...";
    }
}
//获取当前时间
function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
        + " " + date.getHours() + seperator2 + date.getMinutes()
        + seperator2 + date.getSeconds();
    return currentdate;
}

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
            pagehtml.push('<li><a href="javascript:train(' + cat + ',\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:train(' + cat + ',' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a  href="javascript:train(' + cat + ',' + page + ')">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:train(' + cat + ',' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:train(' + cat + ',' + last + ')" class="maodian">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input type="text" name="page" class="numInput"  id="pagevalue" value="' + next + '"/>');
            pagehtml.push('<a class="pagego maodian">GO</a>');
        }
    }

    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount,cat);
}
//分页框为数字
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
                train(cat,p);
            }else{
                train(cat,0);
            }
        });
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
//生成进度条
function getProgessBar(){
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
}
function trainClassify(){
    //培训分类
    var textclassify = $('.row_enterprise');//定位到需要插入的DIV
    var texthtml = [];//新建一个数组变量
    texthtml.push('<div class="right_head">');
    texthtml.push('<div class="list_head">');
    texthtml.push('<span class="lh_index"><img class="img-responsive home" src="images/images_common/home.png" alt="首页图标"><a href="'+indexUrl+'">首页</a>&nbsp;></span>');
    texthtml.push('<span class="lh_index"><a href="'+ecUrl+'">电商培训</a>&nbsp;>&nbsp;</span>');
    texthtml.push('<span class="lh_index">培训通知&nbsp;</span>');
    texthtml.push('</div>');
    texthtml.push('</div>');
    $.ajax({
        url: dictUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            texthtml.push('<div class="col-xs-12 col-md-12 column column_mt"><div class="redbar"></div><span>培训通知</span><ul class="nav nav_classify">');
            if(type == '') {
                texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 col-lg-1 active">全部</a>');
            }else{
                texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 col-lg-1 ">全部</a>');
            }
                $.each(data,function(i,n){//遍历返回的数据
                {
                    if(type == i&&type != '') {
                        texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 col-lg-1 active">' + n.dictItemName + '</a>');
                    }else{
                        texthtml.push('<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 col-lg-1">' + n.dictItemName + '</a>');
                    }
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


}
$(document).ready(function(){
    /*培训通知*/
    if(type != '') {
        p = parseInt(type)+1;
        train(p, 0);
    }else{
        train(0, 0);
    }
    trainClassify();

    var $tab_list = $('.nav_classify a');
    $tab_list.click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        var index = $tab_list.index(this);
        train(index,0);
    });
});
