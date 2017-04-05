<?
$this->title = "首页";
?>

<link rel="stylesheet" type="text/css" href="css/css/common.css">
<link rel="stylesheet" type="text/css" href="css/css/index.css">
<script type="text/javascript">
var indexUrl = "<?=yii::$app->urlManager->createUrl('article/article')?>";
var findUrl = "<?=yii::$app->urlManager->createUrl('ectrain/ectrain')?>";
var VideoUrl = "<?=yii::$app->urlManager->createUrl('video/video')?>";
var infoUrl = "<?=yii::$app->urlManager->createUrl('public-info/info')?>";
</script>
<script type="text/javascript" src="js/front/index.js"></script>

<!-- 轮播部分 -->
<div id="slidershow1" class="carousel slide hidden-xs" data-ride="carousel" data-wrap="true" data-pause="hover" data-interval="5000"  >
	<ol class="carousel-indicators">
		<li class="active" data-target="#slidershow1" data-slide-to="0"></li>
		<li data-target="#slidershow1" data-slide-to="1"></li>
		<li data-target="#slidershow1" data-slide-to="2"></li>
		<li data-target="#slidershow1" data-slide-to="3"></li>
	</ol>
	<div class="carousel-inner">
		<div class="item active">
			<a href="ecinformationDetail.html"><img class="center-block" alt="轮播图" src="images/images_index/banner1.jpg" /></a>
		</div>
		<div class="item">
			<a href="ecinformationDetail.html"><img class="center-block" alt="轮播图" src="images/images_index/banner2.jpg" /></a>
		</div>
		<div class="item">
			<a href="ecinformationDetail.html"><img class="center-block" alt="轮播图" src="images/images_index/banner3.jpg" /></a>
		</div>
		<div class="item">
			<a href="ecinformationDetail.html"><img class="center-block" alt="轮播图" src="images/images_index/banner4.jpg" /></a>
		</div>
	</div>
</div>
<!-- 正文部分 -->
<!-- 电商资讯 -->
<div class="zixun">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 column column_mt">
				<div class="redbar">
				</div>
				<span class="">电商资讯</span>
				<a class="btn btn-default col-xs-12 col-sm-2 col-md-1 tab_btn1 hover" role="button">
					政策指引
				</a>
				<a class="btn btn-default col-xs-12 col-sm-2 col-md-1 tab_btn2" role="button">
					行业资讯
				</a>
				<a class="btn btn-default col-xs-12 col-sm-2 col-md-1 tab_btn3" role="button">
					企业资讯
				</a>
				<a class="btn btn-default col-xs-12 col-sm-2 col-md-1 tab_btn4" role="button">
					供求信息
				</a>
			</div>
		</div>
	</div>
</div>

<hr />
<div class="container tab">
	<!-- 电商资讯接口 -->

	<!--END 电商资讯接口 -->
</div>
<!-- 电商培训 -->
<div class="zixun">
<hr />
<div class="container">
	<div class="row">
		<div class="col-xs-12 column column_train">
			<div class="redbar">
			</div>
			<span class="">电商培训</span>
		</div>
	</div>
</div>
<hr />
<div class="container">
	<div class="row ">
		<div class="col-xs-12 col-sm-12 col-md-4 distance_b">
			<div id="slidershow3" class="carousel slide " data-ride="carousel" data-wrap="true" data-pause="hover" data-interval="5000"  >
				<ol class="carousel-indicators point point_train">
					<li class="active" data-target="#slidershow3" data-slide-to="0"></li>
					<li data-target="#slidershow3" data-slide-to="1"></li>
					<li data-target="#slidershow3" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner zixun_banner row_train" >
					<!-- 电商培训接口 -->

					<!-- END 电商培训接口 -->
				</div>
			</div>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 train_img">
			<a href="trainingnotice.html"><img src="images/images_index/artist.png" alt="美工培训" class="img-responsive center-block artist_hover"></a>
			<a href="trainingnotice.html"><img src="images/images_index/service.png" alt="销售培训" class="img-responsive center-block service_hover"></a>
			<a href="trainingnotice.html"><img src="images/images_index/sales.png" alt="客服培训" class="img-responsive center-block sales_hover"></a>
			<a href="trainingnotice.html"><img src="images/images_index/more.png" alt="其它培训" class="img-responsive center-block more_hover"></a>
		</div>
		<div class="col-xs-10 col-sm-10 col-md-6 ">
			<div class="train_media">
				<!-- 视频接口 -->

				<!-- END视频接口 -->
			</div>
		</div>
	</div>
