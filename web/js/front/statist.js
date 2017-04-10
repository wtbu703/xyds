
//创建标注点并添加到地图中
function addMarker(points) {
    //循环建立标注点
    for(var i=0, pointsLen = points.length; i<pointsLen; i++) {
        var point = new BMap.Point(points[i].lng, points[i].lat); //将标注点转化成地图上的点
        var marker = new BMap.Marker(point); //将点转化成标注点
        map.addOverlay(marker);  //将标注点添加到地图上
        //添加监听事件
        (function() {
            var thePoint = points[i];
            marker.addEventListener("click",
                function() {
                showInfo(this,thePoint);
            });
         })();  
    }
}
function showInfo(thisMarker,point) {
    //获取点的信息
    var sContent = 
    '<ul style="margin:0 0 5px 0;padding:0.2em 0">'  
    +'<li style="line-height: 26px;font-size: 15px;">'  
    +'<span style="width: 50px;display: inline-block;">id：</span>' + point.id + '</li>'  
    +'<li style="line-height: 26px;font-size: 15px;">'  
    +'<span style="width: 50px;display: inline-block;">名称：</span>' + point.name + '</li>'  
    +'<li style="line-height: 26px;font-size: 15px;"><span style="width: 50px;display: inline-block;">查看：</span><a href="'+point.url+'">详情</a></li>'  
    +'</ul>';
    var infoWindow = new BMap.InfoWindow(sContent); //创建信息窗口对象
    thisMarker.openInfoWindow(infoWindow); //图片加载完后重绘infoWindow
}
function getBoundary(getcity){
	var bdary = new BMap.Boundary();
	bdary.get(getcity, function(rs){       //获取行政区域
		/*map.clearOverlays();*/        //清除地图覆盖物
		var count = rs.boundaries.length; //行政区域的点有多少个
		if (count === 0) {
			alert('未能获取当前输入行政区域');
			map.centerAndZoom(new BMap.Point(108.93976999999995, 34.341575), 8);
			return ;
		}
		var pointArray = [];
		for (var i = 0; i < count; i++) {
			var ply = new BMap.Polygon(rs.boundaries[i], {strokeWeight: 2, strokeColor: "#ff0000"}); //建立多边形覆盖物
			map.addOverlay(ply);  //添加覆盖物
			pointArray = pointArray.concat(ply.getPath());	
		}
		map.setViewport(pointArray);    //调整视野
		addlabel();
	});
}
function addlabel() {
	var pointArray = [
		new BMap.Point(121.716076,23.703799),
		new BMap.Point(112.121885,14.570616),
		new BMap.Point(123.776573,25.695422)];
	var optsArray = [{},{},{}];
	var labelArray = [];
	var contentArray = [
		"台湾是中国的！",
		"南海是中国的！",
		"钓鱼岛是中国的！"];
	for(var i = 0;i < pointArray.length; i++) {
		optsArray[i].position = pointArray[i];
		labelArray[i] = new BMap.Label(contentArray[i],optsArray[i]);
		labelArray[i].setStyle({
			color : "yellow",
			fontSize : "12px",
			height : "20px",
			lineHeight : "20px",
			fontFamily:"微软雅黑"
		});
		map.addOverlay(labelArray[i]);

	}
}

	var points = [  
	{"lng":108.50,"lat":33.45,"url":"http://www.baidu.com","id":1,"name":"p1"},  
	{"lng":107.50,"lat":33.98,"url":"http://www.mi.com","id":2,"name":"p2"},  
	{"lng":109.32,"lat":34.00,"url":"http://www.csdn.com","id":3,"name":"p3"}  
	]; 
	// 百度地图API功能
	var map = new BMap.Map("allmap");
	map.centerAndZoom(new BMap.Point(108.93976999999995, 34.341575), 8);  // 设置中心点
	map.setCurrentCity("西安");
	map.addControl(new BMap.MapTypeControl());   
	map.enableScrollWheelZoom(true); 
	map.disableDragging();//禁止拖拽
	map.disableScrollWheelZoom();//禁止放大缩小     
	addMarker(points);

	$("#province10").change(function(){getBoundary($("#province10 option:selected").html())})
	$("#city10").change(function(){getBoundary($("#province10 option:selected").html()+$("#city10 option:selected").html())})
	$("#district10").change(function(){getBoundary($("#province10 option:selected").html()+$("#city10 option:selected").html()+$("#district10 option:selected").html())})





  /* */
