<?
$this->title = "数据统计";
?>
	<style>
		.foWindow{
			height:40px;
		}
		.qw{
			text-align: center;
			font-size: 16px;
			font-family: '微软雅黑';
			color: #d52c40;
		}
		.zhanzhang{
			list-style: none;
			font-size: 14px;
			font-family: '宋体';
			color: #363636;
		}
		
		.detail{
			border:0px solid #fff;
			margin:0 auto;
			color:#fff;
			font-size: 12px;
			font-family: '宋体';
			background-color: #eb304d;
			width: 70px;
			height: 23px;
			border-radius: 3px;
			margin-left: 85px;
		}
		
		/* //左侧大盒子 */

		#back{
			position: absolute;
			bottom:1020px;
			/* left:75%; */ 
			z-index: 99999;
			border:2px solid #fff;
			color:#fff;
			font-size: 12px;
			font-family: '宋体';
			background-color: #eb304d;
			border-radius: 3px;		
		}
		.boxC{
			position:relative;
		}
		.detailBox{
			position: absolute;
			bottom:680px;
			/* left:21%;   */
			width: 265px;
			height: 355px;
			background: #fff;
			-webkit-box-shadow:0 0 20px rgba(192, 184, 186, .5);  
	  		-moz-box-shadow:0 0 20px rgba(192, 184, 186, .5);  
	 		box-shadow:0 0 20px rgba(192, 184, 186, .5); 
	 		display: none; 
		}
		.detailBox h2{
			text-align: left;
			font-size: 16px;
			font-family: '微软雅黑';
			color: #d52c40;
			padding-left:12px; 
			margin-top: 10px;
		}
		.pointList{
			padding-left:12px; 
			list-style: none;
		}
		.pointList li{
			margin: 3px auto;
		}
		.detailBox h1{
			font-size: 16px;
			font-weight: 700;
			text-align: center;
			padding-top: 13px;
			padding-bottom: 12px;
			margin:0px;
		}
		.serviceLine{
			margin:0px 12px;
			margin-bottom: 3px;
		}
		.address{
			padding-left:12px; 
		}
		.detailBox .address img{
			padding-right:5px; 
		}
		.detailBox .serviceMap{
			width:265px;
			height:137px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="css/css/statistic.css">
	<script>
		var serviceSiteUrl = "<?=Yii::$app->urlManager->createUrl('service-site/ajax')?>";
		var generatePicUrl = "<?=Yii::$app->urlManager->createUrl('service-site/generate-pic')?>";
		var countyEconomicUrl = "<?=Yii::$app->urlManager->createUrl('county-economic/ajax')?>";//县域经济
		var ectrainInfoUrl = "<?=Yii::$app->urlManager->createUrl('ectrain-info/ajax')?>";//培训情况
		var logisticsBuildUrl = "<?=Yii::$app->urlManager->createUrl('logistics-build/ajax')?>";//物流建设
		var ectrainEnterUrl = "<?=Yii::$app->urlManager->createUrl('ectrain-enter/ajax')?>";//培训报名
		var serviceSiteUrl = "<?=Yii::$app->urlManager->createUrl('service-site/service-site')?>";//地图
	</script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=4cXNyMR23iSxTmEEzcyNcjdd6GuBvaef"></script>
	<script src="js/front/InfoBox_min.js"></script>
	<script type="text/javascript" src="js/front/service_site.js"></script>
	<img class="img-responsive hidden-xs" src="images/images_enterprise/2banner.jpg" alt="banner">

    <div class="container">
	    <!-- 二级导航 -->
		<div class="row row_enterprise">
			<div class="col-xs-12 col-md-7 column clearfix">	
				<div class="redbar">
				</div>
				<span class="">数据统计</span>
			</div>
		</div>
		<!-- end 二级导航 -->
	</div>
	<hr />

	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12 serviceTitle">服务站点</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12 statistic_top">
				<!-- 接口 -->
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 statistic_right">
				<!-- 接口 -->
				<div role="tabpanel" class="tab-pane active">
					<ul class="nav nav-tabs nav_right clearfix" role="tablist">
						<li role="presentation" class="active"><a role="tab" data-toggle="tab">代买金额</a></li>
						<li role="presentation"><a role="tab" data-toggle="tab">总订单数</a></li>
						<li role="presentation"><a role="tab" data-toggle="tab">代销金额 </a></li>
						<li role="presentation"><a role="tab" data-toggle="tab">总订单数</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="a"></div>
					</div>
				</div>

			</div>
		</div>
		<!-- 中间介绍 -->
		<div class="row row_two">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="mapTitle">县域电子商务站点分布图</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div id="allmap"></div>
			</div>
		</div>

		<!-- end 中间介绍 -->
		<!-- 下方统计数量 -->
		<div class="row row_bottom">
			<div class="col-md-3 col-sm-3 col-xs-12 statistic_bottom">
				<ul class="nav nav-pills nav-stacked nav_bottom" role="tablist">
					<li role="presentation"  class="active" ><a href="#bussiness" role="tab" data-toggle="tab" onclick="picUnder(1);">按月统计培训</a></li>
  					<li role="presentation"><a href="#cun" role="tab" data-toggle="tab" onclick="picUnder(2);">快递覆盖率</a></li>
  					<li role="presentation"><a href="#express" role="tab" data-toggle="tab" onclick="picUnder(3);">快递企业数量</a></li>
  					<li role="presentation"><a href="#address" role="tab" data-toggle="tab" onclick="picUnder(4);">快递收件量</a></li>
  					<li role="presentation"><a href="#net" role="tab" data-toggle="tab" onclick="picUnder(5);">企业网商</a></li>
  					<li role="presentation"><a href="#economic" role="tab" data-toggle="tab" onclick="picUnder(6);">经济指标</a></li>
  					<li role="presentation"><a href="#person" role="tab" data-toggle="tab" onclick="picUnder(7);">个体工商户</a></li>
  					<li role="presentation"><a href="#basic" role="tab" data-toggle="tab" onclick="picUnder(8);">基础设施指标</a></li>
				</ul>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 table1">
				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="bussiness">
				    	<div class="col-md-12 col-sm-12 col-xs-12">
				    		<div class="box_shadow1">
								<div class="doubleColumn"></div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="cun">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="cover"></div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="express">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="expressCompany"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="address">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="expressAdressee"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="net">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="netBussiness"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="economic">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="box_shadow1">
								<div class="ecAll"></div>
							</div>
						</div> 
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="box_shadow1">
								<div class="ecBussiness"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="person">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="netPerson"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="basic">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="basicStruct"></div>
							</div>
						</div>    
					</div>
				</div>
			</div>
		</div>
		<!-- end 下方统计数量 -->
	</div>
	<!-- 需要定位的元素 -->
	<div class="boxC">
		<button id="back" class="clearfixed">回到中心点</button>
		<div class="detailBox">
			<!-- 接口 -->
		</div>  
	</div>
	<!-- END需要定位的元素 -->

	<script src="js/front/dataStatistic.js"></script>
	<script src="js/front/highcharts_js/highcharts.js"></script>
	<!--<script src="js/front/highcharts_js/cn-china.js"></script>-->
	<script>
		
	</script>