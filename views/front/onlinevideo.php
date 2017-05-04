
	<link href="css/css/online_video.css" rel="stylesheet">
	<script src="js/front/online_video.js"></script>
	<script type="text/javascript">
		var videoUrl = "<?=Yii::$app->urlManager->createUrl('video/video-all')?>";
		var videoDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/video-detail')?>";
	</script>
	<img class="img-responsive center-block hidden-xs" src="images/images_onlinevideo/banner.jpg" />
	<!-- content -->
	<div class="container">
	    <div class="row">
			<div class="col-xs-12 column">	
				<div class="redbar">
				</div>
				<span class="">在线视频</span>
				<a  class="btn btn-default col-xs-12 col-sm-2 col-md-1 tabH tab_btn1 hover" role="button">
					前端
				</a>
				<a class="btn btn-default col-xs-12 col-sm-2 col-md-1 tabH tab_btn2" role="button">
					后台
				</a>
			</div>
		</div>
	</div>
	<div class="container online_video">
		<!-- 接口 -->

        <!-- end接口 -->
        
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
	<!-- End content -->