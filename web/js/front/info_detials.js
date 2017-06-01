$(document).ready(function(){
    row_public(id);
});
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
            if(data[0].state != ''&&data[0].state!=null) {
                rowpublic_html.push(' <div class="img_title">招标最新进展</div>');
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
                var statl = data.length - 1;
                $.each(data, function (i, n) {
                    var times = timepoint(n.time);
                    tenderd(statl, times);
                });
            }
        },
        error:function(){

        }
    });
}

