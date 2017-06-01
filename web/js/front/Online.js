$(document).ready(function(){
    //左边鼠标点击切换效果
    changeLeft();
    //搜索框下热门职位列表点击效果
   // ulClick();
    chanageJobCat();
    //职位信息
    getData(0,0,0,0);

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
//职位信息
function positionMessage(cat){
    getData(cat,0,0,0);
};


//切换搜索类别
    function chanageJobCat(){
        var $tab_list = $('.full_ul li');
        $tab_list.click(function(){
            $(this).addClass('full_active').siblings().removeClass('full_active');
            $('.sea_1').val("");
        });
    }
//搜索类别
function ulClick(){
    var searchValue = $('.sea_1').val(); //搜索的类型
    var $tab_list = $('.full_ul li');
    var active =  $('.full_ul');
    var index = $tab_list.filter(".full_active").index(); //搜索的关键词
    getData(0,0,searchValue,index);
}
//职位信息
        function getData(cat,page,searchValue,index){
                var More=$('.detial');
                var result = [];
                var para = '';
                para += 'cat='+cat;
                para += '&page='+page;
                para += '&searchValue='+searchValue;
                para += '&index='+index;
                $.ajax({
                    url: positionUrl,//后台给的
                    type: "post",//发送方法
                    data:para,
                    dataType: "json",//返回的数据格式
                    async: false,
                    success:function(data){
                        More.html('');
                        var recruitdata = JSON.parse(data.recruit);
                        var On_data = recruitdata;
                        if(On_data==''){
                            result.push('<div class="tipinfo"><span class="infoo">您搜索的信息不存在!</span></div>');
                        }else {
                            $.each(On_data, function (i, n) {//遍历返回的数据

                                var txt = n.demand.replace(/<[^>]+>/g, "");
                                if (txt.length > 150) {
                                    var brief = txt.substr(0, 150) + "...";
                                } else {
                                    var brief = txt.substr(0, 150);
                                }
                                if (index == 0) {
                                    if(searchValue != 0) {
                                        var position = n.position;
                                        var fposition = position.split(searchValue);
                                        var redposition = fposition.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                        if (n.state == '0') {
                                            var companyName = "公共服务平台";
                                        } else {
                                            var companyName = n.companyName;
                                        }
                                        var fcompanyName = companyName.split(searchValue);
                                        var redcompanyName = fcompanyName.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                        var workPlace = n.workPlace;
                                        var fworkPlace = workPlace.split(searchValue);
                                        var redworkPlacee = fworkPlace.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                        var record = n.record;
                                        var frecord = record.split(searchValue);
                                        var redrecord = frecord.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                        var Brief = brief;
                                        var fbrief = Brief.split(searchValue);
                                        var redbrief = fbrief.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                    }else{
                                        var redposition = n.position;
                                        if (n.state == '0') {
                                            var redcompanyName = "公共服务平台";
                                        } else {
                                            var redcompanyName = n.companyName;
                                        }
                                        var redworkPlacee = n.workPlace;
                                        var redrecord = n.record;
                                        var redbrief = brief;
                                    }
                                        result.push('<h4>' + redposition + '</h4>');
                                        result.push('<p>' + redcompanyName + '  |  ' + redworkPlacee + '  |  ' + redrecord + '  |  ' + n.exp + '  |  <span>' + n.salary + '</span></p>');
                                        result.push('<div class="detail_p">' + redbrief + '</div>');
                                        result.push('<div><a target="_blank" href="' + detailUrl + '&id=' + n.id + '&companyId=' + n.companyId + '">详情 >></a></div>');
                                        result.push('<div class="detial_line"></div>');

                                } else if (index == 1) {
                                    if (n.state == '0') {
                                        var redcompanyName = "公共服务平台";
                                    } else {
                                        var redcompanyName = n.companyName;
                                    }
                                    var Position = n.position;
                                    var fPosition = Position.split(searchValue);
                                    var redPosition = fPosition.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                    result.push('<h4>' + redPosition + '</h4>');
                                    result.push('<p>' + redcompanyName + '  |  ' + n.workPlace + '  |  ' + n.record + '  |  ' + n.exp + '  |  <span>' + n.salary + '</span></p>');
                                    result.push('<div class="detail_p">' + brief + '</div>');
                                    result.push('<div><a target="_blank" href="' + detailUrl + '&id=' + n.id + '&companyId=' + n.companyId + '">详情 >></a></div>');
                                    result.push('<div class="detial_line"></div>');
                                } else {
                                    if(n.state == '0'){
                                        var CompanyName = "公共服务平台";
                                    }else{
                                        var CompanyName = n.companyName;
                                    }
                                    var fCompanyName = CompanyName.split(searchValue);
                                    var redCompanyName = fCompanyName.join('<span style="padding:0;color:#c62f2f;">' + searchValue + '</span>');
                                    result.push('<h4>' + n.position + '</h4>');
                                    result.push('<p>' + redCompanyName + '  |  ' + n.workPlace + '  |  ' + n.record + '  |  ' + n.exp + '  |  <span>' + n.salary + '</span></p>');
                                    result.push('<div class="detail_p">' + brief + '</div>');
                                    result.push('<div><a target="_blank" href="' + detailUrl + '&id=' + n.id + '&companyId=' + n.companyId + '">详情 >></a></div>');
                                    result.push('<div class="detial_line"></div>');
                                }
                            });
                        }

                        More.append(result.join(''));
                        getPage(data.pageSize,data.page,data.totalCount,cat,searchValue,index);
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
//分页
function getPage(pageSize,page,totalCount,cat,searchValue,index){
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
            pagehtml.push('<li><a href="javascript:getData(' + cat + ',\'0\',\''+searchValue+'\','+index+')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:getData(' + cat + ',' + prev + ',\''+searchValue+'\','+index+')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a class="maodian" href="javascript:getData(' + cat + ',' + page + ',\''+searchValue+'\','+index+')">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:getData(' + cat + ',' + next + ',\''+searchValue+'\','+index+')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:getData(' + cat + ',' + last + ',\''+searchValue+'\','+index+')">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page"  id="pagevalue" value="' + next + '"/>');
            pagehtml.push('<a class="pagego maodian">GO</a>');
        }
    }
    //以原格式组装好数组

    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount,cat,searchValue,index);
}
//搜索框为数字
function inputNum(pageSize,totalCount,cat,searchValue,index){
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
                getData(cat,p,searchValue,index);
            }else{
                getData(cat,0,searchValue,index);
            }
        });
    });
}