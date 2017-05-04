function ziXun2(newsType,page){
    var rowNews = $('.article_main');
    var rowNews_html = [];
    $.ajax({
        url:companyNewsUrl,
        type:"post",
        dataType:"json",
        async: false,
        data: "newsType="+newsType+"&companyId="+companyId+"&page="+page,
        success:function(data){
            var newsdata = JSON.parse(data.news);
            rowNews.html('');
            rowNews_html.push('<div class="article_list">');  
            $.each(newsdata,function(i,n){
                var d = n.published;
                var date = new Date(d);
                var out = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());     
                var content = rhtml(n.content);
               /* 循环6遍*/
                rowNews_html.push('<hr />');
                rowNews_html.push('<div class="row">');
                rowNews_html.push('<div class="col-xs-4"><img class="img-responsive" src="'+ n.picUrl +'" alt="新闻图片"></div>');
                rowNews_html.push('<div class="col-xs-8 news">');
                rowNews_html.push('<h5><a href="'+newsDetailUrl+'&newsId='+n.id+'&companyId='+companyId+'">'+ n.title +'</a></h5>');
                rowNews_html.push('<p><a href="'+newsDetailUrl+'&newsId='+n.id+'&companyId='+companyId+'">'+ content +'</a></p>');
                rowNews_html.push('<span>发布时间：'+ out +'</span>');
                rowNews_html.push('</div>');
                rowNews_html.push('</div>');
                /* END循环6遍*/
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
            pagehtml.push('<li><a href="javascript:ziXun2(' + cat + ',\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:ziXun2(' + cat + ',' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a href="javascript:ziXun2(' + cat + ',' + page + ')" >' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:ziXun2(' + cat + ',' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:ziXun2(' + cat + ',' + last + ')" class="maodian">尾页</a></li>');//跳转到信息公开详情页
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
                ziXun2(cat,p);
            }else{
                ziXun2(cat,0);
            }
        });
    });
}
function companyStore(){
    var store = $('.store_link');//定位到需要插入的DIV
    var store_html = [];//新建一个数组变量
    $.ajax({
        url: shoplinkUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data : "companyId="+companyId,
        async: false,
        success:function(data){//如果成功即执行
            store_html.push('<div class="link_title clearfix"><img class="img-responsive " src="images/images_enterprisedetail/icon1.png" alt="图标"><h4>公司店铺链接</h4></div>');
            store_html.push('<ul>');
            $.each(data,function(i,n){//遍历返回的数据
                if(data == ''){
                    store_html.push('<p>主人太懒,暂无相关消息</p>');
                }else{
                    {
                        if(i==0){
                            store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/JD.png" alt="京东"><a href="'+n.shopLink+'"><span>京东</span></a></li>');
                        }
                        else if(i==1){
                            store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/tmall.png" alt="天猫"><a href="'+n.shopLink+'"><span>天猫</span></a></li>');
                        }
                        else if(i==2){
                            store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/taobao.png" alt="淘宝"><a href="'+n.shopLink+'"><span>淘宝</span></a></li>');
                        }
                        else if(i==3){
                            store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/1hd.png" alt="一号店"><a href="'+n.shopLink+'"><span>一号店</span></a></li>');
                        }
                        else if(i==4){
                            store_html.push('<li class="link_name clearfix"><img class="img-responsive" src="images/images_enterprisedetail/suning.png" alt="苏宁"><a href="'+n.shopLink+'"><span>苏宁</span></a></li>');
                        }
                    }
                    //以原格式组装好数组
                }
            });
            store_html.push('</ul>');
            store.append(store_html.join(''));//把数组插入到已定位的DIV
        },

        error:function(){

        }
    });
}
function companyRecruit(){
    var recruit = $('.company_recruit');//定位到需要插入的DIV
    var recruit_html = [];//新建一个数组变量
    recruit_html.push('<div class="link_title clearfix"><img class="img-responsive " src="images/images_enterprisedetail/icon1.png" alt="图标"><h4>公司招聘</h4><a href="'+lineUrl+'">>>更多</a></div>');
    $.ajax({
        url: recruitUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data : "companyId="+companyId,
        async: false,
        success:function(data){//如果成功即执行
            $.each(data,function(i,n){//遍历返回的数据
                 if(data == ''){
                    recruit_html.push('<p>主人太懒,暂无相关消息</p>');
                }else{
                    {
                        recruit_html.push('<div class="recruit clearfix"><div></div><a href="'+onlineUrl+'&id='+n.id+'&companyId='+companyId+'">'+n.position+'</a>');
                        recruit_html.push('<h5>'+n.workPlace+'<span>|</span>'+n.record+'<span>|</span>'+n.salary+'<span>|</span>'+n.exp+'</h5>');
                        recruit_html.push('</div>');
                    }
                    //以原格式组装好数组
                }
            });
            recruit.append(recruit_html.join(''));//把数组插入到已定位的DIV
        },

        error:function(){

        }
    });
}

$(document).ready(function(){

	//文章列表
    ziXun2(0,0);
	
	 /*公司店铺链接*/
    companyStore();

	//公司招聘
    companyRecruit();

    //选项卡切换 
    var $tab_list = $('.column_list a');
    $tab_list.click(function(){
        $(this).addClass('hover').siblings().removeClass('hover');
        var index = $tab_list.index(this);
        ziXun2(index,0);
        $('div.article_main > div').eq(index).show().siblings().hide();
    })
});