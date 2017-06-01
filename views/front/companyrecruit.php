<?
$this->title = '企业招聘';
?>
	<link href="css/css/enterprisedisplay_news.css" rel="stylesheet">
	<link href="css/css/company.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/css/Online.css">
	<script src="js/front/companyrecruit.js"></script>
	<script>
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var lineUrl = "<?=Yii::$app->urlManager->createUrl('front/company-recruit')?>";
		var recruitUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/company-recruit')?>";
		var companyNewsUrl = "<?=Yii::$app->urlManager->createUrl('company-news/all-news')?>";
		var newsDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/news-detail')?>";
		var detailUrl = "<?=Yii::$app->urlManager->createUrl('front/detail')?>";
		var onlineUrl = "<?=Yii::$app->urlManager->createUrl('front/detail')?>";
		var positionUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/position')?>";
		var companyId = "<?=$companyId?>";
		var companyName = "<?=$companyName?>";
	</script>
	<img class="img-responsive center-block hidden-xs" src="<?=$pic?>" />

	<!-- content -->
	<div class="container">
	    <!-- 二级导航 -->
		<div class="row">
			<div class="col-xs-12 col-md-7 column column_mt">	
				<div class="redbar">
				</div>
				<span class="">企业展示</span>
			</div>
		</div>
		<!-- end 二级导航 -->
	</div>
	<hr class="hr1" />

	<div class="container">
		
	    <div class="row">
			<div class="col-xs-12 col-sm-12 col-md-9 ">
				<div class="ec_news ec_margin">
                    <div class="nav_s ">
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>">首页</a></span>
						<span>></span>
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>">企业展示</a></span>
						<span>></span>
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>&id=<?=$companyId?>"><?=$companyName?></a></span>
						<span>></span>
						<span>公司招聘</span>
					</div>
				</div>
				<div class="ec_news row_news">

					
					<div class=" detial">
						<!-- 接口 -->
						<!-- END接口 -->

					</div>
					<div class="container">
						<div class="row row_page">
							<div class="col-xs-0 col-sm-0 col-md-3"></div>
							<div class="col-xs-12 col-sm-12 col-md-8">
								<nav aria-label="Page navigation" >
									<ul class="pagination pagination-lg">
									</ul>
								</nav>
							</div>
							<div class="col-xs-0 col-sm-0 col-md-1"></div>
						</div>
					</div>
					
				</div>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-3">	
				<div class="store_link">

				</div>

			</div>	
		</div>		
	</div>
	<!-- End content -->