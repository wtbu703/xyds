//获取第三方服务列表
function getThird(cat,tag,page){
    var textdiv = $('.row_one');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    var para = '';
    para += 'cat='+cat;
    para += '&tag='+tag;
    para += '&page='+page;
    $.ajax({
        url: thirdUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data: para, //'cat='+ cat
        async: false,
        success:function(data){//如果成功即执行  共12条
            textdiv.html('');
            var thirddata = JSON.parse(data.third);
            if(thirddata==''){
                html.push('<div class="tipinfo"><span class="infoo">您搜索的信息不存在!</span></div>');
            }
            $.each(thirddata,function(i,n){//遍历返回的数据
                var key1 = n.companyName;
                var fen = key1.split(tag);
                var Keyword = fen.join('<span style="padding:0;color:#c62f2f;">' + tag + '</span>');
                html.push('<div class="col-md-4 col-sm-6 col-xs-12 enterprise">');
                html.push('<a href="'+thirdDetailUrl+'&id='+n.id+'">');//跳转到第三方服务详情页
                html.push('<div class="box_shadow">');
                html.push('<img class="img-responsive" src="'+ n.logoUrl +'" alt="企业图片">');
                html.push('<div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">');
                html.push('<h4>'+ Keyword +'</h4>');
                html.push('<div class="row redline">');
                html.push('<div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>');
                html.push('<div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>');
                html.push('</div>');
                html.push('<div class="E-commerce">'+n.introduction+'</div>');
                html.push('</div>');
                html.push('</div>');
                html.push('</a>');
                html.push('</div>');
                //以原格式组装好数组
            });
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
            getPage(data.pageSize,data.page,data.totalCount,cat,tag);
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
//分页
function getPage(pageSize,page,totalCount,cat,tag){
    var totalPage = Math.ceil(totalCount/pageSize);//总页数
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    if(totalPage >1) {
        pagehtml.push('<li><a>' + totalCount + '条/' + totalPage + '页</a></li>');
        if (page > 0) {
            pagehtml.push('<li><a href="javascript:getThird(' + cat + ',\''+tag+'\',\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:getThird(' + cat + ',\''+tag+'\',' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a class="maodian" href="javascript:getThird(' + cat + ',\''+tag+'\',' + page + ')">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:getThird(' + cat + ',\''+tag+'\',' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:getThird(' + cat + ',\''+tag+'\',' + last + ')" class="maodian">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page"  id="pagevalue" value="' + next + '"/>');
            pagehtml.push('<a class="pagego maodian">GO</a>');
        }
    }
    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount,cat,tag);
}
//搜索框为数字
function inputNum(pageSize,totalCount,cat,tag){
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
                getThird(cat,tag,p);
            }else{
                getThird(cat,tag,0);
            }
        });
    });
}
/**
 * 根据企业名称进行搜索
 */
function searchByNameCat(){
    var tag = $("#thirdName").val();
    getThird('-1',tag,0);
}

//企业分类
function companyClassify(){
    var textclassify = $('.row_enterprise');//定位到需要插入的DIV
    var texthtml = [];//新建一个数组变量
    $.ajax({
        url: dictUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            texthtml.push('<a href="javascript:getThird(-1,-1,0)" class="btn companyA col-xs-12 col-sm-1 col-md-1 active">全部</a>');
            $.each(data,function(i,n){//遍历返回的数据
                {
                    texthtml.push("<a href='javascript:getThird("+n.dictItemCode+",-1,0)' class='btn companyA col-xs-12 col-sm-2 col-md-2 col-lg-1'>"+n.dictItemName+"</a>");

                }
                //以原格式组装好数组
            });
            texthtml.push('</ul>');
            texthtml.push('</div>');

            textclassify.append(texthtml.join(''));//把数组插入到已定位的DIV
        },

        error:function(){

        }
    });
}
$(document).ready(function(){
    //左边栏
   // left();
    companyClassify();
    //右边部分
    getThird(-1,-1,0);
    //鼠标点击切换效果
    var $tab_list = $('.nav_classify a');
    $tab_list.click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        var index = $tab_list.index(this);
        enterprise(index,0);

    });
    //回车搜索
    $("#thirdName").focus(function(){
        $(document).keypress(function(e){
            if(e.which == 13) {
                $('.search_bg').click();
            };
        });
    });
});
