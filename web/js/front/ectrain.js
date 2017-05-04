function train_Inform(){
    var train_Inform = $('.trainInform');
    var trainInform_html = [];
    $.ajax({
        url:ectrainAllUrl,
        type:"post",
        dataType:"json",
     
        async: false,
        success:function(data){
            $.each(data,function(i,n){   
                var d = n.beginTime;
                var date = new Date(d);
                var content = rhtml(n.content);
                var out = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate());                   
                if(i == 0)
                {
                    trainInform_html.push('<div class="col-xs-12 col-sm-12 col-md-6">');
                    trainInform_html.push('<h5><a target="_Blank" href="'+detailUrl+'&id='+n.id+'">'+ n.name +'</a></h5>');
                    trainInform_html.push('<a target="_Blank" href="'+detailUrl+'&id='+n.id+'"><img class=" img-responsive" src="'+ n.thumbnailUrl +'" alt="培训通知"></a>');
                    trainInform_html.push('<p><a target="_Blank" href="'+detailUrl+'&id='+n.id+'">'+ content +'</a></p>');
                    trainInform_html.push('</div>');
                    trainInform_html.push('<div class="col-xs-12 col-sm-12 col-md-6">');
                    trainInform_html.push('<ul class="list_train">');
                }
                
                trainInform_html.push('<li><h5><a target="_Blank" href="'+detailUrl+'&id='+n.id+'">'+ n.name +'</a></h5><span>'+ out +'</span></li>');
               
            });
            trainInform_html.push('</ul>');
            trainInform_html.push('</div>');
            trainInform_html.push('</div>');
            train_Inform.append(trainInform_html.join(''));
        },
        error:function(){
            
        }
    });
}
function onlineVideo(){
    var onlineVideo = $('.online_video');
    var onlineVideo_html = [];
    $.ajax({
        url:videoUrl,
        type:"post",
        dataType:"json",
        async: false,
        success:function(data){
            onlineVideo_html.push('<div class="row">');
            $.each(data,function(i,n){   
                
                onlineVideo_html.push('<div class="col-xs-12 col-sm-12 col-md-4 "><div class="list"><div class="row"><div class="col-xs-12">');
                onlineVideo_html.push('<a target="_blank" href="'+videoDetailUrl+'&videoId='+n.id+'"><img class="img-responsive center-block" src="'+ n.picUrl +'" alt="图片" /></a>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('<div class="row list_text"><div class="col-xs-9">');
                onlineVideo_html.push('<h5>'+ n.name +'</h5><p>'+ n.content +'</p>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('<div class="col-xs-3 list_btn"><a target="_blank" class="btn btn-default" href="'+videoDetailUrl+'&videoId='+n.id+'" role="button">进入学习</a></div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                onlineVideo_html.push('</div>');
                
            });
            onlineVideo_html.push('</div>');
            onlineVideo.append(onlineVideo_html.join(''));
        },
        error:function(){
            
        }
    });

}
$(document).ready(function(){

	 //培训通知
    train_Inform();

    //在线视频
    onlineVideo();


});