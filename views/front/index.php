<?php
$this->title = "首页";
?>
<style>
	.anchorBL{
        display: none;
    }
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
		bottom:590px;
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
		bottom:260px;
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
	.detailBox .address{
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
<link rel="stylesheet" type="text/css" href="css/css/common.css">
<link rel="stylesheet" type="text/css" href="css/css/index.css">
<script type="text/javascript">
var indexUrl = "<?=yii::$app->urlManager->createUrl('article/index-article')?>";
var findUrl = "<?=yii::$app->urlManager->createUrl('ectrain/ectrain-index')?>";
var VideoUrl = "<?=yii::$app->urlManager->createUrl('video/video-index')?>";
var infoUrl = "<?=yii::$app->urlManager->createUrl('public-info/info-one')?>";
var infoDetail = "<?=yii::$app->urlManager->createUrl('front/info-detail')?>";
var infoAllUrl = "<?=yii::$app->urlManager->createUrl('public-info/index-info')?>";
var companyUrl = "<?=yii::$app->urlManager->createUrl('company/company-index')?>";
var companyDetailUrl = "<?=yii::$app->urlManager->createUrl('front/enterprise-detail')?>";
var stateUrl = "<?=yii::$app->urlManager->createUrl('public-info/state')?>";
var ecInfoDetailUrl = "<?=yii::$app->urlManager->createUrl('front/ec-info-detail')?>";
var trainDetailUrl = "<?=yii::$app->urlManager->createUrl('front/train-detail')?>";
var ecCategoryUrl = "<?=yii::$app->urlManager->createUrl('ectrain/ec-category')?>";
var serviceSiteUrl = "<?=Yii::$app->urlManager->createUrl('service-site/service-site')?>";
var trainUrl = "<?=Yii::$app->urlManager->createUrl('front/train-notice')?>";
var articleDictUrl = "<?=Yii::$app->urlManager->createUrl('article/index-dict')?>";
var ecinfoUrl = "<?=Yii::$app->urlManager->createUrl('front/ec-info')?>";
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=4cXNyMR23iSxTmEEzcyNcjdd6GuBvaef"></script>
<script src="js/front/InfoBox_min.js"></script>
<script type="text/javascript" src="js/front/index.js"></script>
<script type="text/javascript" src="js/front/service_site.js"></script>

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
			<a href="<?=Yii::$app->urlManager->createUrl('front/ec-info')?>"><img class="center-block" alt="轮播图" src="<?=$pic1->url?>" /></a>
		</div>
		<div class="item">
			<a href="<?=Yii::$app->urlManager->createUrl('front/ec-info')?>"><img class="center-block" alt="轮播图" src="<?=$pic2->url?>" /></a>
		</div>
		<div class="item">
			<a href="<?=Yii::$app->urlManager->createUrl('front/ec-info')?>"><img class="center-block" alt="轮播图" src="<?=$pic3->url?>" /></a>
		</div>
		<div class="item">
			<a href="<?=Yii::$app->urlManager->createUrl('front/ec-info')?>"><img class="center-block" alt="轮播图" src="<?=$pic4->url?>" /></a>
		</div>
	</div>
</div>
<!-- 正文部分 -->
<!-- 电商资讯 -->
<div class="zixun">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 column column_mt">
				<!-- 接口 -->
			</div>
		</div>
	</div>



<hr />
<div class="container tab">
	<!-- 电商资讯接口 -->

	<!--END 电商资讯接口 -->
</div>
</div>
<!-- 电商培训 -->
<div class="zixun">
<hr />
<div class="container">
	<div class="row">
		<div class="col-xs-12 column column_train">
			<div class="redbar">
			</div>
			<span class="f_clearCss"><a  href="<?=Yii::$app->urlManager->createUrl('front/ectrain')?>">电商培训</a></span>
		</div>
	</div>
</div>
<hr />
<div class="container">
	<div class="row ">
		<div class="col-xs-12 col-sm-12 col-md-5  col-lg-4  distance_b">
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
		<ul class="col-xs-2 col-sm-2 col-md-1 col-lg-2 train_img hidden-xs hidden-sm">
			
		</ul>
		<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 ">
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
			<span class="f_clearCss"><a  href="<?=yii::$app->urlManager->createUrl('front/public-info')?>">信息公开</a></span>
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
					<img class="" src="images/images_index/xinxi_icon1.png" alt="">
					<span>招标最新进展</span>
				</div>
			</div>
			<div class="row_public">

			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="tender_title publicity">
				<img class="" src="images/images_index/xinxi_icon1.png" alt="">
				<span>相关公告公示</span>
			</div>

			<div class="zixun_camera row_open">
			<!-- 信息公开接口 -->

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
			<span class="f_clearCss"><a  href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>">企业展示</a></span>
		</div>
	</div>
</div>

<div class="header_c borderbottom">
	<div class="container">
		<div class="row row1">
			<!-- 企业展示接口 -->

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
				<span class="f_clearCss"><a  href="<?=Yii::$app->urlManager->createUrl('front/service-site')?>">服务站点</a></span>
			</div>
		</div>
	</div>
	<div class="header_c borderbottom">
		<div class="container">
			<div class="row mapShadow">
				<div id="allmap" ></div>
			</div>
		</div>
	</div>
	<div class="boxC">
		<button id="back" class="clearfixed">回到中心点</button>
		<div class="detailBox">
			<!--接口-->
		</div>  
	</div>
</div>

<!-- 返回顶部 -->

	<div class="return hidden-xs hidden-sm  ">
	</div>

<!-- END返回顶部 -->
