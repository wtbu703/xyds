$(document).ready(function(){

	//在线视频
    var onlineVideo = $('.online_video');
    var onlineVideo_html = [];
    $.ajax({
        url:findUrl,
        type:"post",
        dataType:"json",
        async: false,
        success:function(data){
            $.each(data,function(i,n){   
                onlineVideo_html.push('<div class="row">');
                onlineVideo_html.push('<div class="col-xs-12 col-sm-12 col-md-4 "><div class="list"><div class="row"><div class="col-xs-12">');
                onlineVideo_html.push('<a href="online_videodetail.html"><img class="img-responsive center-block" src="'+ n.picUrl +'" alt="图片" /></a>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('<div class="row list_text"><div class="col-xs-9">');
                onlineVideo_html.push('<h5>'+ n.name +'</h5><span>时长：'+ n.duration +'</span><p>'+ n.content +'</p>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('<div class="col-xs-3 list_btn"><a class="btn btn-default" href="online_videodetail.html" role="button">进入学习</a></div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
            });
            onlineVideo.append(onlineVideo_html.join(''));
        },
        error:function(){
            
        }
    });


})