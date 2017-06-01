
//左侧高度
function height_change(){
    var a = $("#content_left").height();
    var m = Math.max(
        $("#content_right").height(),
        $("#content_left").height()
    );
    if ((screen.width <= 1024) && (screen.height <= 768))  {
        $(".content_left").height(a);
    }
    else {
        $(".content_left").height(m);
        $(".content_right").height(m);
    }
    $(window).resize(function(){
        window.location.reload();
    });
}

//时间格式转换为 [12-02]
function time(d){
    var de = d.replace(/-/g, '/');
    var dateday = new Date(de);
    var out =  "[" + ((parseInt(dateday.getMonth()) + 1) > 9 ? (dateday.getMonth() + 1): "0" + (dateday.getMonth() + 1)) +"-"+ ((dateday.getDate() > 9) ? dateday.getDate() : "0" + dateday.getDate())+"]";
    return out;
}

//返回时间格式为 2011-11-23
function daytime(d){
    var de = d.replace(/-/g, '/');
    var date = new Date(de);
    var during = date.getFullYear() + "-" + ((parseInt(date.getMonth()) + 1) > 9 ? (date.getMonth() + 1): "0" + (date.getMonth() + 1)) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());
    return during;
}

//返回时间格式为 2011.11.23
function timepoint(d){
     var de = d.replace(/-/g, '/');
    var date = new Date(de);
    var durings = date.getFullYear() + "." + ((parseInt(date.getMonth()) + 1) > 9 ? (date.getMonth() + 1): "0" + (date.getMonth() + 1)) + "." + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());
    return durings;
}

//返回时间格式 2011年11月23日
function yeartime(d){
     var de = d.replace(/-/g, '/');
    var date = new Date(de);
    var outyear = date.getFullYear() + "年" + ((parseInt(date.getMonth()) + 1) > 9 ? (date.getMonth() + 1): "0" + (date.getMonth() + 1)) + "月" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate())+'日';
    return outyear;
}

//转换为纯文本
function texthtml(b){
    var btn_text = $(b).removeAttr("style").text();
    return btn_text;
}

//转换为纯文本2
function rhtml(p){
    var dd=p.replace(/<\/?.+?>/g,""); 
    var dds=dd.replace(/&nbsp;/g,"");//dds为得到后的内容 
    return dds
}     

//获取json长度
function length(a){
    var jsonLength = a.length;
    return jsonLength;
}

//切割数组
function split(x){
    var arr = x.split(',');
    return arr;
}

//上传默认图片
function imgTp(p,imgName){
    if(p == ''|| p == null){
        p = 'upload/pic/'+ imgName +'.jpg';
        return p;
    }else{
        return p;
    };  
}
   