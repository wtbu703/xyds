
	<link rel="stylesheet" type="text/css" href="css/css/product_display.css">
	<link rel="stylesheet" type="text/css" href="css/css/company.css">
	<script>
		var productUrl = "<?=Yii::$app->urlManager->createUrl('company-product/company-product')?>";
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var newsUrl = "<?=Yii::$app->urlManager->createUrl('company-news/company-news')?>";
		var recruitUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/company-recruit')?>";
		var companyId = "<?=$companyId?>";
		var productDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/product-detail')?>";
		var onlineUrl = "<?=Yii::$app->urlManager->createUrl('front/online')?>";
	</script>
	<script src="js/front/product_display.js"></script>
	<script src="js/front/common_js/company.js"></script>

    <img class="img-responsive hidden-xs" src="images/images_enterprise/2banner.jpg" alt="banner">
	<div class="container">
	    <!-- 二级导航 -->
		<div class="row row_enterprise">
			<div class="col-xs-12 col-md-7 column column_mt">	
				<div class="redbar">
				</div>
				<span class="">企业展示</span>
			</div>
			<div class="col-xs-12 col-md-4 col-md-offset-1 enterprise_search">
				<input type="text" name="search" class="search_input col-md-9">
				<button class="btn btn-default btn-sm btn_search" type="submit"><img src="images/images_enterprise/search.png" alt="搜索图标"></button>
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
			<nav aria-label="Page navigation" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1">
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
			<div class="col-md-3 col-sm-3 col-xs-0 col-lg-3"></div>
		</div>
	</div>