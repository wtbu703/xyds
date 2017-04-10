
	<link rel="stylesheet" type="text/css" href="css/css/statistic.css">
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ycTgY5YTSnk5PsqumqZboxtXaKU6Io6K"></script>
	<script src="js/front/distpicker.data.js"></script>
	<script src="js/front/distpicker.js"></script>

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
			<!-- 数据统计菜单 -->
			<div class="col-md-3 col-sm-3 col-xs-12 statistic_top">
				<ul class="nav nav-pills nav-stacked nav_top" role="tablist">
					<li role="presentation" class="active" ><a href="#a" role="tab" data-toggle="tab">物流连接的村镇</a></li>
  					<li role="presentation"><a href="#b" role="tab" data-toggle="tab">物流连接的村镇</a></li>
  					<li role="presentation"><a href="#">实时定单交易量</a></li>
  					<li role="presentation"><a href="#">物流连接的村镇</a></li>
  					<li role="presentation"><a href="#">物流连接的村镇</a></li>
  					<li role="presentation"><a href="#">物流连接的村镇</a></li>
  					<li role="presentation"><a href="#">物流连接的村镇</a></li>
  					<li role="presentation"><a href="#">物流连接的村镇</a></li>
				</ul>
			</div>
			<!-- end 数据统计菜单 -->
			<!-- 数据统计分析表 -->
			<div class="col-md-9 col-sm-9 col-xs-12">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="a">
						<ul class="nav nav-tabs nav_right clearfix" role="tablist">
						  <li role="presentation" class="active"><a href="#column" role="tab" data-toggle="tab">代买金额</a></li>
						  <li role="presentation"><a href="#column" role="tab" data-toggle="tab">总订单数</a></li>
						  <li role="presentation"><a href="#3d" role="tab" data-toggle="tab">代销金额 </a></li>
						  <li role="presentation"><a href="#3d" role="tab" data-toggle="tab">总订单数</a></li>
						</ul>
						<div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="column">	
							</div>
							<div role="tabpanel" class="tab-pane" id="column">
							</div>
							<div role="tabpanel" class="tab-pane" id="3d">    
							</div>
							<div role="tabpanel" class="tab-pane" id="3d">    
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<!--  end 数据统计分析表 -->
		</div>
		<!-- 中间介绍 -->
		<div class="row row_two">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<form class="form-inline">
					<div id="distpicker5">
						<div class="form-group">
							<label class="sr-only" for="province10">省</label>
							<select class="form-control" id="province10"><option value="" data-code="">-- 请选择 --</option><option value="北京市" data-code="110000">北京市</option><option value="天津市" data-code="120000">天津市</option><option value="河北省" data-code="130000">河北省</option><option value="山西省" data-code="140000">山西省</option><option value="内蒙古自治区" data-code="150000">内蒙古自治区</option><option value="辽宁省" data-code="210000">辽宁省</option><option value="吉林省" data-code="220000">吉林省</option><option value="黑龙江省" data-code="230000">黑龙江省</option><option value="上海市" data-code="310000">上海市</option><option value="江苏省" data-code="320000">江苏省</option><option value="浙江省" data-code="330000">浙江省</option><option value="安徽省" data-code="340000">安徽省</option><option value="福建省" data-code="350000">福建省</option><option value="江西省" data-code="360000">江西省</option><option value="山东省" data-code="370000">山东省</option><option value="河南省" data-code="410000">河南省</option><option value="湖北省" data-code="420000">湖北省</option><option value="湖南省" data-code="430000">湖南省</option><option value="广东省" data-code="440000">广东省</option><option value="广西壮族自治区" data-code="450000">广西壮族自治区</option><option value="海南省" data-code="460000">海南省</option><option value="重庆市" data-code="500000">重庆市</option><option value="四川省" data-code="510000">四川省</option><option value="贵州省" data-code="520000">贵州省</option><option value="云南省" data-code="530000">云南省</option><option value="西藏自治区" data-code="540000">西藏自治区</option><option value="陕西省" data-code="610000">陕西省</option><option value="甘肃省" data-code="620000">甘肃省</option><option value="青海省" data-code="630000">青海省</option><option value="宁夏回族自治区" data-code="640000">宁夏回族自治区</option><option value="新疆维吾尔自治区" data-code="650000">新疆维吾尔自治区</option><option value="台湾省" data-code="710000">台湾省</option><option value="香港特别行政区" data-code="810000">香港特别行政区</option><option value="澳门特别行政区" data-code="820000">澳门特别行政区</option></select>
						</div>
						<div class="form-group">
							<label class="sr-only" for="city10">市</label>
							<select class="form-control" id="city10"><option value="" data-code="">-- 请选择 --</option></select>
						</div>
						<div class="form-group">
							<label class="sr-only" for="district10">区</label>
							<select class="form-control" id="district10"><option value="" data-code="">-- 请选择 --</option></select>
						</div>
					</div>
				</form>
				<div id="allmap"></div>
			</div>
		</div>
		<!-- end 中间介绍 -->
		<!-- 下方统计数量 -->
		<div class="row row_bottom">
			<div class="col-md-3 col-sm-3 col-xs-12 statistic_bottom">
				<ul class="nav nav-pills nav-stacked nav_top" role="tablist">
					<li role="presentation"  class="active" ><a href="#bussiness" role="tab" data-toggle="tab">按月统计培训</a></li>
  					<li role="presentation"><a href="#cun" role="tab" data-toggle="tab">快递覆盖率</a></li>
  					<li role="presentation"><a href="#express" role="tab" data-toggle="tab">快递企业数量</a></li>
  					<li role="presentation"><a href="#address" role="tab" data-toggle="tab">快递收件量</a></li>
  					<li role="presentation"><a href="#net" role="tab" data-toggle="tab">企业网商</a></li>
  					<li role="presentation"><a href="#economic" role="tab" data-toggle="tab">经济指标</a></li>
  					<li role="presentation"><a href="#person" role="tab" data-toggle="tab">个体工商户</a></li>
  					<li role="presentation"><a href="#basic" role="tab" data-toggle="tab">基础设施指标</a></li>
				</ul>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 table">
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
								<div class="cover" style="width: 818px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="express">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="expressCompany" style="width: 818px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="address">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="expressAdressee" style="width: 818px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="net">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="netBussiness" style="width: 818px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="economic">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="box_shadow1">
								<div class="ecAll" style="width: 400px; height: 400px; margin: 0 auto"></div>
							</div>
						</div> 
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="box_shadow1">
								<div class="ecBussiness" style="width: 400px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="person">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="netPerson" style="width: 818px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>    
					</div>
					<div role="tabpanel" class="tab-pane" id="basic">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box_shadow1">
								<div class="basicStruct" style="width: 818px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>    
					</div>
				</div>
			</div>
		</div>
		<!-- end 下方统计数量 -->
	</div>
	<script src="js/front/statist.js"></script>
	<script src="js/front/column.js"></script>
	<script src="js/front/highcharts_js/highcharts.js"></script>
	<!--<script src="js/front/highcharts_js/cn-china.js"></script>-->