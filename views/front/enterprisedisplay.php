
	<link rel="stylesheet" type="text/css" href="css/css/enterprisedispaly.css">
	<script src="js/front/enterprise_display.js"></script>
	<script type="text/javascript">
		var companyUrl = "<?=yii::$app->urlManager->createUrl('company/company')?>";
		var dictUrl = "<?=yii::$app->urlManager->createUrl('company/dict')?>";
		var companyDetailUrl = "<?=yii::$app->urlManager->createUrl('front/enterprise-detail')?>";
	</script>

    <img class="img-responsive hidden-xs" src="images/images_enterprise/2banner.jpg" alt="banner">
	<!-- 企业展示 -->
	<div class="wrapper">
	    <div class="container">
	    	<!-- 二级导航 -->
		    <div class="row row_enterprise">

			</div>
			<!-- end 二级导航 -->
		</div>
		<hr />
		<!-- 企业详细信息 -->
		
			
		<div class="container">
			<!-- 第一行 -->
			<div class="row row_one">	

			<!-- end 第四行 -->
			</div>
			
		
		<!-- end 企业详细信息 -->
		<div class="container">
		<!--分页 -->
			<div class="row row_page">
				<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
				<nav aria-label="Page navigation" class="col-md-8 col-sm-10 col-xs-12">
				  <ul class="pagination pagination-lg">

				  </ul>
				</nav>
				<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
			</div>
		</div>

	</div>
	<!-- end 企业展示 -->