function ziXun1(newsType,page){
    var rowNews = $('.information_main');
    var rowNews_html = [];
    var paraStr = 'newsType='+newsType+'&page='+page;
    $.ajax({
        url: articleUrl,
        type: "post",
        dataType: "json",
        async: false,
        data: paraStr,
        success:function(data){
            var articledata = JSON.parse(data.article);
            rowNews.html('');
            rowNews_html.push('<div class="information_content">');
            $.each(articledata,function(i,n){
                //时间格式转换为 2017-12-02
                var out = daytime(n.datetime);
                var content = texthtml(n.content);
                //上传默认图片
                var picTp = imgTp(n.picUrl,'newsImages');
                /* 循环6遍  */ 
                rowNews_html.push('<div class="row">');
                rowNews_html.push('<div class="col-xs-4">');
                rowNews_html.push('<a href="'+detailUrl+'&articleId='+n.id+'"><img class="img-responsive" src="'+ picTp +'" alt="新闻图片"></a>');
                rowNews_html.push('</div>');
                rowNews_html.push('<div class="col-xs-8 news">');
                rowNews_html.push('<h5><a href="'+detailUrl+'&articleId='+n.id+'">'+ n.title +'</a></h5>');
                rowNews_html.push('<p><a href="'+detailUrl+'&articleId='+n.id+'">'+ content +'</a></p>');
                rowNews_html.push('<span>发布时间：'+ out +'</span>');
                rowNews_html.push('</div>');
                rowNews_html.push('</div>');
                rowNews_html.push('<hr />');
                /* END循环6遍  */ 
                
            });
            rowNews_html.push('</div>');
            rowNews.append(rowNews_html.join(''));
            getPage(data.pageSize,data.page,data.totalCount,newsType);
            getMaodian();
        },
        error:function(){
            
        }
    });
}



//分页
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
            pagehtml.push('<li><a href="javascript:ziXun1(' + cat + ',\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:ziXun1(' + cat + ',' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a class="maodian" href="javascript:ziXun1(' + cat + ',' + page + ')">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:ziXun1(' + cat + ',' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:ziXun1(' + cat + ',' + last + ')">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page"  id="pagevalue" value="' + next + '"/>');
            //var p = "parseInt($('#pagevalue').val())-1";
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
                ziXun1(cat,p);
            }else{
                ziXun1(cat,0);
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
function hotNews(){
    var hotnews = $('.hotNews');
    var hotnews_html = [];
    $.ajax({
        url: hotNewsUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            hotnews_html.push('<ul >');
            $.each(data,function(i,n){
                if(data == ''){
                    hotnews_html.push('<p>主人太懒,暂无相关消息</p>');
                }else{
                    if(i>=0&&i<=2)
                    {
                        hotnews_html.push('<li class="news_arrow">');
                        hotnews_html.push('<a href="'+detailUrl+'&articleId='+n.id+'"><span>·</span>'+ n.title +' </a>');
                        hotnews_html.push('</li>');
                    }
                    else{
                        hotnews_html.push('<li>');
                        hotnews_html.push('<a href="'+detailUrl+'&articleId='+n.id+'"><span>·</span>'+ n.title +' </a>');
                        hotnews_html.push('</li>');
                    }  
                }
            });
            hotnews_html.push('</ul >');
            hotnews.append(hotnews_html.join(''));
        },
        error:function(){
            
        }
    });
}
function hotCompany(){
    var hotcompany = $('.hotCompany');
    var hotcompany_html = [];
    $.ajax({
        url: hotCompanyUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){
                if(data == ''){
                    hotcompany_html.push('<p>主人太懒,暂无相关消息</p>');
                }else{
                    var content = rhtml(n.introduction);
                    hotcompany_html.push('<div class="row company">');
                    hotcompany_html.push('<div class="col-xs-5 ">');
                    hotcompany_html.push('<a href="'+companyDetailUrl+'&id='+n.id+'"><img class="img-responsive " src="'+ n.logoUrl +'" alt="新闻图片"></a>');
                    hotcompany_html.push('</div>');
                    hotcompany_html.push('<div class="col-xs-7 hot_company">');
                    hotcompany_html.push('<h5><a href="'+companyDetailUrl+'&id='+n.id+'">'+ n.name +'</a> </h5><p><a href="'+companyDetailUrl+'&id='+n.id+'">'+ content +'</a></p>');
                    hotcompany_html.push('</div>');
                    hotcompany_html.push('</div>');
                }
            });
            hotcompany.append(hotcompany_html.join(''));
        },
        error:function(){
            
        }
    });
}
$(document).ready(function(){

    //选项卡标题
    var information_list = $('.information_list');
    var information_list_html = [];
    $.ajax({
        url: articleDictUrl,
        type: "post",
        dataType: "json",
        async: false,
        success:function(data){
            information_list_html.push('<li role="presentation" class="active"><a>最新</a></li>');
             $.each(data,function(i,n){
                information_list_html.push('<li role="presentation" ><a>'+ n.dictItemName +'</a></li>');
            })
            information_list.append(information_list_html.join(''));
        },
        error:function(){
            
        }
    });

    ziXun1(0,0);
    //文章
   
    //选项卡切换
    var $tab_list = $('.information_list li');
    $tab_list.click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        var index = $tab_list.index(this);
        ziXun1(index,0);
        $('div.information_main > div').eq(index).show().siblings().hide();
    });

    //热点新闻
    hotNews();
    //热们企业
    hotCompany();
    
    //鼠标点击事件


});