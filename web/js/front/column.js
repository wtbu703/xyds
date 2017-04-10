//柱形
function column(){
  $('#column').highcharts({
     chart: {
      type: 'column'
   },
    title: {
      text: '2017年  代买金额'   
   },    
    subtitle: {
      text: ''
   },
    xAxis: {
      type: 'category',
      labels: {
         rotation: -45,
         style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
         }
      }
   },
    yAxis:{
      min: 0,
      title: {
        text: '代买金额 (百万)'
      }
   },  
    tooltip: {
      pointFormat: '2017年代买金额: <b>{point.y:.1f} 百万</b>'
   },   
    credits: {
      enabled: false
   },
    series: [{
            name: '月份',
            data: [
                ['一月', 23.7],
                ['二月', 16.1],
                ['三月', 14.2],
                ['四月', 14.0],
                ['五月', 12.5],
                ['六月', 12.1],
                ['七月', 11.8],
                ['八月', 11.7],
                ['九月', 11.1],
                ['十月', 11.1],
                ['十一月', 10.5],
                ['十二月', 10.4],
            ],
            dataLabels: {
                enabled: false,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
   }], 
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    },    
  });
}
//双y轴直方图
function doubleColumn(){
  $('.doubleColumn').highcharts({
     chart : {
      type: 'column', 
      events: {
                 selection: function(event) { 
                  var text = "", label;  
                  if (event.xAxis) {  
                      var series = event.target.series;//获取所有数据列  
                      for(var j = 0; j < series.length; j++){  
                            if(series[j].visible){  
                              var total = 0;  
                              var data = series[j].data;  
                              var selectedmin = parseInt(event.xAxis[0].min < 0 ? -1 : event.xAxis[0].min) + 1;  
                              var selectedmax = parseInt(event.xAxis[0].max) + 1;  
                              for (var i = selectedmin; i < selectedmax; i++) {  
                                  total += data[i].y;  
                              }  
                              text += series[j].name + ":从 " + data[selectedmin].category + " 到 " + data[selectedmax - 1].category + ",总和:" + total + "<br />";                        
                            }  
                      }  
                      label = this.renderer.label(text, 80, 90)  
                                .attr({  
                                    fill: Highcharts.getOptions().colors[0],  
                                    padding: 10,  
                                    r: 5,  
                                    zIndex: 8  
                                })  
                                .css({  
                                    color: '#FFFFFF'  
                                })  
                                .add();  
                      //淡出效果,设置5秒后消失  
                      setTimeout(function() {  
                          label.fadeOut();  
                      }, 5000);  
                  }  
              } 
          },  
          zoomType: 'x'//放大方式,x表示横向放大 
    }, 
    title : {
      text: '按月统计培训'   
     },
    
      subtitle: {
        text:'(选中月份即可查看累积培训人数和场次)',
        style:{
          color:"#ff0000"
        }
     }, 
      xAxis: {
        categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
     },
      yAxis: [{
           min: 0,
           title: {
              text: '人数'
           }
        }, {
           title: {
              text: '场次'
           },
           opposite: true
     }],
      legend: {
        shadow: false
     },
      tooltip: {
        shared: true
     },
      credits: {
        enabled: false
     },
      plotOptions: {
        column: {
           grouping: false,
           shadow: false,
           borderWidth: 0
        }
     },
    series:[{
     name: '人数',
          color: 'rgba(165,170,217,1)',
          data: [150, 73, 20,50,20,51,65,65,98,96,30,150],
          pointPadding: 0.3,
          pointPlacement: -0.2,

          
      }, {
          name: '场次',
          color: 'rgba(126,86,134,.9)',
          data: [140, 90, 40,50,20,51,65,65,98,96,30,150],
          pointPadding: 0.3,
          pointPlacement: 0,
          yAxis: 1
      }], 
  });   
}
//覆盖率
function cover(){
   $('.cover').highcharts({
       chart: {
      type: 'areaspline'     
     },
     title: {
        text: '快递覆盖率'   
     },
     subtitle: {
        style: {
           position: 'absolute',
           right: '0px',
           bottom: '10px'
        }
     },
     legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
     },
     xAxis: {
        categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']      
     },
     yAxis: {
        title: {
           text: '快递覆盖率(%)'
        }      
     },
     tooltip: {
        pointFormat: '{series.name}快递覆盖率: <b>{point.y}%</b><br/>'
     },
     credits: {
         enabled: false
     },
     plotOptions: {
        areaspline: {
           fillOpacity: 0.5
        }
     },   
     series: [{
          name: '乡村',
              data: [3, 4, 3, 5, 4, 10, 12,3, 4, 3, 10, 12]
          }, {
              name: '行政村',
              data: [1, 3, 4, 3, 3, 5, 4,5,6,12,2,8]
        }
     ],    
     });
}
//快递企业数量
function expressCompany(){
  $('.expressCompany').highcharts({
     chart :{
      type: 'areaspline'     
   },
    title :{
      text: '快递企业数量'   
   }, 
    subtitle :{
      style: {
         position: 'absolute',
         right: '0px',
         bottom: '10px'
      }
   },
    legend :{
      layout: 'vertical',
      align: 'left',
      verticalAlign: 'top',
      x: 150,
      y: 100,
      floating: true,
      borderWidth: 1,
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']      
   },
    yAxis :{
      title: {
         text: '快递企业数量(百万)'
      }      
   },
    tooltip :{
      pointFormat: '{series.name}快递企业数量: <b>{point.y}百万</b><br/>.'

   },
    credits :{
       enabled: false
   },
    plotOptions :{
      areaspline: {
         fillOpacity: 0.5
      }
   },   
    series:[{
        name: '县',
            data: [3, 4, 3, 5, 4, 10, 12,3, 4, 3, 10, 12]
        }, {
            name: '乡',
            data: [1, 3, 4, 3, 3, 5, 4,5,6,12,2,8]
      },{
            name: '村',
            data: [5,8, 4, 3, 3, 5, 4,5,6,12,2,8]
      }
   ],      
  });  
}
function expressAdressee(){
  $('.expressAdressee').highcharts({
    title :{
      text: '当月快递件数'   
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
   },
    yAxis:{
      title: {
         text: '快递件数(万件)'
      }
    },
    tooltip :{
      pointFormat: '{series.name}: <b>{point.y}万件</b><br/>.'

   },
   credits :{
       enabled: false
   },
    series:[{
        type: 'column',
            name: '快递收件量',
            data: [3, 2, 1, 3, 4,6,5,9,8,7,4,6]
        }, {
            type: 'column',
            name: '快递发件量',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        }, {
            type: 'spline',
            name: '平均值',
            data: [2.5, 2.5,2.5,5,5,3.5,4,7,6,6,5,6.5],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],     
  });
}
function netBussiness(){
  $('.netBussiness').highcharts({
    title :{
      text: '网商总数'   
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
   },
    yAxis:{
      title: {
         text: '网商总数(万家)'
      }
    },
    tooltip :{
      pointFormat: '{series.name}: <b>{point.y}万家</b><br/>.'

   },
   credits :{
       enabled: false
   },
    series:[{
        type: 'column',
            name: '企业网商总数',
            data: [3, 2, 1, 3, 4,6,5,9,8,7,4,6]
        }, {
            type: 'column',
            name: '个人网商总数',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'column',
            name: '当月新孵化数企业  个人',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'spline',
            name: '平均值',
            data: [2.5, 2.5,2.5,5,5,3.5,4,7,6,6,5,6.5],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],     
  });
}
function ecAll(){
  $('.ecAll').highcharts({
    title :{
      text: '经济指标'   
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
   },
    yAxis:{
      title: {
         text: '收入(万元)'
      }
    },
    tooltip :{
      pointFormat: '{series.name}: <b>{point.y}万元</b><br/>.'

   },
   credits :{
       enabled: false
   },
    series:[{
        type: 'column',
            name: '生产总值',
            data: [3, 2, 1, 3, 4,6,5,9,8,7,4,6]
        }, {
            type: 'column',
            name: '零售总额',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'column',
            name: '居民人均可支配收入',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'spline',
            name: '平均值',
            data: [2.5, 2.5,2.5,5,5,3.5,4,7,6,6,5,6.5],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],     
  });
}
function ecBussiness(){
  $('.ecBussiness').highcharts({
    title :{
      text: '经济指标'   
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
   },
    yAxis:{
      title: {
         text: '电商交易额(万元)'
      }
    },
    tooltip :{
      pointFormat: '{series.name}: <b>{point.y}万元</b><br/>.'

   },
   credits :{
       enabled: false
   },
    series:[{
        type: 'column',
            name: '电商交易额',
            data: [3, 2, 1, 3, 4,6,5,9,8,7,4,6]
        }, {
            type: 'column',
            name: '网络零售额',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'spline',
            name: '平均值',
            data: [2.5, 2.5,2.5,5,5,3.5,4,7,6,6,5,6.5],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],     
  });
}
function netPerson(){
  $('.netPerson').highcharts({
    title :{
      text: '主体指标'   
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
   },
    yAxis:{
      title: {
         text: '网店数量(万家)'
      }
    },
    tooltip :{
      pointFormat: '{series.name}: <b>{point.y}万家</b><br/>.'

   },
   credits :{
       enabled: false
   },
    series:[{
        type: 'column',
            name: '个体工商户',
            data: [3, 2, 1, 3, 4,6,5,9,8,7,4,6]
        }, {
            type: 'column',
            name: '网店数量',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'column',
            name: '注册企业数',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'spline',
            name: '平均值',
            data: [2.5, 2.5,2.5,5,5,3.5,4,7,6,6,5,6.5],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],     
  });
}
function basicStruct(){
  $('.basicStruct').highcharts({
    title :{
      text: '基础设施指标'   
   },
    xAxis :{
      categories: ['一月', '二月', '三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
   },
    yAxis:{
      title: {
         text: '已经完成设施(万家)'
      }
    },
    tooltip :{
      pointFormat: '{series.name}: <b>{point.y}万家</b><br/>.'

   },
   credits :{
       enabled: false
   },
    series:[{
        type: 'column',
            name: '农村公路里程数',
            data: [3, 2, 1, 3, 4,6,5,9,8,7,4,6]
        }, {
            type: 'column',
            name: '网联网接入数',
            data: [2, 3, 5, 7, 6,1,3,5,4,5,6,7]
        },{
            type: 'spline',
            name: '平均值',
            data: [2.5, 2.5,2.5,5,5,3.5,4,7,6,6,5,6.5],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],     
  });
}
$(document).ready(function() {  

  column();
  doubleColumn();
  cover();
  expressCompany();
  expressAdressee();
  netBussiness();
  ecAll();
  ecBussiness();
  netPerson();
  basicStruct();
});

