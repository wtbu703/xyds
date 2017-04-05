
$(function () {

    Highcharts.setOptions({
        lang:{
            drillUpText:"返回 > {series.name}"
        }
    });

    var data =null;

    
		function getPoint(e){
			alert(e.point.name);
		}
    
       // 加载城市数据
    $.ajax({
        type: "GET",
        url: "http://data.hcharts.cn/jsonp.php?filename=GeoMap/json/shan_xi_1.geo.json",
        contentType: "application/json; charset=utf-8",
        dataType:'jsonp',
        crossDomain: true,
        success: function(json) {
            data = Highcharts.geojson(json);
										 
            $.each(data, function (i) {
													 
                this.value = i;
				this.events={};
				this.events.click=getPoint;
            });
            

           getCityMap("陕西省",data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {

        }
    });
});
function getCityMap(cname,data){
	$('.provincemap').highcharts('Map', {
			 credits:{
					href:"javascript:goHome()",
					enabled:false
            
        },
		 colorAxis: {
            min: 0,
            minColor: '#E6E7E8',
            maxColor: '#005645'
        },
        title : {
            text : cname
        },
			legend: {
					 	enabled: false
            
        },
			series : [{
            data : data,
            name: cname,
            dataLabels: {
                enabled: true,
							 
                format: '{point.name}'
            }
        }]
	});
}


