
	<link href="css/css/ecinformationDetail.css" rel="stylesheet">
	<script src="js/front/ecinformatiomDetail.js"></script>
	<script>
		var detailUrl = "<?=Yii::$app->urlManager->createUrl('front/ec-info-detail')?>";
		var hotCompanyUrl = "<?=Yii::$app->urlManager->createUrl('company/hot-company')?>";
		var hotNewsUrl = "<?=Yii::$app->urlManager->createUrl('article/hot-news')?>";
		var companyDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>";
	</script>
	<img class="img-responsive center-block hidden-xs" src="images/images_ecinformation/banner.jpg" />
    <!-- End header -->
	
	
	<!-- content -->
	<div class="container">
	    <div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 big_shadow">
				<div class="row">
					<div class="col-xs-12 nav_s">
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>">首页</a></span>
						<span>></span>
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/ec-info')?>">电商资讯</a></span>
						<span>></span>
						<span>详情</span>
					</div>
				</div>
				<hr />
				<div class="row article">
					<!-- 接口 -->
					<?if(!is_null($article)){?>
					<div class="col-xs-12">
						<h5><?=$article->title?></h5>
					</div>
					<div class="col-xs-12 article_msg">
						<div>
							<span>发布者：<?=$article->author?></span>
							<span>文章来源：<?=$article->sourceUrl?></span>
							<span>点击次数：<?=$article->count?></span>
							<span>更新时间：<?=$article->datetime?></span>
							<span>关键字：<?=$article->keyword?></span>
						</div>
					</div>
					<div class="col-xs-12">
						<img class="img-responsive" src="<?=$article->picUrl?>" alt="新闻图片">
					</div>
					<div class="col-xs-12">
						<?=$article->content?>
					</div>
						<?if(!is_null($article->attachUrls)&&!is_null($article->attachNames)){//如果存在附件?>
							<div class="col-xs-12 article_attachment">
								<span>附件：</span><a href="<?=$article->attachUrls?>"><?=$article->attachNames?></a>
							</div>
						<?}?>
					<div class="col-xs-12">
						<div class="article_hr">
						</div>
					</div>
					<div class="col-xs-12">
						<ul class="page">
							<li><h5><a href="#">上一篇：2016国家科技奖 蚂蚁金服成唯一获奖ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</a></h5><span>2017-02-08</span></li>
							<li><h5><a href="#">下一篇：2016国家科技奖 蚂蚁金服成唯一获奖ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</a></h5><span>2017-02-08</span></li>
						</ul>
					</div>
					<?}?>
					<!-- END接口 -->
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