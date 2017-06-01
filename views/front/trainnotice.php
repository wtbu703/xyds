<?
$this->title = '培训通知';
?>
<link rel="stylesheet" type="text/css" href="css/css/trainingnotice.css">
<script src='js/front/train_notice.js'></script>
<script type="text/javascript">
	var ectrainUrl = "<?=yii::$app->urlManager->createUrl('ectrain/ectrain')?>";
	var dictUrl = "<?=yii::$app->urlManager->createUrl('ectrain/dict')?>";
	var detailUrl = "<?=yii::$app->urlManager->createUrl('front/train-detail')?>";
	var singupUrl = "<?=Yii::$app->urlManager->createUrl('front/signup')?>";
	var ecUrl = "<?=Yii::$app->urlManager->createUrl('front/ectrain')?>";
	var indexUrl = "<?=Yii::$app->urlManager->createUrl('front/index')?>";
	var type = "<?=$type?>";
</script>
<a href="<?=Yii::$app->urlManager->createUrl('front/online-video')?>"><img class="img-responsive center-block hidden-xs" src="<?=$pic?>" /></a>


<!-- 二级标题 -->

<div class="container top_two">
	<div class="row row_enterprise">

	</div>
</div>
<!-- end 二级标题 -->

<!-- 正文内容 -->

<div class="container">
	<div class="row row_one">


	</div>
</div>
<div class="container">
<!--分页 -->
	<div class="row row_page">
		<div class="col-md-3 col-sm-1 col-xs-0 col-lg-4"></div>
		<nav aria-label="Page navigation" class="col-lg-5 col-md-7 col-sm-10 col-xs-12">
		  <ul class="pagination pagination-lg">

		  </ul>
		</nav>
		<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
	</div>
	<!-- end 分页 -->
</div>