
	<link href="css/css/ectrain.css" rel="stylesheet">
	<script src="js/front/ectrain.js"></script>
	<script type="text/javascript">
		var ectrainAllUrl = "<?=Yii::$app->urlManager->createUrl('ectrain/ectrain-all')?>";
		var videoUrl = "<?=Yii::$app->urlManager->createUrl('video/ectrain-video')?>";
		var detailUrl = "<?=Yii::$app->urlManager->createUrl('front/train-detail')?>";
		var videoDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/video-detail')?>";
	</script>
    <img class="img-responsive center-block hidden-xs" src="images/images_onlinevideo/banner.jpg" />

	<!-- content -->
	<div class="container">
	    <div class="row">
			<div class="col-xs-12 column">	
				<div class="colum_border">
					<div class="redbar">
					</div>
					<span><a>培训通知</a></span>
					<a href="<?=Yii::$app->urlManager->createUrl('front/train-notice')?>">更多>></a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="inform_border">
	    	<div class="row trainInform">
	    		<!-- 接口 -->

				<!-- END接口 -->
			</div>
			
		</div>
	</div>

	<div class="container">
	    <div class="row">
			<div class="col-xs-12 column">	
				<div class="colum_border">
					<div class="redbar">
					</div>
					<span><a>在线视频</a></span>
					<a href="<?=Yii::$app->urlManager->createUrl('front/online-video')?>">更多>></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container online_video">
		<!-- 接口 -->

        <!-- END接口 -->
    </div>	

	<!-- End content -->