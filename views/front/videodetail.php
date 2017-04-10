
	<link href="css/css/ecinformationDetail.css" rel="stylesheet">
	<script src="js/front/online_videoDetail.js"></script>
	<script>
		var detailUrl = "<?=Yii::$app->urlManager->createUrl('front/ec-info-detail')?>";
		var hotCompanyUrl = "<?=Yii::$app->urlManager->createUrl('company/hot-company')?>";
		var hotNewsUrl = "<?=Yii::$app->urlManager->createUrl('article/hot-news')?>";
		var companyDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>";
	</script>
	<img class="img-responsive center-block hidden-xs" src="images/images_onlinevideo/banner.jpg" />

	<!-- content -->
	<div class="container">
	    <div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 big_shadow">
				<div class="row">
					<div class="col-xs-12 nav_s">
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>">首页</a></span>
						<span>></span>
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/online-video')?>">在线视频</a></span>
						<span>></span>
						<span>视频播放</span>
					</div>
				</div>
				<hr />
				<div class="row article row_video">
					<!-- 接口 -->
					<?if(!is_null($video)){?>
					<div class="col-xs-12">
						<h5><?=$video->name?></h5>
						<div class="train_media">
							<video controls="controls">
							    <source src="<?=$video->url?>" type="video/mp4" />
							</video>
						</div>
					</div>
					<?}?>
					<!-- END接口 -->
					<div class="col-xs-12">
						<div class="article_hr">
						</div>
					</div>
					<div class="col-xs-12">
						<ul class="page">
							<li><h5><a href="#">上一篇：如何装修网店</a></h5><span>2017-02-08</span></li>
							<li><h5><a href="#">下一篇：如何正确认识互联网s</a></h5><span>2017-02-08</span></li>
						</ul>
					</div>
				</div>		
			</div>

			<div class="col-xs-12 col-sm-12 col-md-4">	
				<div class="row">
					<div class="col-xs-12 column">	
						<div class="redbar">
						</div>
						<span class="">热点新闻</span>
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
						<span class="">热门企业</span>
					</div>
				</div>
				<div class="hot hotCompany">
					<!-- 热门企业接口 -->

				<!-- END热门企业接口 -->
				</div>
			</div>
		</div>
	</div>
	<!-- End content -->