window.onload=function(){
	//创建地图
	var map = new BMap.Map("allmap");
	map.setDefaultCursor("default");
	map.enableScrollWheelZoom();//启动鼠标滚轮缩放地图
	map.enableKeyboard();//启动键盘操作地图
	var point = new BMap.Point(115.405112,30.79078);
	map.centerAndZoom(point, 14);
	
    $.ajax({
        url: serviceSiteUrl,
        type: "post",
        dataType: "json",
        async: "false",
        success: function (data) {
        	$.each(data,function(i,n){
    			var dian = new BMap.Point(n.longitude,n.latitude);
				var marker = new BMap.Marker(dian);  // 创建点
				map.addOverlay(marker); 
				
				var sContent="<img style='margin:4px' id='imgDemo' src='"+n.picUrl+"' width='300' height='100' title='站点图片'/>" + 
			    "<p style='margin:0;line-height:1.5;font-size:13px;'>"+'站点名称：'+ n.name +"</p>" + 
			    "<p style='margin:0;line-height:1.5;font-size:13px;'>"+'负责人：'+ n.chargeName +"</p>" + 
			    "<p style='margin:0;line-height:1.5;font-size:13px;'>"+'联系电话：'+ n.chargeMobile +"</p>" + 
			    "<p style='margin:0;line-height:1.5;font-size:13px;'>"+'地址：'+ n.address + "</p>" ; 
			    var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
			    marker.openInfoWindow(infoWindow,dian); //开启信息窗口
			    marker.addEventListener("mouseover", function(){          
			       this.openInfoWindow(infoWindow);
			    });
        	})
        },
        error:function(){
        }
    });
	
}