</div>
</div>
<!-- 信息公开 -->
<div class="zixun">
<hr />
<div class="container">
	<div class="row">
		<div class="col-xs-12 column column_train">
			<div class="redbar">
			</div>
			<span class="">信息公开</span>
		</div>
	</div>
</div>
<hr />
<div class="container">
	<div class="row ">
		<div class="col-xs-12 col-sm-12 col-md-4 distance_b">
			<div class="carousel-inner zixun_banner row_newsOpen" >
				<!-- 信息公开接口 -->

				<!-- END信息公开接口 -->
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="row">
				<div class="col-xs-12 tender_title">
					<img class="" src="../images/images_index/xinxi_icon1.png" alt="">
					<span>招标最新进展</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender">
					<span class="col-xs-3 tender_process">
					招标公示
					</span>
					<img class="col-xs-1 img-responsive" src="../images/images_index/xinxi_arrow3.png" alt="">
					<span class="col-xs-3 tender_process">招标保名
					</span>
					<img class="col-xs-1 " class="col-xs-1 img-responsive " src="../images/images_index/xinxi_arrow3.png" alt="">
					<span class="col-xs-3 tender_process">
					资格审查
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender tender_time">
					<span class="col-xs-3 ">
						2017.02.19
					</span>
					<div class="col-xs-1"></div>
					<span class="col-xs-3 ">
						2017.02.19
					</span>
					<div class="col-xs-1"></div>
					<span class="col-xs-3 ">
						2017.02.19
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender_img ">
					<div class="col-xs-3"></div>
					<div class="col-xs-1"></div>
					<div class="col-xs-3"></div>
					<div class="col-xs-1"></div>
					<div class="col-xs-3">
						<img class=" " src="../images/images_index/xinxi_arrow2.png" alt="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender">
					<span class="col-xs-3 tender_process">
					缴保证金
					</span>
					<img class="col-xs-1 img-responsive" src="../images/images_index/xinxi_arrow1.png" alt="">
					<span class="col-xs-3 tender_process">
					编制文件
					</span>
					<img class="col-xs-1 " class="col-xs-1 img-responsive " src="../images/images_index/xinxi_arrow1.png" alt="">
					<span class="col-xs-3 active tender_process">
					招标答疑
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender tender_time">
					<span class="col-xs-3 ">
						2017.03.10
					</span>
					<div class="col-xs-1"></div>
					<span class="col-xs-3 ">
						2017.03.15
					</span>
					<div class="col-xs-1"></div>
					<span class="col-xs-3 active_time">
						2017.03.20
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender_img ">
					<div class="col-xs-3">
						<img class=" " src="../images/images_index/xinxi_arrow2.png" alt="">
					</div>
					<div class="col-xs-1"></div>
					<div class="col-xs-3"></div>
					<div class="col-xs-1"></div>
					<div class="col-xs-3"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender">
					<span class="col-xs-3 tender_process">
					开标定标
					</span>
					<img class="col-xs-1 img-responsive" src="../images/images_index/xinxi_arrow3.png" alt="">
					<span class="col-xs-3 tender_process">中标公示
					</span>
					<img class="col-xs-1 " class="col-xs-1 img-responsive " src="../images/images_index/xinxi_arrow3.png" alt="">
					<span class="col-xs-3 tender_process">
					发招标书
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 tender tender_time">
					<span class="col-xs-3 ">
						2017.03.22
					</span>
					<div class="col-xs-1"></div>
					<span class="col-xs-3 ">
						2017.03.23
					</span>
					<div class="col-xs-1"></div>
					<span class="col-xs-3 ">
						2017.04.01
					</span>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="tender_title publicity">
				<img class="" src="../images/images_index/xinxi_icon1.png" alt="">
				<span>相关公告公示</span>
			</div>

			<div class="zixun_camera">
			<!-- 信息公开接口 -->
				<!-- <ul >
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
					<li>
						<h5>
							<a href="info_details.html">
								本市区公司申请进入产业园指导说明书
							</a>
						</h5>
						<span>[8-13]</span>
					</li>
				</ul>-->
				<!-- 	END信息公开接口	 -->
			</div>

		</div>
	</div>
