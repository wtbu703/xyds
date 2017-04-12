//把json数组转化成二维数组
function changeArr(jsonData){
    var json = eval(jsonData);
    var arr2 = '[';
    for(i=0;i<json.length;i++){
        var temp="['{0}',{1}]";
        arr2+=temp.replace("{0}",json[i].months).replace("{1}",json[i].number)+',';
    }
    arr2+=']';
    return {arr2};
    //alert(arr2);
}
//图表
function column(type,title,jsonData,xTitle,yTitle,toolTip){
    var source = changeArr(jsonData);
    $("#a").highcharts({
     chart: {
      type: type
   },
    title: {
      text: title   
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
        text: yTitle
      }
   },  
    tooltip: {
      pointFormat: toolTip
   },   
    credits: {
      enabled: false
   },
    series: [{
            name: xTitle,
            data:eval(source.arr2),
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
    }
  });
}
//左上切换
function serviceTop(){
    var textdiv = $('.statistic_top');//定位到需要插入的DIV
    var html = [];//新建一个数组变量
    
    $.ajax({
        url: serviceSiteUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            html.push('<ul class="nav nav-pills nav-stacked nav_top" role="tablist">');
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    html.push('<li role="presentation"><a onclick="getDataFromBackend(\''+n.id+'\')" role="tab" data-toggle="tab">'+n.name+'</a></li>');
                }
                //以原格式组装好数组
            });
            html.push('</ul>');

            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },
    
        error:function(){
            
        }
    });
}
function getDataFromBackend(siteId){
    var textdiv = $('.statistic_right');
    var html = [];//新建一个数组变量
    textdiv.html('');
    html.push('<div class="tab-content">');
    html.push('<div role="tabpanel" class="tab-pane active" id="a">');
    html.push('<ul class="nav nav-tabs nav_right clearfix" role="tablist">');
    html.push('<li role="presentation" class="active">');
    html.push('<a href="#a" role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',1)">代买金额</a>');
    html.push('</li>');
    html.push('<li role="presentation"><a href="#b" role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',2)">总订单数</a></li>');
    html.push('<li role="presentation"><a href="#c" role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',3)">代销金额 </a></li>');
    html.push('<li role="presentation"><a href="#d" role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',4)">总订单数</a></li>');
    html.push('</ul>');
    html.push('<div class="tab-content">');
    html.push('<div role="tabpanel" class="tab-pane active" id="a"></div>');
    html.push('</div>');
    html.push('</div>');
    html.push('</div>');
    textdiv.append(html.join(''));//把数组插入到已定位的DIV
}

function generatePic(siteId,type){
    if(type == 1) {title = '代买金额';xTitle='月份';yTitle='代买金额（万元）';toolTip='2017年当月代买金额: <b>{point.y:.1f} </b>';}
    else if(type == 2){title = '总订单数';xTitle='月份';yTitle='总订单数（万）';toolTip='2017年当月总订单数: <b>{point.y:.1f} </b>';}
    else if(type == 3){title = '代销金额';xTitle='月份';yTitle='代销金额（万元）';toolTip='2017年当月代销金额: <b>{point.y:.1f} </b>';}
    else {title = '总订单数';xTitle='月份';yTitle='总订单数（万）';toolTip='2017年当月总订单数: <b>{point.y:.1f} </b>';}
    $.ajax({
        url: generatePicUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        data:'siteId='+siteId+'&type='+type,
        success:function(data){//如果成功即执行
            column('column',title,data,xTitle,yTitle,toolTip);//生成图表
        },
        error:function(){

        }
    });
}

//下面切换内容
function picUnder(type=1){
    var finalUrl;
    switch (type){
        case 1:
            finalUrl = ectrainEnterUrl;//培训报名
            break;
        case 2:
        case 3:
        case 4:
            finalUrl = logisticsBuildUrl;//物流建设
            break;
        case 5:
            finalUrl = ectrainInfoUrl;//培训情况
            break;
        case 6:
        case 7:
        case 8:
            finalUrl = countyEconomicUrl;//县域经济
            break;
        default:
            return false;
    }
    $.ajax({
        url: finalUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        data:"type="+type,
        async: false,
        success:function(data){//如果成功即执行

        },
    
        error:function(){
            
        }
    });
}
$(document).ready(function(){
    serviceTop();
});