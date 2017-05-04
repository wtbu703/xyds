
	<link href="css/css/enterprisedisplay_news.css" rel="stylesheet">
	<link href="css/css/company.css" rel="stylesheet">
	<script src="js/front/enterprisedisplay_news.js"></script>
	<script>
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var lineUrl = "<?=Yii::$app->urlManager->createUrl('front/line')?>";
		var recruitUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/company-recruit')?>";
		var companyNewsUrl = "<?=Yii::$app->urlManager->createUrl('company-news/all-news')?>";
		var newsDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/news-detail')?>";
		var onlineUrl = "<?=Yii::$app->urlManager->createUrl('front/detail')?>";
		var companyId = "<?=$companyId?>";
	</script>
	<img class="img-responsive center-block hidden-xs" src="images/images_enterprisedisplay_news/2banner.jpg" />

	<!-- content -->
	<div class="container">
	    <!-- 二级导航 -->
		<div class="row">
			<div class="col-xs-12 col-md-7 column column_mt">	
				<div class="redbar">
				</div>
				<span class="">企业展示</span>
			</div>
			<!-- <div class="col-xs-12 col-md-4 col-md-offset-1 enterprise_search">
				<input type="text" name="search" class="search_input col-md-9">
				<button class="btn btn-default btn-sm btn_search" type="submit"><img src="images/images_enterprisedisplay_news/search.png" alt="搜索图标"></button>
			</div> -->
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
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>&id=<?=$companyId?>"><?=$companyName?></a></span>
						<span>></span>
						<span>公司新闻</span>
					</div>
				</div>
				<div class="ec_news row_news">
					<div class="row">
						<div class="col-xs-12 column column_list">	
							<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 tab_btn1 hover tabH" role="button">
								最新文章
							</a>
							<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 tab_btn2 tabH" role="button">
								跨境电商
							</a>
							<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 tab_btn3 tabH" role="button">
								媒体关注
							</a>
							<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 tab_btn4 tabH" role="button">
								内部新闻
							</a>
							<a class="btn btn-default col-xs-12 col-sm-2 col-md-2 tab_btn4 tabH" role="button">
								最新动态
							</a>
						</div>
					</div>
					
					<div class="article_main">
						<!-- 接口 -->

						<!-- END接口 -->

					</div>
					<hr />
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
				
				<div class="company_recruit">

				</div>
			</div>	
		</div>		
	</div>
	<!-- End content -->