</div>
</div>
<!-- 企业展示 -->
<div class="zixun">
<hr />
<div class="container">
	<div class="row">
		<div class="col-xs-12 column column_train">
			<div class="redbar">
			</div>
			<span class="">企业展示</span>
		</div>
	</div>
</div>

<div class="header_c borderbottom">
	<div class="container">
		<div class="row row1">
			<!-- 企业展示接口 -->
			<div class="col-xs-12 col-sm-6 col-md-3 company_show">
				<div class="divborder">
					<a href="enterprisedetail.html"><img class="pic1 img-responsive center-block" id="pic" src="../images/images_index/qiye_1.jpg" alt="新闻图片"></a>
				</div>
				<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">
					<h4>电子商务创业园</h4>
				</div>
				<p>
					电子商务创业园A区,座落在定海区盐仓街道茅岭路173号,办公面积600平米,仓储面积1000平米,停车位20余个。创业园在2015年7月初开工建设,历时2个月,投资装修资金140余万元,已于2015年9月1日试营业,入驻商家19余家。
				</p>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-3 company_show">
				<a href="enterprisedetail"><img class="img-responsive" src="../images/images_index/qiye_2.jpg" alt="新闻图片"></a>
				<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">
					<h4>电子商务创业园</h4>
				</div>
				<p>
					电子商务创业园A区,座落在定海区盐仓街道茅岭路173号,办公面积600平米,仓储面积1000平米,停车位20余个。创业园在2015年7月初开工建设,历时2个月,投资装修资金140余万元,已于2015年9月1日试营业,入驻商家19余家。
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 company_show">
				<a href="enterprisedetail"><img class="img-responsive" src="../images/images_index/qiye_3.jpg" alt="新闻图片"></a>
				<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">
					<h4>电子商务创业园</h4>
				</div>
				<p>
					电子商务创业园A区,座落在定海区盐仓街道茅岭路173号,办公面积600平米,仓储面积1000平米,停车位20余个。创业园在2015年7月初开工建设,历时2个月,投资装修资金140余万元,已于2015年9月1日试营业,入驻商家19余家。
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 company_show">
				<a href="enterprisedetail"><img class="img-responsive" src="../images/images_index/qiye_4.jpg" alt="新闻图片"></a>
				<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">
					<h4>电子商务创业园</h4>
				</div>
				<p>
					电子商务创业园A区,座落在定海区盐仓街道茅岭路173号,办公面积600平米,仓储面积1000平米,停车位20余个。创业园在2015年7月初开工建设,历时2个月,投资装修资金140余万元,已于2015年9月1日试营业,入驻商家19余家。
				</p>
			</div>
			<!-- END企业展示接口 -->
		</div>
	</div>
</div>
</div>
<!-- 数据统计 -->
<div class="zixun">
<div class="container">
	<div class="row">
		<div class="col-xs-12 column column_train">
			<div class="redbar">
			</div>
			<span class="">数据统计</span>
		</div>
	</div>
</div>
<div class="header_c borderbottom">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3 company_show">
				<a href="dtat_tatist.html"><img class="img-responsive" src="../images/images_index/shuju_1.jpg" alt="新闻图片"></a>
				<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">
					<h4>电子商务创业园</h4>
				</div>
				<p>
					电子商务创业园A区,座落在定海区盐仓街道茅岭路173号,办公面积600平米,仓储面积1000平米,停车位20余个。创业园在2015年7月初开工建设,历时2个月,投资装修资金140余万元,已于2015年9月1日试营业,入驻商家19余家。
				</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 company_show">
				<a href="dtat_statist.html"><img class="img-responsive data_img" src="../images/images_index/shuju_2.jpg" alt="新闻图片"></a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 company_show">
				<a href="dtat_statist.html"><img class="img-responsive" src="../images/images_index/shuju_3.jpg" alt="新闻图片"></a>
				<div class="carousel-caption hidden-md hidden-xs hidden-sm img_banner img_banner2">
					<h4>电子商务创业园</h4>
				</div>
				<p>
					电子商务创业园A区,座落在定海区盐仓街道茅岭路173号,办公面积600平米,仓储面积1000平米,停车位20余个。创业园在2015年7月初开工建设,历时2个月,投资装修资金140余万元,已于2015年9月1日试营业,入驻商家19余家。
				</p>
			</div>
		</div>
	</div>
</div>
</div>
