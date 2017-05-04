
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
						<span><a href="<?=Yii::$app->urlManager->createUrl('front/ectrain')?>">电商培训</a></span>
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
							<?php
							$url = substr($video->url,0,6);
							if($url == 'upload'){?>
								<video controls = "controls">
									<source src = "<?=$video->url?>" >
								</video >
							<?}else{?>
								<embed class="urlVdieo" src="http://player.youku.com/player.php/sid/<?=$video->url?>/v.swf"
									   allowFullScreen="true" quality="high"
									   controls="controls"
									   allowScriptAccess="always"
									   type="application/x-shockwave-flash">
								</embed>
							<?}?>
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
							<?php
							if($sname != ''){?>
							<?php
							$stime = substr($sdatetime,0,10);
							?>
							<li><h5><a href="<?=Yii::$app->urlManager->createUrl('front/video-detail')?>&videoId=<?=$sid?>">上一篇：<?=$sname?></a></h5><span><?=$stime?></span></li>
							<?}?>
							<?php
							if($names != ''){?>
							<?php
							$times = substr($datetimes,0,10);
							?>
							<li><h5><a href="<?=Yii::$app->urlManager->createUrl('front/video-detail')?>&videoId=<?=$ids?>">下一篇：<?=$names?></a></h5><span><?=$times?></span></li>
							<?}?>
						</ul>
					</div>
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
					<!-- 热门企业接口 -->

				<!-- END热门企业接口 -->
				</div>
			</div>
		</div>
	</div>
	<!-- End content -->