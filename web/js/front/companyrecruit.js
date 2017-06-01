//职位信息
function getData(page){
    var More=$('.detial');
    var result = [];
    $.ajax({
        url: positionUrl,//后台给的
        type: "post",//发送方法
        data: 'page=' +page+"&companyId="+companyId,
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){
            var recruitdata = JSON.parse(data.recruit);
            More.html('');
            $.each(recruitdata, function (i, n) {//遍历返回的数据
                var txt = n.demand.replace(/<[^>]+>/g,"");
                if(txt.length>150){
                    var brief =  txt.substr(0,150)+"...";
                }else{
                    var brief =  txt.substr(0,150);
                }

                var place = n.place;
                var ace = place.split("-");
                result.push('<h4>'+n.position+'</h4>');
                result.push('<p>'+companyName+'  |  '+ace[1]+'  |  '+n.record+'  |  '+n.exp+'  |  <span>'+n.salary+'</span></p>');
                result.push('<div class="detail_p">'+brief+'</div>');
                result.push('<div><a target="_blank" href="'+detailUrl+'&id='+n.id+'&companyId='+n.companyId+'">>>详情</a></div>');
                result.push('<div class="detial_line"></div>');
            });
            More.append(result.join(''));
            getPage(data.pageSize,data.page,data.totalCount);
        },
        error:function(){}
    });
};


function getPage(pageSize,page,totalCount){
    var totalPage = Math.ceil(totalCount/pageSize);
    var next = parseInt(page)+1; //下一页
    var prev = parseInt(page)-1; //上一页
    var last = parseInt(totalPage)-1;//尾页
    var pagediv = $('.pagination');//定位到需要插入的DIV
    var pagehtml = [];//新建一个数组变量
    pagediv.html('');
    if(totalPage >1) {
        pagehtml.push('<li><a>' + totalCount + '条/' + totalPage + '页</a></li>');
        if (page > 0) {//不止一页
            pagehtml.push('<li><a href="javascript:getData(\'0\')" class="maodian">首页</a></li>');
            pagehtml.push('<li><a href="javascript:getData(' + prev + ')" aria-label="Previous" class="maodian">上一页</a></li>');
        }
        pagehtml.push('<li><a href="#">' + next + '</a></li>');
        if (page < last && totalPage > 1) {
            pagehtml.push('<li><a href="javascript:getData(' + next + ')" aria-label="Next" class="maodian">下一页</a></li>');
            pagehtml.push('<li><a href="javascript:getData(' + last + ')" class="maodian">尾页</a></li>');//跳转到信息公开详情页
        }
        if (totalPage > 1) {
            pagehtml.push('<input class="numInput" type="text" name="page" id="pagevalue" value=" ' + next + '"/>');
            pagehtml.push('<a class="pagego maodian">GO</a>');// href="javascript:getData(' + p + ')"
        }
    }
    //以原格式组装好数组
    pagediv.append(pagehtml.join(''));//把数组插入到已定位的DIV
    inputNum(pageSize,totalCount);
}


//搜索框为数字
function inputNum(pageSize,totalCount){
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
                getData(p);
            }else{
                getData(0);
            }
        });
    });
}


//店铺链接
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


$(document).ready(function(){

    //职位信息
    getData(0);
	
	 /*公司店铺链接*/
    companyStore();


});