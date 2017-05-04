<?
$this->title = "搜索";
?>
<link rel="stylesheet" type="text/css" href="css/css/search.css">
<script type="text/javascript">
	var searchUrl = "<?=Yii::$app->urlManager->createUrl('front/find-more')?>";
	var articleUrl = "<?=Yii::$app->urlManager->createUrl('front/ec-info-detail')?>";
	var title = "<?=$title?>";
</script>
<script src="js/front/search.js"></script>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12 content">
			<div class="col-xs-0 col-md-1 col-lg-1"></div>
			<!--<div class="col-xs-12 col-md-10 col-lg-10">
				<!--<div class="col-xs-12 col-md-12 col-lg-12 content_top">
					<img class="img-responsive" src='images/images_common/home_icon.png' />
				</div>
					<div class="col-xs-12 col-md-12 col-lg-12 content_con">
						<div class="content_box">
						</div>
						<div class="content_line"></div>
					</div>
			</div>-->
			<div class="col-xs-0 col-md-1 col-lg-1"></div>

		</div>
	</div>
</div>
<div class="container">
	<!--分页 -->
	<div class="row row_page">
		<div class="col-md-3 col-sm-1 col-xs-0 col-lg-4"></div>
		<nav aria-label="Page navigation" class="col-lg-5 col-md-7 col-sm-10 col-xs-12">
		  <ul class="pagination pagination-lg col-md-12 col-sm-12 col-xs-12">

		  </ul>
		</nav>
		<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
	</div>
</div>