//柱形
$(document).ready(function() {  
   var chart = {
      type: 'column'
   };
   var title = {
      text: '2014 年全球最大人口城市排名'   
   };    
   var subtitle = {
      text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
   };
   var xAxis = {
      type: 'category',
      labels: {
         rotation: -45,
         style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
         }
      }
   };
   var yAxis ={
      min: 0,
      title: {
        text: 'Population (millions)'
      }
   };  
   var tooltip = {
      pointFormat: '2008 年人口: <b>{point.y:.1f} 百万</b>'
   };   
   var credits = {
      enabled: false
   };
   var series= [{
            name: 'Population',
            data: [
                ['Shanghai', 23.7],
                ['Lagos', 16.1],
                ['Instanbul', 14.2],
                ['Karachi', 14.0],
                ['Mumbai', 12.5],
                ['Moscow', 12.1],
                ['Sao Paulo', 11.8],
                ['Beijing', 11.7],
                ['Guangzhou', 11.1],
                ['Delhi', 11.1],
                ['Shenzhen', 10.5],
                ['Seoul', 10.4],
                ['Jakarta', 10.0],
                ['Kinshasa', 9.3],
                ['Tianjin', 9.3],
                ['Tokyo', 9.0],
                ['Cairo', 8.9],
                ['Dhaka', 8.9],
                ['Mexico City', 8.9],
                ['Lima', 8.9]
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
   }]; 
   var responsive = {
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
        };    
      
   var json = {};   
   json.chart = chart; 
   json.title = title;   
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;   
   json.tooltip = tooltip;   
   json.credits = credits;
   json.series = series;
   json.responsive =responsive;
   $('#colume').highcharts(json);
  
});

