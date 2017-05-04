
	<link href="css/css/ecinformation.css" rel="stylesheet">
	<script>
		var articleUrl = "<?=Yii::$app->urlManager->createUrl('article/article')?>";
		var detailUrl = "<?=Yii::$app->urlManager->createUrl('front/ec-info-detail')?>";
		var hotCompanyUrl = "<?=Yii::$app->urlManager->createUrl('company/hot-company')?>";
		var hotNewsUrl = "<?=Yii::$app->urlManager->createUrl('article/hot-news')?>";
		var companyDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>";
	</script>
    <script src="js/front/ecinformatiom.js"></script>

	<img class="img-responsive center-block hidden-xs" alt="新闻图片" src="images/images_ecinformation/banner.jpg" />

	
	<!-- content -->
	<div class="container">
	    <div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 row_news">
				<div class="row">
					<div class="col-xs-12">
						<ul class="nav nav-tabs information_list">
						    <li role="presentation" class="active"><a>最新</a></li>
						    <li role="presentation"><a>政策指引</a></li>
						    <li role="presentation"><a>行业资讯</a></li>
						    <li role="presentation"><a>供求信息</a></li>
						    <li role="presentation"><a>企业资讯</a></li>
						</ul>
					</div>
				</div>
				<div class="information_main">
				<!-- 接口 -->

				<!-- END接口 -->
				</div>
				<div class="row row_page">
					<div class="col-xs-0 col-sm-0 col-md-4"></div>
					<div class="col-xs-12 col-sm-12 col-md-7">
						<nav aria-label="Page navigation" >
							<ul class="pagination pagination-lg">

							</ul>
						</nav>
					</div>
					<div class="col-xs-0 col-sm-0 col-md-1"></div>
				</div>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-4">	
				<div class="row">
					<div class="col-xs-12 column">	
						<div class="redbar">
						</div>
						<span class="">热点新闻<a href="<?=Yii::$app->urlManager->createUrl('front/ec-info')?>">>>更多</a></span>
					</div>
				</div>
				<div class="hot">
					<div class="row">
						<div class="col-xs-12 hotNews">	
							<!-- 热点新闻接口 -->

							<!-- END热点新闻接口 -->		
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 column">	
						<div class="redbar">
						</div>
						<span class="">热门企业<a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>">>>更多</a></span>
					</div>
				</div>
				<div class="hot hotCompany">
					<!-- END接口 -->

					<!-- END接口 -->
				</div>

			</div>
		</div>
		
	</div>