
    <link rel="stylesheet" type="text/css" href="css/css/product_detials.css">
    <link rel="stylesheet" type="text/css" href="css/css/company.css">
    <script src="js/front/product_detials.js"></script>
    <img src="images/images_qy_cpxq/2banner.jpg" class="img-responsive"/>

		<div class="container">
		    	<div class="row">
					<div class="col-xs-12 col-md-12 content_box">	
						<div class="content_header">&nbsp; 企业展示</div>
						<div class="content_search">
		                	<input type="text" class="form_2" placeholder="  请输入企业名称或类型">
		                   <button class="search_bg"><center><img src="images/third_details/search.png" alt="搜索图标"></center></button>
		                </div>
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
	                        <span class="lh_index">产品展示&nbsp;></span>
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
	    			<p class="detials_p"><?=$product->name?></p>
				     <p class="detials_p">原价：<?=$product->price?></p>
				     <p class="detials_p">折后价：<?=($product->price)*($product->discount)?></p>
	    			<p class="detials_p">简介</p>
	    			<p class="detials_p"><?=$product->introduction?></p>
				     <?}?>
	    		</div>
	    	</div>
	    </div>
	   
		</div>
		</div>