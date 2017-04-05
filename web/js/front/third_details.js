function generateDetail(data){
    var textdiv = $('.art');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    //var uptime=daytime(n.);//缺时间字段
    //var artime=yeartime(n.);//缺时间字段
    //var art_text=texthtml(n.)；//缺内容字段
    html.push('<h2>'+ data.companyName +'</h2>');
    html.push('<div class="pub_info">');
    html.push('<span>内容来源：点击数：更新时间：：</span>');//缺来源，点击数，
    html.push('</div>');
    html.push('<div ><img class="third_art" src="'+ data.logoUrl +'" ></div>');
    html.push('<div class="art_box">');
    html.push('<ul class="art_info">');
    html.push('<li>公司名称：'+data.companyName+'</li>');//公司名称
    html.push('<li>服务名称：'+data.introduction+'</li>');//服务名称
    html.push('<li>发布时间：</li>');//发布时间时间
    html.push('<li>联系人：</li>');//缺联系人
    html.push('<li>联系电话：'+data.tel+'</li>');//电话
    html.push('<li>电子邮箱：'+data.email+'</li>');//邮箱
    html.push('<li>联系地址：'+data.address+'</li>');//地址
    html.push('</ul>');
    html.push('</div>');
    html.push('<div class="art_content">');
    html.push('<p></p>');//缺内容
    html.push('</div>');
    textdiv.append(html.join(''));//把数组插入到已定位的DIV
}
$(document).ready(function(){
    //左右高度相等
    //height_change();

    var Uptime = daytime(datetime);
    var pubTime = daytime(publicTime);
    $('#upTime').html(Uptime);
    $('.pubtime').html(pubTime);

});