//气泡型 
$(document).ready(function() {  
   var chart = {
      type: 'bubble',
      zoomType: 'xy'
   };
   var title = {
      text: 'Highcharts Bubbles'   
   };   
   var series= [{
            data: [[97, 36, 79], [94, 74, 60], [68, 76, 58], [64, 87, 56], [68, 27, 73], [74, 99, 42], [7, 93, 87], [51, 69, 40], [38, 23, 33], [57, 86, 31]]
        }, {
            data: [[25, 10, 87], [2, 75, 59], [11, 54, 8], [86, 55, 93], [5, 3, 58], [90, 63, 44], [91, 33, 17], [97, 3, 56], [15, 67, 48], [54, 25, 81]]
        }, {
            data: [[47, 47, 21], [20, 12, 4], [6, 76, 91], [38, 30, 60], [57, 98, 64], [61, 17, 80], [83, 60, 13], [67, 78, 75], [64, 12, 10], [30, 77, 82]]
      }
   ]; 
   var credits ={
      enabled:false
   } ;  
   var responsive = {
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
        }; 
      
   var json = {};   
   json.chart = chart; 
   json.title = title;     
   json.series = series;   
   json.credits =credits;
   json.responsive = responsive;
   $('.bubble').highcharts(json);
  
});
//3d型
$(document).ready(function() {  
   var chart = {      
      type: 'column',
      marginTop: 80,
      marginRight: 40,
      options3d: {
         enabled: true,
         alpha: 15,
         beta: 15,
         viewDistance: 25,
         depth: 40
      }
   };
   var title = {
      text: '水果总消费量，按类别分组'   
   };   
   var xAxis = {
      categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
   };
   var yAxis = {
      allowDecimals: false,
      min: 0,
      title: {
         text: '水果数量'
      }
   };
   var responsive = {
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
        };  

   var tooltip = {
      headerFormat: '<b>{point.key}</b><br>',
      pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
   };

   var plotOptions = {
      column: {
         stacking: 'normal',
         depth: 40
      }
   };   
   var series= [{
         name: 'John',
            data: [5, 3, 4, 7, 2],
            stack: 'male'
         }, {
            name: 'Joe',
            data: [3, 4, 4, 2, 5],
            stack: 'male'
         }, {
            name: 'Jane',
            data: [2, 5, 6, 2, 1],
            stack: 'female'
         }, {
            name: 'Janet',
            data: [3, 0, 4, 4, 3],
            stack: 'female'
   }]; 
   var credits = {
       enabled: false
   };    
      
   var json = {};   
   json.chart = chart; 
   json.title = title;      
   json.xAxis = xAxis; 
   json.yAxis = yAxis; 
   json.tooltip = tooltip; 
   json.plotOptions = plotOptions; 
   json.series = series;   
   json.credits =credits;
   json.responsive = responsive;
   $('#3d').highcharts(json);
});
/*直线型*/
$(document).ready(function() {  
   var title = {
      text: 'Combination chart'   
   };
   var xAxis = {
      categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
   };
   var labels = {
      items: [{
         html: '水果消费',
            style: {
               left: '50px',
               top: '18px',
               color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
      }]
   };
   var credits = {
       enabled: false
   };
   
   var series= [{
        type: 'column',
            name: 'Jane',
            data: [3, 2, 1, 3, 4]
        }, {
            type: 'column',
            name: 'John',
            data: [2, 3, 5, 7, 6]
        }, {
            type: 'column',
            name: 'Joe',
            data: [4, 3, 3, 9, 0]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33, 3.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'pie',
            name: '总消费',
            data: [{
                name: 'Jane',
                y: 13,
                color: Highcharts.getOptions().colors[0] // Jane 的颜色
            }, {
                name: 'John',
                y: 23,
                color: Highcharts.getOptions().colors[1] // John 的颜色
            }, {
                name: 'Joe',
                y: 19,
                color: Highcharts.getOptions().colors[2] // Joe 的颜色
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: true
            }
      }
   ]; 
   var responsive = {
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
        };     
      
   var json = {};   
   json.title = title;   
   json.xAxis = xAxis;
   json.labels = labels;  
   json.series = series;
   json.credits = credits;
   json.responsive = responsive;
   $('#line_chart').highcharts(json);  
});
/*圆形*/
$(document).ready(function() {  
   var chart = {
       plotBackgroundColor: null,
       plotBorderWidth: null,
       plotShadow: false
   };
   var title = {
      text: '电子商务园'   
   };      
   var tooltip = {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
   };
   var plotOptions = {
      pie: {
         allowPointSelect: true,
         cursor: 'pointer',
         dataLabels: {
            enabled: false,
            format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
            style: {
               color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
            }
         }
      }
   };
   var series= [{
      type: 'pie',
      name: 'Browser share',
      data: [
         ['Firefox',   45.0],
         ['IE',       26.8],
         {
            name: 'Chrome',
            y: 12.8,
            sliced: true,
            selected: true
         },
         ['Safari',    8.5],
         ['Opera',     6.2],
         ['Others',   0.7]
      ]
   }];  
   var credits = {
       enabled: false
   };  
   var responsive = {
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
        };
      
   var json = {};   
   json.chart = chart; 
   json.title = title;     
   json.tooltip = tooltip;  
   json.series = series;
   json.credits = credits;
   json.plotOptions = plotOptions;
   json.responsive =responsive;
   $('.pie').highcharts(json);  
});
/*曲线*/
$(document).ready(function() {  
   var chart = {
      type: 'areaspline'     
   };
   var title = {
      text: 'Average fruit consumption during one week'   
   }; 
   var subtitle = {
      style: {
         position: 'absolute',
         right: '0px',
         bottom: '10px'
      }
   };
   var legend = {
      layout: 'vertical',
      align: 'left',
      verticalAlign: 'top',
      x: 150,
      y: 100,
      floating: true,
      borderWidth: 1,
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
   };
   var xAxis = {
      categories: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']      
   };
   var yAxis = {
      title: {
         text: 'Fruit units'
      }      
   };
   var tooltip = {
       shared: true,
       valueSuffix: ' units'
   };
   var credits = {
       enabled: false
   };
   var plotOptions = {
      areaspline: {
         fillOpacity: 0.5
      }
   };   
   var series= [{
        name: 'John',
            data: [3, 4, 3, 5, 4, 10, 12]
        }, {
            name: 'Jane',
            data: [1, 3, 4, 3, 3, 5, 4]
      }
   ];  
   var responsive = {
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
        };  
      
   var json = {};   
   json.chart = chart; 
   json.title = title; 
   json.subtitle = subtitle; 
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.legend = legend;   
   json.plotOptions = plotOptions;
   json.credits = credits;
   json.series = series;
   json.responsive = responsive;
   $('.profile').highcharts(json);
  
});
/*对数*/
$(document).ready(function() {  
   var title = {
      text: '对数实例(runoob.com)'   
   };
   var xAxis = {
      tickInterval: 1
   };
   var yAxis = {
      type: 'logarithmic',
      minorTickInterval: 0.1
   };
   var tooltip = {
      headerFormat: '<b>{series.name}</b><br>',
      pointFormat: 'x = {point.x}, y = {point.y}'
   };
   var plotOptions = {
      spline: {
         marker: {
            enabled: true
         }
      }
   };
   var series= [{
         name: 'data',
         data: [1, 2, 4, 8, 16, 32, 64, 128, 256, 512],
         pointStart: 1
      }
   ]; 
   var credits = {
      enabled:false
   } ;
   var responsive = {
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
        };  
      
   var json = {};   
   json.title = title;   
   json.tooltip = tooltip;
   json.xAxis = xAxis;
   json.yAxis = yAxis;  
   json.series = series;
   json.credits = credits;
   json.plotOptions = plotOptions;
   json.responsive = responsive;
   $('.spline').highcharts(json);
  
});
/*待标记的曲线图*/
$(document).ready(function() {  
   var chart = {
      type: 'spline'      
   }; 
   var title = {
      text: 'Monthly Average Temperature'   
   };
   var subtitle = {
      text: 'Source: WorldClimate.com'
   };
   var xAxis = {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
         'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
   };
   var yAxis = {
      title: {
         text: 'Temperature'
      },
      labels: {
         formatter: function () {
            return this.value + '\xB0';
         }
      },
      lineWidth: 2
   };
   var tooltip = {
      crosshairs: true,
      shared: true
   };
   var plotOptions = {
      spline: {
         marker: {
            radius: 4,
            lineColor: '#666666',
            lineWidth: 1
         }
      }
   };
   var series= [{
         name: 'Tokyo',
         marker: {
            symbol: 'square'
         },
         data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, {
            y: 26.5,
            marker: {
               symbol: 'url(http://www.highcharts.com/demo/gfx/sun.png)'
            }
         }, 23.3, 18.3, 13.9, 9.6]
      }, {
         name: 'London',
         marker: {
            symbol: 'diamond'
         },
         data: [{
            y: 3.9,
            marker: {
               symbol: 'url(http://www.highcharts.com/demo/gfx/snow.png)'
            }
         }, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
      }
   ];
   var credits = {
      enabled:false
   };
   var responsive = {
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
        };      
      
   var json = {};
   json.chart = chart;
   json.title = title;
   json.subtitle = subtitle;
   json.tooltip = tooltip;
   json.xAxis = xAxis;
   json.yAxis = yAxis;  
   json.series = series;
   json.credits = credits;
   json.plotOptions = plotOptions;
   json.responsive = responsive;
   $('.mark').highcharts(json);
  
});