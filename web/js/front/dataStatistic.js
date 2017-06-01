//把json数组转化成二维数组
function JsonToArr(jsonData,charvar){
    var len1 = jsonData.length;
    var len2 = charvar.length;
    var arr = new Array();
    for(j=0;j<len2;j++){
        var ar = new Array();
        for(i=0;i<len1;i++){
            if(j==0){
                ar.push(jsonData[i][charvar[j]]);
            }else{
                ar.push(parseFloat(jsonData[i][charvar[j]]));
            }

        }
        arr.push(ar);
    }
    return arr;
}
//直方图
function column(type,title,jsonData,xTitle,yTitle,toolTip){
    var charvar = ['months','number'];
    var arr = JsonToArr(jsonData,charvar);
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
            categories:arr[0],
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
        plotOptions: {
            column: {
                grouping: false,
                colorByPoint : true,
                shadow: false,
                borderWidth: 0
            }
        },
        colors:[
            '#c2fdff',
            '#f90301',
            '#febf07',
            '#fdff00',
            '#91d344',
            '#00b34f',
            '#00b1f3',
            '#0271bf',
            '#03205d',
            '#7030a0',
            '#bd524b',
            '#b18661'
        ],
        series: [{
            name: xTitle,
            data:arr[1],
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
//双y轴直方图
function doubleColumn(jsonData){
    var charvar = ['months','number'];
    var arr = JsonToArr(jsonData,charvar);
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
                                text += series[j].name + ":从 " + data[selectedmin].category + " 到 " + data[selectedmax - 1].category + ",总和:" + total + "人<br />";
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
        colors:[
            '#c2fdff',
            '#f90301',
            '#febf07',
            '#fdff00',
            '#91d344',
            '#00b34f',
            '#00b1f3',
            '#0271bf',
            '#03205d',
            '#7030a0',
            '#bd524b',
            '#b18661'
        ],
        subtitle: {
            text:'(选中月份即可查看累积培训人数和场次)',
            style:{
                color:"#ff0000"
            }
        },
        xAxis: {
            categories: arr[0]
        },
        yAxis: [{
            min: 0,
            title: {
                text: '人数'
            }
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true,
            pointFormat: '{series.name}培训: <b>{point.y}人</b><br/>'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                grouping: false,
                colorByPoint : true,
                shadow: false,
                borderWidth: 0
            }
        },
        series:[{
            name: '人数',
            data: arr[1],
            pointPadding: 0.3,
            pointPlacement: -0.2,
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
//覆盖率
function cover(jsonData){
    var charvar = ['months','townCover','villageCover'];
    var arr = JsonToArr(jsonData,charvar);
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
            categories: arr[0]
        },
        yAxis: {
            title: {
                text: '快递覆盖率(%)'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' %'
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
            data: arr[1],
            fillColor:'#78d6be'
        }, {
            name: '行政村',
            data: arr[2],
            fillColor:'#f5d368'
        }
        ],
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
//快递企业数量
function expressCompany(jsonData){
    var charvar = ['months','countyToVillage','villageToHamlet'];
    var arr = JsonToArr(jsonData,charvar);
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
            categories: arr[0]
        },
        yAxis :{
            title: {
                text: '快递企业数量(家)'
            }
        },
        tooltip :{
            shared: true,
            valueSuffix: ' 家'

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
            name: '县->乡',
            data: arr[1],
            fillColor:'#fb7b6c'
        }, {
            name: '乡->村',
            data: arr[2],
            fillColor:'#e4536d'
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
//快递收件量
function expressAdressee(jsonData){
    var charvar = ['months','receiveNum','sendNum'];
    var arr = JsonToArr(jsonData,charvar);
    $('.expressAdressee').highcharts({
        title :{
            text: '当月快递件数'
        },
        xAxis :{
            categories: arr[0]
        },
        yAxis:{
            title: {
                text: '快递件数(件)'
            }
        },
        tooltip :{
            pointFormat: '{series.name}: <b>{point.y}件</b><br/>.'

        },
        credits :{
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
            type: 'column',
            name: '快递收件量',
            data: arr[1],
            color:'#c0ffff'
        }, {
            type: 'column',
            name: '快递发件量',
            data: arr[2],
            color:'#7cac6e'
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
//企业网商
function netBussiness(jsonData){
    var charvar = ['months','companyNum','singleNum','newCompanyThisM','newSingleThisM'];
    var arr = JsonToArr(jsonData,charvar);
    $('.netBussiness').highcharts({
        chart :{
            type: 'column'
        },
        title :{
            text: '网商总数'
        },
        xAxis :{
            categories: arr[0]
        },
        yAxis :{
            allowDecimals: false,
            min: 0,
            title: {
                text: '网商总数（家）'
            }
        },
        plotOptions :{
            column: {
                stacking: 'normal'
            }
        },
        credits :{
            enabled: false
        },
        color:[
            ''
        ],
        series:[{
            name: '当月新增孵化数',
            data: arr[3],
            stack: 'male'
        }, {
            name: '企业网商',
            data: arr[1],
            stack: 'male',
            color:'#fc9446'
        }, {
            name: '当月新增孵化数',
            data: arr[4],
            stack: 'female',
            color:'#018091'
        }, {
            name: '个人网商',
            data: arr[2],
            stack: 'female',
            color:'#f45d3d'
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
//经济指标
function ecAll(jsonData){
    var charvar = ['year','GRP','socialConsumerTotal','disposableIncome','ecTurnover','netRetailSales'];
    var arr = JsonToArr(jsonData,charvar);

    $('.ecAll').highcharts({
        title :{
            text: '经济指标'
        },
        xAxis :{
            categories:arr[0]//数组
        },
        yAxis:{
            title: {
                text: '收入(元)'
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
            data: arr[1],//数组-
            color: '#007d93'
        }, {
            type: 'column',
            name: '零售总额',
            data: arr[2],
            color: '#f76959'
        },{
            type: 'column',
            name: '居民人均可支配收入',
            data: arr[3],
            color: '#014c6b'
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
//经济指标(二)
function ecBussiness(jsonData){
    var charvar = ['year','GRP','socialConsumerTotal','disposableIncome','ecTurnover','netRetailSales'];
    var arr = JsonToArr(jsonData,charvar);
    $('.ecBussiness').highcharts({
        title :{
            text: '经济指标'
        },
        xAxis :{
            categories: arr[0]
        },
        yAxis:{
            title: {
                text: '电商交易额(元)'
            }
        },
        tooltip :{
            pointFormat: '{series.name}: <b>{point.y}元</b><br/>.'

        },
        credits :{
            enabled: false
        },
        series:[{
            type: 'column',
            name: '电商交易额',
            data: arr[4],
            color: '#febc06'
        }, {
            type: 'column',
            name: '网络零售额',
            data: arr[5],
            color: '#e87c1f'
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
//个体工商户
function netPerson(jsonData){
    var charvar = ['year','individualHousehold','registeredCompany','onlineStore'];
    var arr = JsonToArr(jsonData,charvar);
    $('.netPerson').highcharts({
        title : {
            //图表标题
            text: '主体指标'
        },
        subtitle : {
            //副标题
            text: 'Source: runoob.com'
        },
        xAxis : {
            //设置X轴分类名称，数组，
            categories: arr[0]
        },
        yAxis : {
            //Y轴名称
            title: {
                text: '网店数量(个)'
            },
        },
        credits :{
            enabled: false
        },
        tooltip : {
            //数据点提示文字
            valueSuffix: '{series.name}: <b>{point.y}个</b><br/>'
        },

        legend : {
            //显示形式，支持水平horizontal和垂直vertical
            layout: 'vertical',
            //对齐方式。
            align: 'right',

            verticalAlign: 'middle',
            //图例边框宽度
            borderWidth: 0
        },
        series :  [
            {
                //显示数据列的名称。
                name: '个体工商户',
                //显示在图表中的数据列，可以为数组或者JSON格式的数据。
                data: arr[1],
                color:'#7ea97c'
            },
            {
                name: '注册企业数',
                data: arr[2],
                color:'#ddd321'
            },
            {
                name: '网店数量',
                data: arr[3],
                color:'#b9ffff'
            }
        ],
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
function basicStruct(jsonData){
    var charvar = ['year','ruralRoadMileage','internetAccess'];
    var arr = JsonToArr(jsonData,charvar);
    $('.basicStruct').highcharts({
        chart : {
            type: 'bar'
        },
        title : {
            text: '基础设施指标'
        },
        xAxis : {
            categories:arr[0],
            title: {
                text: null
            }
        },
        yAxis : {
            min: 0,
            title: {
                text: '已经完成设施',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip : {
            valueSuffix: ' {series.name}: <b>{point.y}</b><br/>'
        },
        plotOptions : {
            bar: {
                dataLabels: {
                    enabled: true
                }
            },
            series: {
                stacking: 'normal'
            }
        },
        legend : {
            layout: 'vertical',
            align: 'center',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits : {
            enabled: false
        },

        series: [{
            name: '农村公路里程数',
            data: arr[1],
            color:'#ebea1b'
        }, {
            name: '互联网接入数',
            data: arr[2],
            color:'#01b0f2'
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
//左上切换获取服务站点
function serviceTop(){
    var textdiv = $('.statistic_top');//定位到需要插入的DIV
    var html = [];//新建一个数组变量

    $.ajax({
        url: serviceSiteUrl,//后台给的
        type: "post",//发送方法
        dataType: "json",//返回的数据格式
        async: false,
        success:function(data){//如果成功即执行
            html.push('<div data-spy="scroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example">');
            html.push('<ul class="nav nav-pills nav-stacked nav_top" role="tablist">');
            $.each(data,function(i,n){//遍历返回的数据 
                {
                    if(i==0)
                    {
                        html.push('<li role="presentation" class="active"><a name="'+n.id+'" class="liA" onclick="getDataFromBackend(\''+n.id+'\')" role="tab" data-toggle="tab">'+n.name+'</a></li>');
                    }
                    else{
                        html.push('<li role="presentation"><a name="'+n.id+'" class="liA" onclick="getDataFromBackend(\''+n.id+'\')" role="tab" data-toggle="tab">'+n.name+'</a></li>');
                    }
                }
                //以原格式组装好数组
            });
            html.push('</ul>');
            html.push('</div>');
            textdiv.append(html.join(''));//把数组插入到已定位的DIV
        },

        error:function(){

        }
    });
}
//获取tab切换数据
function getDataFromBackend(siteId){
    var dataDiv = $('.statistic_right');
    var html1 = [];//新建一个数组变量
    dataDiv.html('');
    html1.push('<div class="tab-content">');
    html1.push('<div role="tabpanel" class="tab-pane active">');
    html1.push('<ul class="nav nav-tabs nav_right clearfix" role="tablist">');
    html1.push('<li role="presentation" class="active">');
    html1.push('<a href="#a" role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',1)">代买金额</a>');
    html1.push('</li>');
    html1.push('<li role="presentation"><a role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',2)">总订单数</a></li>');
    html1.push('<li role="presentation"><a role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',3)">代销金额 </a></li>');
    html1.push('<li role="presentation"><a role="tab" data-toggle="tab" onclick="generatePic(\''+siteId+'\',4)">总订单数</a></li>');
    html1.push('</ul>');
    html1.push('<div class="tab-content">');
    html1.push('<div role="tabpanel" class="tab-pane active" id="a"></div>');
    html1.push('</div>');
    html1.push('</div>');
    html1.push('</div>');
    dataDiv.append(html1.join(''));//把数组插入到已定位的DIV
    generatePic(siteId,1);
}
//生成图表
function generatePic(siteId,type){
    if(type == 1) {title = '代买金额';xTitle='月份';yTitle='代买金额（元）';toolTip='2017年当月代买金额: <b>{point.y:.1f} </b>';}
    else if(type == 2){title = '总订单数';xTitle='月份';yTitle='总订单数（个）';toolTip='2017年当月总订单数: <b>{point.y:.1f} </b>';}
    else if(type == 3){title = '代销金额';xTitle='月份';yTitle='代销金额（元）';toolTip='2017年当月代销金额: <b>{point.y:.1f} </b>';}
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
function picUnder(type){
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
            switch (type){
                case 1:
                    doubleColumn(data);//按月统计培训
                    break;
                case 2:cover(data);//快递覆盖率
                    break;
                case 3:expressCompany(data);//快递企业数量
                    break;
                case 4:expressAdressee(data);//快递收件量
                    break;
                case 5:
                    netBussiness(data);//企业网商
                    break;
                case 6: ecAll(data);//经济指标
                    ecBussiness(data);
                    break;
                case 7:netPerson(data);//个体工商户
                    break;
                case 8:
                    basicStruct(data);//基础设施
                    break;
                default:
                    return false;
            }
            //console.log(data);
        },

        error:function(){

        }
    });
}
$(document).ready(function(){
    serviceTop();
    picUnder(1);

    var Name = $(".liA").prop("name");
    generatePic(Name,1);

});

$(function(){
//调整位置
var rwidth = ($(window).width()-$('.container').width())/2-44;
//回到中心点位置调整
$('#back').css("right",rwidth+44);

//详情位置调整
$('.detailBox').css("left",rwidth+64);

})
