<link rel="stylesheet" type="text/css" href="css/css/trainingnotice.css">
<script src='js/front/train_notice.js'></script>
<script type="text/javascript">
	var ectrainUrl = "<?=yii::$app->urlManager->createUrl('ectrain/ectrain')?>";
	var dictUrl = "<?=yii::$app->urlManager->createUrl('ectrain/dict')?>";
	var detailUrl = "<?=yii::$app->urlManager->createUrl('front/train-detail')?>";
</script>
<img class="img-responsive hidden-xs" src="images/images_trainingnotice/banner.jpg" alt="banner">

<!-- 二级标题 -->

<div class="container top_two">
	<div class="row row_enterprise">

	</div>
</div>
<!-- end 二级标题 -->

<!-- 正文内容 -->

<div class="container">
	<div class="row row_one row_display">


	</div>
</div>
<div class="container">
<!--分页 -->
	<div class="row row_page">
		<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
		<nav aria-label="Page navigation" class="col-md-8 col-sm-10 col-xs-12">
		  <ul class="pagination pagination-lg">
		    <li><a href="#" aria-label="Previous">
		        上一页</a>
		    </li>
		    <li><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li><a class="fen" href="#">...</a></li>
		    <li><a href="#">25</a></li>
		    <li>
		      <a href="#" aria-label="Next">
		        下一页
		      </a>
		    </li>
		  </ul>
		</nav>
		<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
	</div>
	<!-- end 分页 -->
</div>