<?
$this->title = '公司产品';
?>
	<link rel="stylesheet" type="text/css" href="css/css/product_display.css">
	<link rel="stylesheet" type="text/css" href="css/css/company.css">
	<script>
		var productUrl = "<?=Yii::$app->urlManager->createUrl('company-product/company-product')?>";
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var newsUrl = "<?=Yii::$app->urlManager->createUrl('company-news/company-news')?>";
		var recruitUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/company-recruit')?>";
		var companyId = "<?=$companyId?>";
		var productDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/product-detail')?>";
		var lineUrl = "<?=yii::$app->urlManager->createUrl('front/company-recruit')?>";
		var onlineUrl = "<?=Yii::$app->urlManager->createUrl('front/detail')?>";
		var newsallUrl = "<?=Yii::$app->urlManager->createUrl('front/company-news')?>";
		var newsDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/news-detail')?>";
		var companyUrl = "<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>";
		var companyDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>";
	</script>
	<script src="js/front/product_display.js"></script>
	<script src="js/front/common_js/company.js"></script>

    <img class="img-responsive hidden-xs" src="<?=$pic?>" alt="banner">
	<div class="container">
	    <!-- 二级导航 -->
		<div class="row row_enterprise">
			<div class="col-xs-12 col-md-7 column column_mt">	
				<div class="redbar">
				</div>
				<span class="">企业展示</span>
			</div>
		</div>
		<!-- end 二级导航 -->
	</div>
	<hr />

	<div class="container">
		<div class="row">
			<!-- 企业具体信息 -->
			<div class="col-md-9 col-xs-12 col-sm-9 left_content1">
			   <!--  产品展示 -->

				<!-- end  产品展示 -->
			</div>
			<!-- end 企业具体信息 -->
			<!-- 右侧链接 -->
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="store_link">
				</div>
				<div class="company_news">

				</div>
				<div class="company_recruit">

				</div>
			</div>
			<!-- end 右侧链接 -->
		</div>
		<!--分页 -->
		<div class="row row_page">
			<div class="col-md-3 col-sm-1 col-xs-0 col-lg-4"></div>
			<nav aria-label="Page navigation" class="col-lg-5 col-md-7 col-sm-10 col-xs-12">
			  <ul class="pagination pagination-lg">

			  </ul>
			</nav>
			<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
		</div>
	</div>