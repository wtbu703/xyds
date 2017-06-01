$(function(){
	//创建地图
	var map = new BMap.Map("allmap");
	map.setDefaultCursor("default");
	map.enableKeyboard();//启动键盘操作地图
	var point = new BMap.Point(107.55214,33.22866); //陕西省汉中市洋县
	map.centerAndZoom(point, 14);
	var infoBoxTemp = null;
	var detailBox = $('.detailBox');

    $.ajax({
        url: serviceSiteUrl,
        type: "POST",
        dataType: "json",
        async: "false",
        success: function (data) {
        	$.each(data,function(i,n){
    			var dian = new BMap.Point(n.longitude,n.latitude);
				var marker = new BMap.Marker(dian);  // 创建点
				map.addOverlay(marker);
				var le = data.length-1; 
				var first_point = new BMap.Point(data[le].longitude,data[le].latitude);
				var marker1 = new BMap.Marker(first_point);		
   				
				//创建信息窗
			    var html = ["<div class='foWindow'></div><h5 class='qw'>"+n.name+"</h5><ul class='zhanzhang'><li>站长："+n.chargeName+"</li><li>电话："+n.chargeMobile+"</li></ul><button class='detail'>详细信息</button>"];
			    //设置信息窗参数
				var infoBox = new BMapLib.InfoBox(map,html.join(""),{
					 boxStyle:{
					    background:"url('images/images_servicesite/tipbox.png') no-repeat center top"
					    ,width: "240px"
					    ,height: "194px"
					}
					    ,closeIconMargin: "0px 0px 0 0"
					    ,closeIconUrl:'images/images_servicesite/close.png'
					    ,enableAutoPan: true
					    ,align: INFOBOX_AT_TOP
				});

				//打开网页时打开一个窗口
				infoBox.open(marker1);
				//打开左侧信息栏
				$('.detail').click(function(){
					detailBox.css('display','block');
					detailBox.html('<h1>县域电子商务服务站点</h1><img class="serviceMap" src="'+n.picUrl+'" alt="服务站点图"><h2>'+n.name+'</h2><ul class="pointList"><li>站长：'+n.chargeName+'</li><li>电话：'+n.chargeMobile+'</li><li>类型：'+n.countyType+'</li><li>编码：'+n.code+'</li></ul><hr class="serviceLine" /><div class="address"><img src="images/images_servicesite/location.png" alt="标注图"><span>'+n.address+'</span></div>');
						
				});	
					
				
				marker.addEventListener("mouseover", function(){ 
					
					//打开新窗口时关闭之前窗口
					if(infoBoxTemp){
						infoBoxTemp.close(); 
					}
					infoBoxTemp = infoBox;

					infoBox.open(marker);	

					detailBox.css('display','none')

					
					//打开左侧信息栏
					$('.detail').click(function(){
						detailBox.html('<h1>县域电子商务服务站点</h1><img class="serviceMap" src="'+n.picUrl+'" alt="服务站点图"><h2>'+n.name+'</h2><ul class="pointList"><li>站长：'+n.chargeName+'</li><li>电话：'+n.chargeMobile+'</li><li>类型：'+n.countyType+'</li><li>编码：'+n.code+'</li></ul><hr class="serviceLine" /><div class="address"><img src="images/images_servicesite/location.png" alt="标注图"><span>'+n.address+'</span></div>');
						detailBox.css('display','block');
					});	

				});		
				//点击窗口外的地方关闭窗口
				map.addEventListener("click", function(){ 
					map.enableScrollWheelZoom();//启动鼠标滚轮缩放地图
					
				    infoBox.close();   
				    detailBox.css('display','none');
				    detailBox.html("");
				}); 
		
        	})
        	
        	
        },
        error:function(){
        }
    });

    //返回中心点
    $('#back').click(function(){
    	map.centerAndZoom(point, 14);
    })

   

				
})

