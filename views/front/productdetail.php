<?
$this->title = '产品详情';
?>
    <link rel="stylesheet" type="text/css" href="css/css/product_detials.css">
    <link rel="stylesheet" type="text/css" href="css/css/company.css">
    <script src="js/front/product_detials.js"></script>
	<script type="text/javascript">
		var companyId = "<?=$companyId?>";
		var shoplinkUrl = "<?=Yii::$app->urlManager->createUrl('company-shoplink/company-shoplink')?>";
		var newsUrl = "<?=Yii::$app->urlManager->createUrl('company-news/company-news')?>";
		var newsallUrl = "<?=Yii::$app->urlManager->createUrl('front/company-news')?>";
		var productUrl = "<?=Yii::$app->urlManager->createUrl('front/product-display')?>";
		var productDetailUrl = "<?=Yii::$app->urlManager->createUrl('front/product-detail')?>";
		var productAllUrl = "<?=Yii::$app->urlManager->createUrl('company-product/product-display')?>";
	</script>

    <img src="<?=$pic?>" class="img-responsive"/>

		<div class="container">
		    	<div class="row">
					<div class="col-xs-12 col-md-12 content_box">	
						<div class="content_header">&nbsp; 企业展示</div>

					</div>
				</div>
		</div>
    	<div class="line"></div>
	<div class="container">
	 <div class="row">
		<div class="col-xs-12 col-md-9">
	    	<div class="col-xs-12 col-md-12 con_head public_shadow">
	    		<div class="right_head"> 
	                	<div class="list_head">
	                    	<span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>"><img src="images/third_details/home.png" alt="首页图标" class="third_home">&nbsp;首页</a>&nbsp;></span>
	                        <span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-display')?>">企业展示</a>&nbsp;></span>
							<span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/enterprise-detail')?>&id=<?=$product['companyId']?>"><?=$product['companyName']?></a>&nbsp;></span>
							<span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/product-display')?>&id=<?=$product['companyId']?>">产品展示</a>&nbsp;></span>
	                        <span class="lh_index">产品详情</span>
	                    </div>
	            </div>
	    	</div>
	    	<div class="col-xs-12 col-md-12 goods public_shadow">
	    		 <div class="col-xs-12 col-md-12 Details">
	                <div class="detials_title">
	                    <span>详细资料</span>
	                </div>
				     <?if(!is_null($product)){?>
						 <img src="<?=$product['thumbnailUrl']?>" class="pro_pic img-responsive"/>
						<p class="detials_p"><?=$product['name']?></p>
						 <p class="detials_p">原价：<?=$product['price']?></p>
						 <p class="detials_p">折后价：<?=($product['price'])*($product['discount']/10)?></p>
						<p class="detials_p">简介</p>
						<p class="detials_p"><?=$product['introduction']?></p>
				     <?}?>

	    		</div>
	    	</div>
	    </div>
		 <!-- 公司招聘 -->
		 <div class="col-md-3 col-sm-3 col-xs-12">
			 <div class="store_link">

			 </div>
			 <div class="company_news">

			 </div>
		 </div>
		 <!-- end 公司招聘 -->
		</div>
		</div>