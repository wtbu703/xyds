$(document).ready(function(){

	 //培训通知
    var train_Inform = $('.trainInform');
    var trainInform_html = [];
    $.ajax({
        url:findUrl,
        type:"post",
        dataType:"json",
     
        async: false,
        success:function(data){
            $.each(data,function(i,n){   
            	var d = n.beginTime;
                var date = new Date(d);
                var out = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());                   
                trainInform_html.push('<div class="col-xs-12 col-sm-12 col-md-6">');
                trainInform_html.push('<h5><a href="traindetail.html">'+ n.name +'</a></h5>');
                trainInform_html.push('<a href="traindetail.html"><img class=" img-responsive" src="'+ n.picUrl +'" alt="培训通知"></a>');
                trainInform_html.push('<p><a href="traindetail.html">'+ n.content +'</a></p>');
                trainInform_html.push('</div>');
                trainInform_html.push('<div class="col-xs-12 col-sm-12 col-md-6">');
                trainInform_html.push('<ul class="list_train">');
                trainInform_html.push('<li><h5><a href="traindetail.html">'+ n.name +'</a></h5><span>'+ out +'</span></li>');
                trainInform_html.push('</ul>');
                trainInform_html.push('</div>');
                trainInform_html.push('</div>');
            });
            train_Inform.append(train_html.join(''));
        },
        error:function(){
            
        }
    });

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