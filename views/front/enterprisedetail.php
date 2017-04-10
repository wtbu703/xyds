
	<link rel="stylesheet" type="text/css" href="css/css/enterprisedetail.css">
	<link rel="stylesheet" type="text/css" href="css/css/company.css">
	<script src="js/front/enterprise_detail.js"></script>
	<script src="js/front/common_js/company.js"></script>
	<script type="text/javascript">
		var companyDetailUrl = "<?=Yii::$app->urlManager->createUrl('company/company')?>";
		var dictUrl = "<?=Yii::$app->urlManager->createUrl('company/dict')?>";
		var displayUrl = "<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>";
		var companyId = "<?=$companyId?>";
		var productUrl = "<?=Yii::$app->urlManager->createUrl('company-product/company-product')?>";
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var newsUrl = "<?=Yii::$app->urlManager->createUrl('company-news/company-news')?>";
		var recruitUrl = "<?=Yii::$app->urlManager->createUrl('company-recruit/company-recruit')?>";
		var productDisplayUrl = "<?=Yii::$app->urlManager->createUrl('front/product-display')?>";
		var productDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/product-detail')?>";
	</script>

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
				<?if(!is_null($company)){?>
				<div class="box clearfix">
					<div class="right_head">
						<div class="list_head">
							<span class="lh_index"><img class="img-responsive home" src="images/images_common/home.png" alt="首页图标"><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>">首页</a>&nbsp;></span>
							<span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>">企业展示</a>&nbsp;></span>
							<span class="lh_index"><?=$company->name?></span>
						</div>
					</div>
					<div class="left_title clearfix col-md-12 col-sm-12 col-xs-12">
						<h3 class="name"><?=$company->name?></h3>

					</div>
					<div class="article_source col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-3 col-sm-1 col-xs-0"></div>
						<h5 class="col-md-9 col-sm-11 col-xs-12">内容来源:&nbsp;<?=$company->sources?>&nbsp;点击次数:&nbsp;<?=$company->count?>&nbsp;次&nbsp;发布时间:&nbsp;<?=$company->datetime?></h5>
					</div>
					<div class="company col-md-12 col-sm-12 col-xs-12 clearfix">
						<img class="img-responsive" src="<?=$company->logoUrl?>" alt="企业图片">
						<div class="message col-md-6 col-sm-10 col-xs-12">
							<h5>公司名称：&nbsp;<?=$company->name?></h5>
							<h5>公司法人：&nbsp;<?=$company->corporate?></h5>
							<h5>公司网址：&nbsp;<?=$company->webSite?></h5>
							<h5>联系电话：&nbsp;<?=$company->tel?></h5>
							<h5>联系地址：&nbsp;<?=$company->address?></h5>
						</div>
					</div>
					<div class="describe col-md-12 col-sm-12 col-xs-12">
						<h5>企业简介</h5>
						<h5><?=$company->introduction?></h5>
					</div>
				</div>
				<?}?>
			</div>
			<!-- end 企业具体信息 -->
			<!-- 右侧链接 -->
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="store_link">

				</div>
				<div class="company_news">

				</div>
			</div>
			<!-- end 右侧链接 -->
		</div>
		<!-- 企业展示下半部分 -->
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-12 product_display">


			</div>
			<!-- 公司招聘 -->
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="company_recruit col-md-12 col-sm-12 col-xs-12">

				</div>
			</div>
			<!-- end 公司招聘 -->
		</div>
		<!-- end 企业展示下半部分 -->
	</div>
	<div class="container">
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
