<?
$this->title = '企业新闻';
?>
	<link href="css/css/enterprisedisplay_detailnews.css" rel="stylesheet">
	<link href="css/css/company.css" rel="stylesheet">
	<script src="js/front/enterprisedisplay_detailnews.js"></script>
	<script>
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var onlineUrl = "<?=Yii::$app->urlManager->createUrl('front/detail')?>";
		var recruitUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/company-recruit')?>";
		var companyId = "<?=$companyId?>";
		var lineUrl = "<?=Yii::$app->urlManager->createUrl('front/line')?>";
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
			<div class="col-xs-12 col-sm-12 col-md-9">
				<div class="big_shadow">
					<div class="row">
						<div class="col-xs-12 nav_s">
							<span><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>">首页</a></span>
							<span>></span>
							<span><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>">企业展示</a></span>
							<span>></span>
							<span><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>&id=<?=$companyId?>"><?=$companyName?></a></span>
							<span>></span>
							<span>公司新闻</span>
						</div>
					</div>
					<hr />
					<div class="row article rowArticle">
						<!-- 接口 -->
						<?if(!is_null($companyNews)){?>
						<div class="col-xs-12">
							<h5><?=$companyNews->title?></h5>
						</div>
						<div class="col-xs-12 article_msg">
							<div>
								<span>发布者：<?=$companyNews->author?></span>
								<span>更新时间：<?=$companyNews->published?></span>
								<span>关键字：<?=$companyNews->keyword?></span>
							</div>
						</div>
						<div class="col-xs-12">
							<img class="img-responsive" src="<?=$companyNews->picUrl?>" alt="新闻图片">
						</div>
						<div class="col-xs-12"><?=$companyNews->content?></div>
							<?if(!is_null($companyNews->attachUrl)&&!is_null($companyNews->attachName)){//如果存在附件?>
								<div class="col-xs-12 article_attachment">
									<span>附件：</span><a href="<?=$companyNews->attachUrl?>"><?=$companyNews->attachName?></a>
								</div>
							<?}?>
						<?}?>
						<div class="col-xs-12">
							<div class="article_hr">
							</div>
						</div>
						<div class="col-xs-12">
							<ul class="page">
								<?php
								if($stitle != ''){?>
									<?php
									$stime = substr($spublished,0,10);
									?>
									<li><div></div><a href="<?=Yii::$app->urlManager->createUrl('front/news-detail')?>&newsId=<?=$sid?>&companyId=<?=$companyId?>"><span>上一篇：<?=$stitle?> <h>&nbsp;<?=$stime?></h></span></a></li>
								<?}?>
								<?php
								if($titles != ''){?>
									<?php
									$times = substr($publisheds,0,10);
									?>
									<li><div></div><a href="<?=Yii::$app->urlManager->createUrl('front/news-detail')?>&newsId=<?=$ids?>&companyId=<?=$companyId?>"><span>下一篇：<?=$titles?> <h>&nbsp;<?=$times?></h></span></a></li>
								<?}?>
							</ul>
						</div>
						<!-- end接口 -->
					</div>
				</div>
			</div>


			<div class="col-xs-12 col-sm-12 col-md-3">	
				<div class="store_link">

				</div>
				<div class="company_recruit col-xs-12">

				</div>
			</div>
		</div>
	</div>
	<!-- End content -->